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


    $scope.getoffice = function (company_id) {
        $scope.offices = {};
        $http.get($scope.app_url + 'company/getoffice/'+company_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.offices = response.data;
            }
        });
    };
    
    $scope.getDepartments = function (office_id) {
        $scope.departments = {};
        $http.get($scope.app_url + 'company/get-departments/'+office_id).then(function (response) {
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

    $scope.get_payallowance = function(){
        $http.get($scope.app_url + 'company/maintain-allowance-deducation').then(function (response) {
            if(response.data.length > 0){
                $scope.pays = response.data;
            }
        });
    };

    $scope.get_calendars = function(dept_id){
        $http.get($scope.app_url + 'company/get-calendar/' + dept_id).then(function (response) {
            if(response.data.length > 0){
                $scope.calendars = response.data;
            }
        });
    };

    $scope.get_shifts = function(dept_id){
        $http.get($scope.app_url + 'company/get-shift/' +dept_id).then(function (response) {
            if(response.data.length > 0){
                $scope.shifts = response.data;
            }
        });
    };

    $scope.editpayallowance = function(id){
        $http.get($scope.app_url + 'company/maintain-allowance-deducation/'+ id + '/edit').then(function (response) {
            $scope.pld = response.data[0];
            $scope.pld.company_id = parseInt($scope.pld.company_id);
            $scope.pld.office_id = parseInt($scope.pld.office_id);
            $scope.pld.department_id = parseInt($scope.pld.department_id);
            $scope.pld.calendar_id = parseInt($scope.pld.calendar_id);
            $scope.pld.shift_id = parseInt($scope.pld.shift_id);
            $scope.pld.group_id = parseInt($scope.pld.group_id);
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
            $http.post($scope.app_url + 'company/maintain-allowance-deducation', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                $scope.get_payallowance();
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.pld = {};
                $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
            });
        }
    };

    $scope.deletePayAllowance = function(id){
        swal({
            title: "Are you sure?",
            text: "Your will not be able to recover this record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-primary",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function(){
            $http.delete($scope.app_url + 'company/maintain-allowance-deducation/'+id).then(function (response) {
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