CreateTierApp.controller('ComAddressController', function ($scope, $http) {
    $("#company").addClass('menu-open');
    $("#company a[href='#']").addClass('active');
    $("#company-address").addClass('active');
    $scope.company = {};
    $scope.app_url = $('#baseurl').val();
    $scope.get_allcompanyinfo = function () {
        $scope.companies = {};
        $http.get('getcompanyinfo').then(function (response) {
            if (response.data.length > 0) {
                $scope.companies = response.data;
            }
        });
    };

    $scope.get_companyaddress = function () {
        $scope.addresses = {};
        $http.get('maintain-company-address/' + $('#company_id').val()).then(function (response) {
            if (response.data.length > 0) {
                $scope.addresses = response.data;
            }
        });
    };

    $scope.deleteComAddress = function (id) {
       
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
            $http.delete('maintain-company-address/' + id).then(function (response) {
                $scope.get_companyaddress();
                if(response.data.status == true){
                    swal("Delete!", response.data.message, "success");
                }else{
                    swal("Not Delete!", response.data.message, "error");
                }
            });
        });
    };

    $scope.editComAddress = function (id) {
        $http.get('maintain-company-address/' + id + '/edit').then(function (response) {
            if (response.data[0]) {
                $scope.company = response.data[0];
            }
        });
    };

    $scope.save_comAddressInfo = function () {
        //console.log($scope.company);
        if (!$scope.company.address_line_1) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $scope.company.com_id = $("#company_id").val();
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-pulse fa-fw');
            var Data = new FormData();
            angular.forEach($scope.company, function (v, k) {
                Data.append(k, v);
            });
            $http.post('maintain-company-address', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                $scope.get_companyaddress();
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.company = {};
                $("#loader").removeClass('fa-spinner fa-pulse fa-fw').addClass('fa-save');
            });
        }
    };
});