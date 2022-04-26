CreateTierApp.controller('TaxController', function ($scope, $http) {
    $("#banking-finance").addClass('menu-open');
    $("#banking-finance a[href='#']").addClass('active');
    $("#taxes").addClass('active');
    $scope.url = $("#appurl").val();

    $scope.restScope = function(){
        $scope.tax = {};
        $scope.allcompany_registrations();
        $scope.allchartAccount();
        $scope.getCompanyTaxes();
    };
    $scope.allcompany_registrations = function () {
        $scope.allregistration = {};
        $http.get($scope.url + 'manage-authorities').then(function (response) {
            if (response.data.length > 0) {
                $scope.allregistration = response.data;
            }
        });
    };

    $scope.allchartAccount = function () {
        $scope.allregistration = {};
        $http.get($scope.url + 'AllchartofAccount').then(function (response) {
            if (response.data.length > 0) {
                $scope.accountHeads = response.data;
            }
        });
    };

    $scope.saveTax = function(){
        $scope.tax.company_id = $("#company_id").val();
        if (!$scope.tax.tax_authority) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pules');
            var Data = new FormData();
            angular.forEach($scope.tax, function (v, k) {
                Data.append(k, v);
            });
            $http.post('manage-tax', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.restScope();
                $("#loader").removeClass('fa-spinner fa-sw fa-pules').addClass('fa-save');
            });
        }
    };

    $scope.getCompanyTaxes = function () {
        $http.get('manage-tax/'+ $("#company_id").val()).then(function (response) {
            if (response.data.status == true) {
                $scope.Taxes = response.data.data;
            }
        });
    };

    $scope.deleteTaxes = function (id) {
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
            $http.delete('manage-tax/' + id).then(function (response) {
                $scope.restScope();
                swal("Deleted!", response.data, "success");
            });
        });
    };

    $scope.editTaxes = function (id) {
        $http.get('manage-tax/' + id + '/edit').then(function (response) {
            $scope.tax = response.data;
            $scope.tax.liability_head = parseInt($scope.tax.liability_head);
            $scope.tax.expanse_head = parseInt($scope.tax.expanse_head);
        });
    };

    $scope.getContact = function(contact_id){
        $http.get($scope.url+'getContact/' + contact_id).then(function (response) {
            if (response.data) {
                angular.extend($scope.contactperson, response.data);
            }
        });
    };

    $scope.getSocialMedia = function(social_id){
        $http.get($scope.url+'getSocialMedia/' + social_id).then(function (response) {
            if (response.data) {
                angular.extend($scope.contactperson, response.data);
            }
        });
    };

    $scope.getAddress = function(address_id){
        $http.get($scope.url+'getAddress/' + address_id).then(function (response) {
            if (response.data) {
                angular.extend($scope.contactperson, response.data);
            }
        });
    };
});