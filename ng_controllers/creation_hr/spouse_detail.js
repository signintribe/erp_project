CreateTierApp.controller('SpouseController', function ($scope, $http) {
    $("#employee").addClass('menu-open');
    $("#employee a[href='#']").addClass('active');
    $("#employee-spouse").addClass('active');
    $scope.user = {};
    $scope.appurl = $("#app_url").val();
    $scope.getEmployees = function () {
        $http.get('getEmployees').then(function (response) {
            if (response.data.length > 0) {
                $scope.Users = response.data;
            }
        });
    };

    $scope.getSpouseDetail = function () {
        $http.get('maintain-spouse-detail').then(function (response) {
            if (response.data.length > 0) {
                $scope.spousedetails = response.data;
            }
        });
    };

    $scope.eidtSpouse = function (id) {
        $http.get('maintain-spouse-detail/' + id + '/edit').then(function (response) {
            //if (response.data.length > 0) {
                $scope.user = response.data;
                $scope.user.employee_id = parseInt(response.data.employee_id);
                $scope.getAddress($scope.user.address_id);
                $scope.getContact($scope.user.contact_id);
            //}
        });
    };

    $scope.getAddress = function(address_id){
        $http.get($scope.appurl+'getAddress/' + address_id).then(function (response) {
            if (response.data) {
                angular.extend($scope.user, response.data);
                $scope.getContact($scope.user.contact_id);
            }
        });
    };

    $scope.getContact = function(contact_id){
        $http.get($scope.appurl+'getContact/' + contact_id).then(function (response) {
            if (response.data) {
                angular.extend($scope.user, response.data);
            }
        });
    };

    $scope.save_spouse = function(){
        if (!$scope.user.employee_id || !$scope.user.spouse_first_name || !$scope.user.relation || !$scope.user.mobile_number || !$scope.user.address_line_1) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.user, function (v, k) {
                Data.append(k, v);
            });
            $http.post('maintain-spouse-detail', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.user = {};
                $scope.getSpouseDetail();
                $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
            });
        }
    };

    $scope.deleteSpouse = function(id){
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
            $http.delete('maintain-spouse-detail/'+id).then(function (response) {
                $scope.getSpouseDetail();
                swal("Deleted!", response.data, "success");
            });
        });
    };
});