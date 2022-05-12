UserAuthTierApp.controller('AddSubuserController', function ($scope, $http) {
    $scope.getEmployees = function () {
        $(".loader").html('<div class="square-path-loader"></div>');
        $http.get($('#baseurl').val() + 'hr/getEmployees/' + $("#company_id").val()).then(function (response) {
            if (response.data.length > 0) {
                $scope.Users = response.data;
                $(".loader").html('');
            }else{
                $(".loader").html('');
            }
        });
    };
    $scope.getMenus = function(){
        var ParentMenus = $http.get($('#baseurl').val() + 'get-sidebar-menu-subuser');
        ParentMenus.then(function (r) {
            $scope.Menus = r.data;
        });
    };

    $scope.get_designations = function(){
        $("#spinner").addClass('fa fa-spinner fa-pulse fa-sw fa-3x');
        $http.get($('#baseurl').val() + 'company/designation-form/' + $('#company_id').val()).then(function (response) {
            if(response.data.length > 0){
                $scope.alldesignations = response.data;
                $("#spinner").removeClass('fa fa-spinner fa-pulse fa-sw fa-3x');
            }else{
                $("#spinner").removeClass('fa fa-spinner fa-pulse fa-sw fa-3x');
                $scope.norecord = "There is no record found";
            }
        });
    };

    $scope.saveUser = function(){
        $scope.subuser.checkmenu = JSON.stringify($scope.checkmenus);
        if (!$scope.subuser.user_id) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.subuser, function (v, k) {
                Data.append(k, v);
            });
            $http.post('regiter-subuser', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                if(res.data.status == 200){
                    swal({
                        title: "Save!",
                        text: res.data.success,
                        type: "success"
                    });
                    $scope.subuser = {};
                    $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
                }
            });
        }
    };

    $scope.getuser = function(usr){
        console.log(usr);
    };

    $scope.checkmenus = [];
    $scope.getCheckMenus = function(menu_id){
        let index = $scope.checkmenus.indexOf(menu_id);
        if(index == -1){
            $scope.checkmenus.push(menu_id);

        }else{
            $scope.checkmenus.splice(index, 1);
        }
        console.log($scope.checkmenus);
    };
});