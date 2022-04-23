CreateTierApp.controller('GroupController', function ($scope, $http) {
    $("#company").addClass('menu-open');
    $("#company a[href='#']").addClass('active');
    $("#company-group").addClass('active');
    $scope.group = {};
    $scope.app_url = $("#appurl").val();
    $scope.all_companies = function () {
        $http.get($scope.app_url + 'company/getcompanyinfo').then(function (response) {
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

    $scope.get_groups = function(){
        $http.get($scope.app_url + 'company/maintain-group').then(function (response) {
            if(response.data.length > 0){
                $scope.allgroups = response.data;
            }
        });
    }

    $scope.editGroup = function(id){
        $http.get($scope.app_url + 'company/maintain-group/'+ id + '/edit').then(function (response) {
            $scope.group = response.data[0];
            $scope.group.company_id = parseInt($scope.group.company_id);
            $scope.group.office_id = parseInt($scope.group.office_id);
            $scope.group.department_id = parseInt($scope.group.department_id);
            $("#ShowPrint").show();
        });
    }


    $scope.save_group = function () {
        if (!$scope.group.department_id || !$scope.group.group_name) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.group, function (v, k) {
                Data.append(k, v);
            });
            $http.post($scope.app_url + 'company/maintain-group', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                $scope.get_groups();
                $("#loader").removeClass('fa-spinner fa-fw fa-pulse').addClass('fa-save');
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.group = {};
                $scope.get_groups();
            });
        }
    };

    $scope.deleteEmployeeGroup = function(id){
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
            $http.delete($scope.app_url + 'company/maintain-group/'+id).then(function (response) {
                $scope.get_groups();
                swal("Deleted!", response.data, "success");
            });
        });
    };
});