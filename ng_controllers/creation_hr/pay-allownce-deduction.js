CreateTierApp.controller('PayAllowanceController', function ($scope, $http) {
    $("#employee").addClass('menu-open');
    $("#employee a[href='#']").addClass('active');
    $("#employee-payallowance").addClass('active');
    $scope.pld = {};
    $scope.app_url = $("#appurl").val();
    $scope.all_companies = function () {
        $http.get('getcompanyinfo').then(function (response) {
            if (response.data.length > 0) {
                $scope.companies = response.data;
            }
        });
    };

    $scope.getAccounts = function (accfor) {
        var Accounts = $http.get($scope.app_url + 'AllchartofAccount/' + accfor);
        Accounts.then(function (r) {
            if (accfor == 'Employee') {
                $scope.EmpAccounts = r.data;
            } else if (accfor == 'Company') {
                $scope.ComAccounts = r.data;
            }
        });
    };

    $scope.pays = [{ pay_type: "", pay_emp_account: "", pay_amount: "", pay_com_account: "" }];
    $scope.addPayMore = function () {
        $scope.pays.push({});
    };

    $scope.allowances = [{ allowance_type: "", allow_emp_account: "", allow_amount: "", allow_com_account: "" }];
    $scope.addAllowanceMore = function () {
        $scope.allowances.push({});
    };

    $scope.deductions = [{ deduct_type: "", deduct_emp_account: "", deduct_amount: "", deduct_com_account: "" }];
    $scope.addDeductionMore = function () {
        $scope.deductions.push({});
    };

    $scope.libilities = [{ libility_type: "", libility_emp_account: "", libility_amount: "", libility_com_account: "" }];
    $scope.addLibilityMore = function () {
        $scope.libilities.push({});
    };

    $scope.pay_allowance = {};
    $scope.savePayAllowance = function () {
        $scope.pay_allowance.pays = JSON.stringify($scope.pays);
        $scope.pay_allowance.allowances = JSON.stringify($scope.allowances);
        $scope.pay_allowance.deductions = JSON.stringify($scope.deductions);
        $scope.pay_allowance.libilities = JSON.stringify($scope.libilities);
        if (!$scope.pay_allowance.office_id || !$scope.pay_allowance.department_id) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.pay_allowance, function (v, k) {
                Data.append(k, v);
            });
            $http.post($scope.app_url + 'company/maintain-allowance-deducation', Data, { transformRequest: angular.identity, headers: { 'Content-Type': undefined } }).then(function (res) {
                if (res.data.status == true) {
                    swal({
                        title: "Save!",
                        text: res.data.message,
                        type: "success"
                    });
                    $scope.pay_allowance = {};
                    $scope.pays = [{ pay_type: "", pay_emp_account: "", pay_amount: "", pay_com_account: "" }];
                    $scope.allowances = [{ allowance_type: "", allow_emp_account: "", allow_amount: "", allow_com_account: "" }];
                    $scope.deductions = [{ deduct_type: "", deduct_emp_account: "", deduct_amount: "", deduct_com_account: "" }];
                    $scope.libilities = [{ libility_type: "", libility_emp_account: "", libility_amount: "", libility_com_account: "" }];
                    $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
                } else {
                    swal({
                        title: "Warning!",
                        text: res.data.message,
                        type: "warning"
                    });
                    $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
                }
            });
        }
    };

    $scope.getoffice = function () {
        $scope.offices = {};
        $http.get($scope.app_url + 'company/getoffice/' + $("#company_id").val()).then(function (response) {
            if (response.data.length > 0) {
                $scope.offices = response.data;
            }
        });
    };

    $scope.getDepartments = function (office_id) {
        $scope.departments = {};
        $http.get($scope.app_url + 'company/get-departments/' + office_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.departments = response.data;
            }
        });
    };

    $scope.getGroups = function (dep_id) {
        $scope.groups = {};
        $http.get($scope.app_url + 'company/get-groups/' + dep_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.groups = response.data;
            }
        });
    };

    /*  $scope.getCalendar = function (dept_id) {
         $scope.calendars = {};
         $http.get('maintain-calender/'+dept_id).then(function (response) {
             if (response.data.length > 0) {
                 $scope.calendars = response.data;
             }
            // $scope.getShift(dept_id);
         });
     }; */

    /* $scope.getShift = function (dept_id) {
        $scope.shifts = {};
        $http.get('maintain-shift/'+dept_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.shifts = response.data;
            }
        });
    }; */

    $scope.get_payallowance = function () {
        $scope.limit = 20;
        $scope.offset = 0;
        $scope.allallowances = {};
        $('#rec-loader').addClass('fa fa-spinner fa-sw fa-3x fa-pulse');
        $scope.paginate = {
            'limit': $scope.limit,
            'offset': $scope.offset,
            'company_id': $("#company_id").val()
        };
        $http.get($scope.app_url + 'company/maintain-allowance-deducation/' + JSON.stringify($scope.paginate)).then(function (response) {
            if (response.data.status == true) {
                if (response.data.data.length > 0) {
                    $scope.allallowances = response.data.data;
                    $scope.offset += $scope.limit;
                    $('#rec-loader').removeClass('fa fa-spinner fa-sw fa-3x fa-pulse');
                    $('.loader-btn').show();
                } else {
                    $('#rec-loader').removeClass('fa fa-spinner fa-sw fa-3x fa-pulse');
                    $scope.norecord = 'There is no records';
                    $('.loader-btn').hide();
                }
            } else {
                $scope.norecord = response.data.message;
                $('#rec-loader').removeClass('fa fa-spinner fa-sw fa-3x fa-pulse');
                $('.loader-btn').hide();
            }
        });
    };

    $scope.loadMore = function () {
        $scope.paginate = {
            'limit': $scope.limit,
            'offset': $scope.offset,
            'company_id': $("#company_id").val()
        };
        $('#rec-loader').addClass('fa fa-spinner fa-sw fa-3x fa-pulse');
        $http.get($scope.app_url + 'company/maintain-allowance-deducation/' + JSON.stringify($scope.paginate)).then(function (response) {
            if (response.data.status == true) {
                if (response.data.data.length > 0) {
                    $scope.allallowances = $scope.allallowances.concat(response.data.data);
                    $scope.offset += $scope.limit;
                    $('#rec-loader').removeClass('fa fa-spinner fa-sw fa-3x fa-pulse');
                    $('.loader-btn').show();
                } else {
                    $('#rec-loader').removeClass('fa fa-spinner fa-sw fa-3x fa-pulse');
                    $scope.norecord = 'There is no more records';
                    $('.loader-btn').hide();
                }
            } else {
                $('#rec-loader').removeClass('fa fa-spinner fa-sw fa-3x fa-pulse');
                $scope.norecord = 'There is no records';
                $('.loader-btn').hide();
            }
        });
    };

    $scope.get_calendars = function (dept_id) {
        $http.get($scope.app_url + 'company/get-calendar/' + dept_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.calendars = response.data;
            }
        });
    };

    $scope.get_shifts = function (dept_id) {
        $http.get($scope.app_url + 'company/get-shift/' + dept_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.shifts = response.data;
            }
        });
    };

    $scope.editpayallowance = function (id) {
        $http.get($scope.app_url + 'company/maintain-allowance-deducation/' + id + '/edit').then(function (response) {
            $scope.pay_allowance = response.data;
            $scope.allowances = response.data.allowances;
            $scope.pays = response.data.pays;
            $scope.deductions = response.data.deductions;
            $scope.libilities = response.data.libilities;
            $("#ShowPrint").show();
        });
    }


    $scope.save_leave = function () {
        if (!$scope.pld.department_id || !$scope.pld.allowance) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.pld, function (v, k) {
                Data.append(k, v);
            });
            $http.post($scope.app_url + 'company/maintain-allowance-deducation', Data, { transformRequest: angular.identity, headers: { 'Content-Type': undefined } }).then(function (res) {
                $scope.get_payallowance();
                if (res.data.status == true) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.pld = {};
                    $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
                } else {

                }
            });
        }
    };

    $scope.deletePayAllowance = function (id) {
        swal({
            title: "Are you sure?",
            text: "Your will not be able to recover this record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-primary",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
            function () {
                $http.delete($scope.app_url + 'company/maintain-allowance-deducation/' + id).then(function (response) {
                    $scope.get_payallowance();
                    swal("Deleted!", response.data, "success");
                });
            });
    };

    $scope.readUrl = function (element) {
        var reader = new FileReader();//rightbennerimage
        reader.onload = function (event) {
            $scope.jdDoc = event.target.result;
            $scope.$apply(function ($scope) {
                $scope.jds.jdDoc = element.files[0];
            });
        };
        reader.readAsDataURL(element.files[0]);
    };
});