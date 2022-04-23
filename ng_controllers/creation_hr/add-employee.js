CreateTierApp.controller('UsersController', function ($scope, $http) {
    $("#employee").addClass('menu-open');
    $("#employee a[href='#']").addClass('active');
    $("#employee-info").addClass('active');
    $scope.getEmployees = function () {
        $(".loader").html('<div class="square-path-loader"></div>');
        $http.get('getEmployees').then(function (response) {
            if (response.data.length > 0) {
                $scope.Users = response.data;
                $(".loader").html('');
            }else{
                $(".loader").html('');
            }
        });
    };
    //
    //        $scope.approve_user = function (user_id, status) {
    //            $http.get('approve_user/' + user_id + '/' + status).then(function (response) {
    ////                if (response.data.length > 0) {
    //                $scope.all_users();
    //                $scope.approve_status = response.data;
    ////                }
    //            });
    //        };
    $scope.user = {};
    $scope.save_user = function () {
        if (!$scope.user.first_name || !$scope.user.father_name || !$scope.user.password || !$scope.user.is_admin || !$scope.user.gender) {
            $scope.showError = true;
            alert($scope.user.password);
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.user, function (v, k) {
                Data.append(k, v);
            });
            $http.post('SaveUsers', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.user = {};
                $("#onEdit").show();
                $scope.getEmployees();
                $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
            });
        }
    };

    $scope.editEmployeeInfo = function(id){
        $http.get('editEmployee/'+ id).then(function (response) {
            $("#onEdit").hide();
            $scope.user = response.data[0];
            $scope.user.password = "OnEdit";
            $scope.user.is_admin = String($scope.user.is_admin);
            $scope.editContactInfo($scope.user.contact_id);
            $scope.editSocialInfo($scope.user.social_id);
            $("#ShowPrint").show();
        });
    };

    $scope.editContactInfo = function(con_id){
        $http.get('editContact/'+ con_id).then(function (response) {
            angular.extend($scope.user, response.data);
            /* $scope.user.email = parseInt(response.data.email);
            $scope.user.mobile_number = parseInt(response.data.mobile_number);
            $scope.user.phone_number = parseInt(response.data.phone_number);
            $scope.user.fax_number = parseInt(response.data.fax_number);
            $scope.user.whatsapp = parseInt(response.data.whatsapp); */
            $("#ShowPrint").show();
        });
    };

    $scope.editSocialInfo = function(soc_id){
        $http.get('editSocial/'+ soc_id).then(function (response) {
            angular.extend($scope.user, response.data);
            $("#ShowPrint").show();
        });
    };

    $scope.deleteEmployeeInfo = function(id){
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
            $http.delete('deleteEmployees/'+id).then(function (response) {
                $scope.getEmployees();
                swal("Deleted!", response.data, "success");
            });
        });
    };

});