CreateTierApp.controller('VendorController', function ($scope, $http) {
    $("#purchase").addClass('menu-open');
    $("#purchase a[href='#']").addClass('active');
    $("#add-vendor").addClass('active');
    $scope.organization = {};
    $scope.appurl = $("#appurl").val();
    $scope.save_vendorInformation = function(){
        if (!$scope.organization.organization_name) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $scope.organization.company_id = $("#company_id").val();
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.organization, function (v, k) {
                Data.append(k, v);
            });
            $http.post('maintain-vendor-information', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.organization = {};
               $scope.getVendorInformation();
               $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
            });
        }
    };


    $scope.readUrl = function (element) {
        var reader = new FileReader();//rightbennerimage
        reader.onload = function (event) {
            $scope.orglogo = event.target.result;
            $scope.$apply(function ($scope) {
                $scope.organization.org_logo = element.files[0];
            });
        };
        reader.readAsDataURL(element.files[0]);
    };


    $scope.getVendorInformation = function () {
        $scope.vendorinformations = {};
        $http.get('maintain-vendor-information/' + $("#company_id").val()).then(function (response) {
            if (response.data.data.length > 0) {
                $scope.vendorinformations = response.data.data;
            }
        });
    };

    $scope.editVendorInformation = function (id) {
        $http.get('maintain-vendor-information/'+id+'/edit').then(function (response) {
            $scope.organization = response.data;
            if($scope.organization.organization_logo){
                $scope.orglogo = $scope.appurl + "public/organization_logo/" + $scope.organization.organization_logo;
            }
            $scope.editAddress($scope.organization.address_id);
            $scope.editContact($scope.organization.contact_id);
            $scope.editSocial($scope.organization.social_id);
        });
    };

    $scope.editAddress = function (address_id) {
        $http.get($scope.appurl + 'sourcing/get-log-address/' + address_id).then(function (response) {
            angular.extend($scope.organization, response.data[0]);
            //console.log($scope.inventory);
        });
    };

    $scope.editContact = function (contact_id) {
        $http.get($scope.appurl + 'sourcing/get-log-contact/' + contact_id).then(function (response) {
            angular.extend($scope.organization, response.data[0]);
            //console.log($scope.inventory);
        });
    };

    $scope.editSocial = function (social_id) {
        $http.get($scope.appurl + 'sourcing/get-log-social/' + social_id).then(function (response) {
            angular.extend($scope.organization, response.data[0]);
            //console.log($scope.inventory);
        });
    };

    $scope.deleteVendorInformation = function (id) {
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
            $http.delete('maintain-vendor-information/' + id).then(function (response) {
                if(response.data.status == true){
                    $scope.getVendorInformation();
                    swal("Deleted!", response.data.message, "success");
                }else{
                    swal("Not Deleted!", response.data.message, "error");
                }
            });
        });
    };

});