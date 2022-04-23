CreateTierApp.controller('RegistrationController', function ($scope, $http) {
        $("#authorities").addClass('menu-open');
        $("#authorities a[href='#']").addClass('active');
        $("#authority-lists").addClass('active');
        $scope.url = $("#appurl").val();
        $scope.registration = {};

        $scope.all_companies = function () {
            $http.get('getcompanyinfo').then(function (response) {
                if (response.data.length > 0) {
                    $scope.companies = response.data;
                }
            });
        };

        $scope.allcompany_registrations = function () {
            $scope.allregistration = {};
            $("#record-loader").html('<i class="fa fa-spinner fa-sw fa-3x fa-pulse"></i>');
            $http.get($scope.url + 'manage-authorities/'+$("#company_id").val()).then(function (response) {
                if (response.data.length > 0) {
                    $scope.allregistration = response.data;
                    $("#record-loader").empty();
                }else{
                    $("#record-loader").empty();
                }
            });
        };

        $scope.editRegistration = function (id) {
            $http.get($scope.url + 'manage-authorities/' + id + '/edit').then(function (response) {
                $scope.authority = response.data;
                $scope.getContact($scope.authority.contact_id);
                $scope.getSocialMedia($scope.authority.social_id);
                $scope.getAddress($scope.authority.address_id);
                $("#ShowPrint").show();
            });
        };

        $scope.getContact = function(contact_id){
            $http.get($scope.url+'getContact/' + contact_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.authority, response.data);
                }
            });
        };

        $scope.getSocialMedia = function(social_id){
            $http.get($scope.url+'getSocialMedia/' + social_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.authority, response.data);
                }
            });
        };

        $scope.getAddress = function(address_id){
            $http.get($scope.url+'getAddress/' + address_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.authority, response.data);
                }
            });
        };

        $scope.save_companyregistration = function () {
            $scope.authority.company_id = $("#company_id").val();
            if (!$scope.authority.authority_name || !$scope.authority.address_line_1 || !$scope.authority.country || !$scope.authority.phone_number || !$scope.authority.mobile_number || !$scope.authority.website) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                $("#loader").removeClass('fa-save').addClass('fa-spinner fa-pulse fa-fw');
                var Data = new FormData();
                angular.forEach($scope.authority, function (v, k) {
                    Data.append(k, v);
                });
                $http.post($scope.url + 'manage-authorities', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.authority = {};
                    $scope.allcompany_registrations();
                    $("#loader").removeClass('fa-spinner fa-pulse fa-fw').addClass('fa-save');
                });
            }
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
                $http.delete($scope.url + 'manage-authorities/'+id).then(function (response) {
                    if(response.data.status == true){
                        $scope.allcompany_registrations();
                        swal("Deleted!", response.data.message, "success");
                    }else{
                        swal("Not Deleted!", response.data.message, "error");
                    }
                });
            });
        };
    });