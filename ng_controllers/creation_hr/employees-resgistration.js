CreateTierApp.controller('RegistrationController', function ($scope, $http) {

    $scope.getEmployees = function () {
        $http.get('getEmployees').then(function (response) {
            if (response.data.length > 0) {
                $scope.Users = response.data;
            }
        });
    };

    $('#start_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('#end_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $("#employee").addClass('menu-open');
    $("#employee a[href='#']").addClass('active');
    $("#employee-registration").addClass('active');
    $scope.appurl = $("#appurl").val();
    $scope.registration = {};

    $scope.get_authorities = function () {
        $scope.allregistration = {};
        $http.get($scope.appurl + 'manage-authorities').then(function (response) {
            if (response.data.length > 0) {
                $scope.allauthorities = response.data;
            }
        });
    };
    $scope.all_companies = function () {
        $http.get('getcompanyinfo').then(function (response) {
            if (response.data.length > 0) {
                $scope.companies = response.data;
            }
        });
    };

    $scope.allcompany_registrations = function () {
        $scope.allregistration = {};
        $http.get($scope.appurl + 'manage-registration/employee-'+$("#company_id").val()).then(function (response) {
            if (response.data.length > 0) {
                $scope.allregistration = response.data;
            }
        });
    };

    $scope.editRegistration = function (id) {
        $http.get($scope.appurl + 'manage-registration/' + id + '/edit').then(function (response) {
            $scope.registration = response.data;
            $scope.registration.company_id = parseInt($scope.registration.company_id);
            $scope.certificate_picture = $scope.appurl + 'public/authorities_certificates/' + response.data.certificate_image;
            $("#ShowPrint").show();
        });
    };

    $scope.save_companyregistration = function () {
        $scope.registration.issue_date = $("#start_date input").val();
        $scope.registration.expiry_date = $("#end_date input").val();
        $scope.registration.company_id = $("#company_id").val();
        $scope.registration.actor_name = 'employee';
        if (!$scope.registration.authority_id || !$scope.registration.registration_id || !$scope.registration.registration_name) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass("fa-save").addClass('fa-spinner fa-sw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.registration, function (v, k) {
                Data.append(k, v);
            });
            $http.post($scope.appurl + 'manage-registration', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.registration = {};
                $scope.allcompany_registrations();
                $("#loader").removeClass("fa-spinner fa-sw fa-pulse").addClass('fa-save');
            });
        }
    };

    $scope.readUrl = function (element) {
        var reader = new FileReader();//rightbennerimage
        reader.onload = function (event) {
            $scope.certificate_picture = event.target.result;
            $scope.$apply(function ($scope) {
                $scope.registration.certificate_picture = element.files[0];
            });
        };
        reader.readAsDataURL(element.files[0]);
    };

    $scope.deleteRegistration = function(id){
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
            $http.delete($scope.appurl + 'manage-registration/'+id).then(function (response) {
                $scope.allcompany_registrations();
                swal("Deleted!", response.data, "success");
            });
        });
    };
});