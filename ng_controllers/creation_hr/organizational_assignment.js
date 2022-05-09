CreateTierApp.controller('AssignmentController', function ($scope, $http) {
    $("#employee").addClass('menu-open');
    $('#appointment_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#promotion_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $("#employee a[href='#']").addClass('active');
    $("#organizational-assignment").addClass('active');
    $scope.app_url = $("#appurl").val();
    $scope.getEmployees = function () {
        $http.get('getEmployees').then(function (response) {
            if (response.data.length > 0) {
                $scope.Users = response.data;
            }
        });
    };

    $scope.getoffice = function (company_id) {
        $scope.offices = {};
        $http.get($scope.app_url +'company/getoffice/'+company_id).then(function (response) {
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
    
    $scope.getAssignments = function () {
        $http.get('maintain-organization-assignment').then(function (response) {
            if (response.data.length > 0) {
                $scope.Assignments = response.data;
            }
        });
    };

    $scope.editAssignment = function (id) {
        $http.get('maintain-organization-assignment/'+id+'/edit').then(function (response) {
            $scope.orgassignment = response.data[0];
            $scope.orgassignment.supervisor_name = parseInt($scope.orgassignment.supervisor_name);
            $scope.orgassignment.department_id = parseInt($scope.orgassignment.department_id);
            $scope.orgassignment.employee_id = parseInt($scope.orgassignment.employee_id);
            $scope.orgassignment.office_id = parseInt($scope.orgassignment.office_id);
        });
    };
    
    $scope.deleteAssignment = function (id) {
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
            $http.delete('maintain-organization-assignment/' + id).then(function (response) {
                $scope.getAssignments();
                swal("Deleted!", response.data, "success");
            });
        });
    };
    $scope.orgassignment = {};
    $scope.save_assignment = function(){
        if (!$scope.orgassignment.employee_id || !$scope.orgassignment.department_id) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $scope.orgassignment.appointment_date = $("#appointment_date input").val();
            $scope.orgassignment.promotion_date = $("#promotion_date input").val();
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
            console.log($scope.orgassignment);
            var Data = new FormData();
            angular.forEach($scope.orgassignment, function (v, k) {
                Data.append(k, v);
            });
            $http.post('maintain-organization-assignment', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.orgassignment = {};
               $scope.getAssignments();
               $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
            });
        }
    };
});