CreateTierApp.controller('BankController', function ($scope, $http) {
    $("#sales").addClass('menu-open');
    $("#sales a[href='#']").addClass('active');
    $("#customer-banks").addClass('active');
    $scope.url = $("#appurl").val();
    $scope.bank = {};

    $scope.getCustomers = function () {
        $scope.customerinformations = {};
        $http.get('maintain-customer-information').then(function (response) {
            if (response.data.length > 0) {
                $scope.customerinformations = response.data;
            }
        });
    };

    $scope.getVendors = function () {
        $scope.vendorinformations = {};
        $http.get('maintain-vendor-information').then(function (response) {
            if (response.data.length > 0) {
                $scope.vendorinformations = response.data;
            }
        });
    };

    $scope.getBanksDetail = function () {
        $http.get($scope.url + 'company/maintain-company-bankdetail').then(function (response) {
            if (response.data.length > 0) {
                $scope.banks = response.data;
            }
        });
    };

    $scope.getBanksInfo = function () {
        $http.get($scope.url + 'get-bank-info/customer').then(function (response) {
            if (response.data.length > 0) {
                $scope.bankinfo = response.data;
            }
        });
    };

    $scope.editBank = function (id) {
        $http.get($scope.url + 'manage-banks/' + id + '/edit').then(function (response) {
            $scope.bank = response.data;
            $scope.bank.bank_id = parseInt(response.data.bank_id);
            $("#ShowPrint").show();
        });
    };
    
    $scope.deleteBank = function (bank_id) {
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
            $http.delete($scope.url + 'manage-banks/' + bank_id).then(function (response) {
                $scope.getBanksInfo();
                swal("Deleted!", response.data, "success");
            });
        });
    };

    $scope.saveBank = function () {
        $scope.bank.actor_name = 'customer';
        if (!$scope.bank.bank_id || !$scope.bank.account_title || !$scope.bank.account_number || !$scope.bank.iban) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            var Data = new FormData();
            angular.forEach($scope.bank, function (v, k) {
                Data.append(k, v);
            });
            $http.post($scope.url + 'manage-banks', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.bank = {};
                $scope.getBanksInfo();
            });
        }
    };
});