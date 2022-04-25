CreateTierApp.controller('EmolumentsController', function ($scope, $http) {
    $("#employee").addClass('menu-open');
    $("#employee a[href='#']").addClass('active');
    $("#pay-emoluments").addClass('active');
    $scope.getEmployees = function () {
        $http.get('getEmployees').then(function (response) {
            if (response.data.length > 0) {
                $scope.Users = response.data;
            }
        });
    };

    $scope.getPayEmoluments = function () {
        $scope.payEmoluments = {};
        $http.get('maintain-pay-emoluments').then(function (response) {
            if (response.data.length > 0) {
                $scope.payEmoluments = response.data;
                $scope.norecord = "";
            }else{
                $scope.norecord = "There is no record found";
            }
        });
    };

    $scope.editPay = function (id) {
        $http.get('maintain-pay-emoluments/'+id+'/edit').then(function (response) {
            $scope.emoluments = response.data;
            $scope.emoluments.employee_id = parseInt($scope.emoluments.employee_id);
            $scope.emoluments.basic_pay = parseInt($scope.emoluments.basic_pay);
            $scope.emoluments.medical_allowance = parseInt($scope.emoluments.medical_allowance);
            $scope.emoluments.conveyance_allowance = parseInt($scope.emoluments.conveyance_allowance);
        });
    };

    $scope.deletePay = function (id) {
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
            $http.delete('maintain-pay-emoluments/' + id).then(function (response) {
                $scope.getPayEmoluments();
                swal("Deleted!", response.data, "success");
            });
        });
    };

    $scope.emoluments = {};
    $scope.save_payEmolument = function(){
        if (!$scope.emoluments.employee_id || !$scope.emoluments.basic_pay) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.emoluments, function (v, k) {
                Data.append(k, v);
            });
            $http.post('maintain-pay-emoluments', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.emoluments = {};
               $scope.getPayEmoluments();
               $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
            });
        }
    };
});