CreateTierApp.controller('DepartmentsController', function ($scope, $http) {
    $("#company").addClass('menu-open');
    $("#company a[href='#']").addClass('active');
    $("#company-department").addClass('active');
    $scope.get_companyinfo = function () {
        $http.get('getcompanyinfo').then(function (response) {
            if (response.data.length > 0) {
                $scope.companies = response.data;
            }
        });
    };
    
    $scope.get_departments = function () {
        $http.get('getdepartments').then(function (response) {
            if (response.data.length > 0) {
                $scope.departments = response.data;
            }
        });
    };

    $scope.editDept = function (id) {
        $http.get('getonedept/' + id).then(function (response) {
            if (response.data) {
                $scope.dept = response.data[0];
                $scope.dept.department_status = String(response.data[0].department_status);
                $scope.get_companysocial($scope.dept.social_id);
                $scope.get_companyaddress($scope.dept.address_id);
                $scope.get_companycontact($scope.dept.contact_id);
                $scope.dept.company_id = parseInt( $scope.dept.company_id);
                $scope.dept.office_id = parseInt( $scope.dept.office_id);
                $("#ShowPrint").show();
            }
        });
    };

    $scope.get_companysocial = function (social_id) {
        $http.get('getcompanysocial/' + social_id).then(function (response) {
            if (response.data) {
                angular.extend($scope.dept, response.data);
            }
        });
    };

    $scope.get_companyaddress = function (address_id) {
        $http.get('getcompanyaddress/' + address_id).then(function (response) {
            if (response.data) {
                angular.extend($scope.dept, response.data);
            }
        });
    };

    $scope.get_companycontact = function (contact_id) {
        $http.get('getcompanycontact/' + contact_id).then(function (response) {
            if (response.data) {
                angular.extend($scope.dept, response.data);
            }
        });
    };

    $scope.deleteDept = function (id) {
        swal({
            title: "Are you sure?",
            text: "Your will not be able to recover this record! ",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-primary",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function(){
            $http.get('delete-department/' + id).then(function (response) {
                $scope.get_departments();
                if(response.data.status === 'true'){
                    swal("Delete!", response.data.message, "success");
                }else{
                    swal("Not Delete!", response.data.message, "error");
                }
            });
        });
    };

    $scope.getoffice = function (company_id) {
        $scope.offices = {};
        $http.get('getoffice/'+company_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.offices = response.data;
            }
        });
    };
    
    $scope.dept = {};
    $scope.save_department = function () {
        if (!$scope.dept.office_id || !$scope.dept.department_name || !$scope.dept.address_line_1 || !$scope.dept.country || !$scope.dept.phone_number || !$scope.dept.mobile_number) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.dept, function (v, k) {
                Data.append(k, v);
            });
            $http.post('SaveDepartment', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $("#loader").removeClass('fa-spinner fa-fw fa-pulse').addClass('fa-save');
                $scope.dept = {};
                $scope.get_departments();
            });
        }
    };

});