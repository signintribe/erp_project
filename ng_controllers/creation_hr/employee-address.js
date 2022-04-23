CreateTierApp.controller('AddressController', function ($scope, $http) {
    $("#employee").addClass('menu-open');
    $("#employee a[href='#']").addClass('active');
    $("#employee-address").addClass('active');
    $scope.getEmployees = function () {
        $http.get('getEmployees').then(function (response) {
            if (response.data.length > 0) {
                $scope.Users = response.data;
            }
        });
    };

    $scope.getAddress = function (address_id) {
        $scope.Addresses = {};
        $("#record-loader").html('<i class="fa fa-spinner fa-sw fa-3x fa-pulse"></i>');
        $http.get('maintain-employee-address').then(function (response) {
            if (response.data.length > 0) {
                $scope.Addresses = response.data;
                $("#record-loader").empty();
            }else{
                $("#record-loader").empty();
            }
        });
    };

    $scope.editAddress = function (address_id) {
        $http.get('maintain-employee-address/' + address_id + '/edit').then(function (response) {
            if (response.data.length > 0) {
                $scope.address = response.data[0];
                $scope.address.employee_id = parseInt($scope.address.employee_id);
            }
        });
    };

    $scope.deleteAddress = function (address_id) {
        swal({
            title: "Are you sure?",
            text: "Your will not be able to recover this record! ",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-primary",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function(){
            $http.delete('maintain-employee-address/' + address_id).then(function (response) {
                if(response.data.status === true){
                    swal("Delete!", response.data.message, "success");
                }else{
                    swal("Not Delete!", response.data.message, "error");
                }
                $scope.getAddress(0);
            });
        });
    };
    
    $scope.address = {};
    $scope.save_address = function () {
        if (!$scope.address.employee_id || !$scope.address.address_line_1 || !$scope.address.street || !$scope.address.country || !$scope.address.state || !$scope.address.city) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.address, function (v, k) {
                Data.append(k, v);
            });
            $http.post('maintain-employee-address', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.address = {};
                $scope.getAddress(0);
                $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
            });
        }
    };
});