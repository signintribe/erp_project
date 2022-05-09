CreateTierApp.controller('EducationController', function ($scope, $http) {
    $("#employee").addClass('menu-open');
    $("#employee a[href='#']").addClass('active');
    $("#employee-education").addClass('active');
    $scope.getEmployees = function () {
        $http.get('getEmployees').then(function (response) {
            if (response.data.length > 0) {
                $scope.Users = response.data;
            }
        });
    };

    $scope.getEducation = function () {
        $http.get('maintain-employee-education').then(function (response) {
            if (response.data.length > 0) {
                $scope.Educations = response.data;
            }
        });
    };

    $scope.editEducation = function (id) {
        $http.get('maintain-employee-education/' + id + '/edit').then(function (response) {
            $scope.education = response.data;
            $scope.education.passing_year = String($scope.education.passing_year);
            $scope.education.employee_id = parseInt($scope.education.employee_id);
            $scope.education.total_marks = parseInt($scope.education.total_marks);
            $scope.education.obtain_marks = parseInt($scope.education.obtain_marks);
        });
    };

    $scope.deleteEducation = function (id) {
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
            $http.delete('maintain-employee-education/' + id).then(function (response) {
                $scope.getEducation();
                swal("Deleted!", response.data, "success");
            });
        });
    };

    $scope.education = {};
    $scope.save_education = function(){
        if (!$scope.education.employee_id || !$scope.education.qualification_name || !$scope.education.passing_year) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.education, function (v, k) {
                Data.append(k, v);
            });
            $http.post('maintain-employee-education', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.education = {};
                $scope.getEducation();
                $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
            });
        }
    };
});