CreateTierApp.controller('OfficeController', function ($scope, $http) {
    $("#company").addClass('menu-open');
    $("#company a[href='#']").addClass('active');
    $("#company-office").addClass('active');
    $scope.office = {};

    $scope.all_companies = function () {
        $http.get('getcompanyinfo').then(function (response) {
            if (response.data.length > 0) {
                $scope.companies = response.data;
            }
        });
    };

    $scope.editOffice = function (id) {
        $http.get('office-settings/' + id + '/edit').then(function (response) {
            $scope.office = response.data;
            $scope.office.office_status = $scope.office.office_status == 1 ? true : false;
            $scope.get_companysocial($scope.office.social_id);
            $scope.get_companyaddress($scope.office.address_id);
            $scope.get_companycontact($scope.office.contact_id);
            $("#ShowPrint").show();
        });
    };

    $scope.get_companysocial = function (social_id) {
        $http.get('getcompanysocial/' + social_id).then(function (response) {
            if (response.data) {
                angular.extend($scope.office, response.data);
            }
        });
    };

    $scope.get_companyaddress = function (address_id) {
        $http.get('getcompanyaddress/' + address_id).then(function (response) {
            if (response.data) {
                angular.extend($scope.office, response.data);
            }
        });
    };

    $scope.get_companycontact = function (contact_id) {
        $http.get('getcompanycontact/' + contact_id).then(function (response) {
            if (response.data) {
                angular.extend($scope.office, response.data);
            }
        });
    };
    
    $scope.deleteOffice = function (office_id) {
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
            $http.delete('office-settings/' + office_id).then(function (response) {
                $scope.getalloffice();
                swal("Deleted!", response.data, "success");
            });
        });
    };

    $scope.save_companyoffice = function () {
        if (!$scope.office.office_name) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-pulse fa-fw');
            var Data = new FormData();
            angular.forEach($scope.office, function (v, k) {
                Data.append(k, v);
            });
            $http.post('office-settings', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $("#loader").removeClass('fa-spinner fa-pulse fa-fw').addClass('fa-save');
                $scope.office = {};
                $scope.getalloffice();
            });
        }
    };

    $scope.getalloffice = function () {
        $scope.alloffice = {};
        $http.get('office-settings').then(function (response) {
            if (response.data.length > 0) {
                $scope.alloffice = response.data;
            }
        });
    };
});