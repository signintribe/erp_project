CreateTierApp.controller('CustomerController', function ($scope, $http) {
    $("#sales").addClass('menu-open');
    $("#sales a[href='#']").addClass('active');
    $("#customer-info").addClass('active');
    $scope.customer = {};
    $scope.appurl = $("#appurl").val();
    $scope.save_customerInformation = function(){
        if (!$scope.customer.customer_type || !$scope.customer.customer_name || !$scope.customer.address_line_1 || !$scope.customer.phone_number) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $scope.customer.company_id = $("#company_id").val();
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.customer, function (v, k) {
                Data.append(k, v);
            });
            $http.post('maintain-customer-information', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.customer = {};
                $scope.cuslogo = "";
               $scope.getCustomerInformation();
               $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
            });
        }
    };

    $scope.readUrl = function (element) {
        var reader = new FileReader();//rightbennerimage
        reader.onload = function (event) {
            $scope.cuslogo = event.target.result;
            $scope.$apply(function ($scope) {
                $scope.customer.cust_logo = element.files[0];
            });
        };
        reader.readAsDataURL(element.files[0]);
    };


    $scope.getCustomerInformation = function () {
        $scope.customerinformations = {};
        $http.get('maintain-customer-information/' + $("#company_id").val()).then(function (response) {
            if (response.data.length > 0) {
                $scope.customerinformations = response.data;
            }
        });
    };
    
    $scope.editCustomerInformation = function (id) {
        $http.get('maintain-customer-information/'+id+'/edit').then(function (response) {
            $scope.customer = response.data;
            if($scope.customer.customer_logo){
                $scope.cuslogo = $scope.appurl + "public/customer_logo/" + $scope.customer.customer_logo;
            }
            $scope.editAddress($scope.customer.address_id);
            $scope.editContact($scope.customer.contact_id);
            $scope.editSocial($scope.customer.social_id);
        });
    };

    $scope.editAddress = function (address_id) {
        $http.get($scope.appurl + 'sourcing/get-log-address/' + address_id).then(function (response) {
            angular.extend($scope.customer, response.data[0]);
            //console.log($scope.inventory);
        });
    };

    $scope.editContact = function (contact_id) {
        $http.get($scope.appurl + 'sourcing/get-log-contact/' + contact_id).then(function (response) {
            angular.extend($scope.customer, response.data[0]);
            //console.log($scope.inventory);
        });
    };

    $scope.editSocial = function (social_id) {
        $http.get($scope.appurl + 'sourcing/get-log-social/' + social_id).then(function (response) {
            angular.extend($scope.customer, response.data[0]);
            //console.log($scope.inventory);
        });
    };
    $scope.deleteCustomerInformation = function (id) {
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
            $http.delete('maintain-customer-information/' + id).then(function (response) {
                $scope.getCustomerInformation();
                swal("Deleted!", response.data, "success");
            });
        });
    };

});