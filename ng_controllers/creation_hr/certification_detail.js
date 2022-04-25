CreateTierApp.controller('CertificationController', function ($scope, $http) {
    $('#start_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('#end_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $("#employee").addClass('menu-open');
    $("#employee a[href='#']").addClass('active');
    $("#employee-certification").addClass('active');
    $scope.education = {};
    $scope.getEmployees = function () {
        $http.get('getEmployees').then(function (response) {
            if (response.data.length > 0) {
                $scope.Users = response.data;
            }
        });
    };

    $scope.editCertification = function (id) {
        $http.get('maintain-employee-certification/' + id + '/edit').then(function (response) {
            $scope.education = response.data;
            $scope.education.employee_id = parseInt($scope.education.employee_id);
        });
    };
    
    $scope.getCertification = function () {
        $scope.allcert = {};
        $http.get('maintain-employee-certification').then(function (response) {
            if (response.data.length > 0) {
                $scope.allcert = response.data;
            }
        });
    };

    $scope.deleteCertification = function (id) {
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
            $http.delete('maintain-employee-certification/' + id).then(function (response) {
                $scope.getCertification();
                swal("Deleted!", response.data, "success");
            });
        });
    };

    $scope.save_certification = function(){
        if (!$scope.education.employee_id || !$scope.education.certification_name) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $scope.education.start_date = $("#start_date input").val();
            $scope.education.end_date = $("#end_date input").val();
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.education, function (v, k) {
                Data.append(k, v);
            });
            $http.post('maintain-employee-certification', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.education = {};
                $scope.getCertification();
                $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
            });
        }
    };
});