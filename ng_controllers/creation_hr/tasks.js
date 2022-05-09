CreateTierApp.controller('TasksController', function ($scope, $http) {
    $("#employee").addClass('menu-open');
    $("#employee a[href='#']").addClass('active');
    $("#employee-task").addClass('active');
    $scope.task = {};
    $scope.getEmployees = function () {
            $http.get('getEmployees').then(function (response) {
            if (response.data.length > 0) {
                $scope.Users = response.data;
            }
        });
    };

    $scope.save_task = function(){
        if (!$scope.task.employee_id || !$scope.task.task_name) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            var Data = new FormData();
            angular.forEach($scope.task, function (v, k) {
                Data.append(k, v);
            });
            $http.post('maintain-emp-tasks', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.task = {};
                $scope.getTaskDetails ();
            });
        }
    };

    $scope.readUrl = function (element) {
        var reader = new FileReader();//rightbennerimage
        reader.onload = function (event) {
            $scope.catimg = event.target.result;
            $scope.$apply(function ($scope) {
                $scope.task.attachment = element.files[0];
            });
        };
        reader.readAsDataURL(element.files[0]);
    };

    $scope.deleteTaskDetail = function (id) {
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
            $http.delete('maintain-emp-tasks/' + id).then(function (response) {
                $scope.getTaskDetails();
                swal("Deleted!", response.data, "success");
            });
        });
    };

    $scope.getTaskDetails = function () {
        $scope.taskdetails = {};
        $http.get('maintain-emp-tasks').then(function (response) {
            if (response.data.length > 0) {
                $scope.taskdetails = response.data;
            }
        });
    };

    $scope.editTaskDetail = function (id) {
        $http.get('maintain-emp-tasks/' + id + '/edit').then(function (response) {
            $scope.task = response.data;
            console.log($scope.task);
            $scope.getAssignedDetail($scope.task.id);
        });
    };

    $scope.getAssignedDetail = function(assigned_id){
        $http.get('get-task-assigned-details/' + assigned_id).then(function (response) {
            if (response.data) {
                angular.extend($scope.task, response.data);
            }
        });
    };
});