CreateTierApp.controller('BankController', function ($scope, $http) {
    $("#employee").addClass('menu-open');
    $("#employee a[href='#']").addClass('active');
    $("#employee-banks").addClass('active');
    $scope.url = $("#appurl").val();
    $scope.bank = {};

    $scope.getEmployees = function () {
        $http.get('getEmployees').then(function (response) {
            if (response.data.length > 0) {
                $scope.Users = response.data;
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
        $http.get($scope.url + 'get-bank-info/employee').then(function (response) {
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
        $scope.bank.actor_name = 'employee';
        if (!$scope.bank.bank_id || !$scope.bank.account_title || !$scope.bank.account_number || !$scope.bank.iban) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
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
                $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
            });
        }
    };
});