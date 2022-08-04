CreateTierApp.controller('RolesController', function ($scope, $http) {
    $scope.role = {};
    $scope.app_url = $("#appurl").val();
    $scope.company_id = $("#company_id").val();

    $scope.getoffice = function () {
        $scope.offices = {};
        $http.get('getoffice/'+$scope.company_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.offices = response.data;
            }
        });
    };
    
    $scope.getDepartments = function (office_id) {
        $scope.departments = {};
        $http.get('get-departments/'+office_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.departments = response.data;
            }
        });
    };

    $scope.getRoles = function () {
        $scope.allroles = {};
        $http.get('employee-roles/'+$scope.company_id).then(function (response) {
            if (response.data.data.length > 0) {
                $scope.allroles = response.data.data;
            }
        });
    };

    $scope.editRole = function (id) {
        $http.get('employee-roles/'+ id + '/edit').then(function (response) {
            $scope.getDepartments(response.data.role.office_id);
            $scope.role = response.data.role;
            $scope.roleAction = response.data.actions;
        });
    };

    $scope.saveRole = function () {
        if (!$scope.role.office_id || !$scope.role.department_id || !$scope.role.role_name) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
            return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.role, function (v, k) {
                Data.append(k, v);
            });
            $http.post('employee-roles', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                if(res.data.status == true){
                    $scope.getRoles();
                    swal({
                        title: "Save!",
                        text: res.data.message,
                        type: "success"
                    });
                    $("#loader").removeClass('fa-spinner fa-fw fa-pulse').addClass('fa-save');
                    $scope.role = {};
                }else{
                    swal('Warning', res.data.message, 'warning');
                }
            });
        }
    };

    $scope.deleteRole = function(id){
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
            $http.delete('employee-roles/'+id).then(function (response) {
                $scope.getRoles();
                swal("Deleted!", response.data, "success");
            });
        });
    };

    $scope.checkList = [];
    $scope.getCheckList = function(list){
        let index = $scope.checkList.indexOf(list);
        if(index == -1){
            $scope.checkList.push(list);
        }else{
            $scope.checkList.splice(index, 1);
        }
        $scope.role.role_action = JSON.stringify($scope.checkList);
    };
});