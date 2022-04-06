
var RegisterAdmin = angular.module('RegisterAdminApp', [], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

RegisterAdmin.controller('RegisterAdminController', function ($scope, $http) {
    $("#register-admin").addClass('active');
    $scope.resetscope = function(){
        $scope.getMenus();
        $scope.menu = {};
        $scope.getUser();
    };

    $scope.getUserTiers = function(user_id, reqmenu){
        var getUserTiers = $http.get('get-user-sidebar-menus/' + user_id + '/' + reqmenu);
        getUserTiers.then(function(res){
            if(res.data.status == true){
                $scope.Tiers = res.data.data;
                console.log($scope.Tiers);
            }else{
                $scope.notiers = "There is no menu found"
            }
        });
    };

    $scope.formIds = [];
    $scope.selectForms = function(form_id){
        let index = $scope.formIds.indexOf(form_id);
        if(index == -1){
            $scope.formIds.push(form_id);
        }else{
            $scope.formIds.splice(index, 1);
        }
    };

    $scope.getMenus = function(){
    var ParentMenus = $http.get('get-sidebar-menu');
        ParentMenus.then(function (r) {
            $scope.Menus = r.data;
        });
    };

    $scope.getUser = function(){
    var GetUsers = $http.get('get-users');
        GetUsers.then(function (r) {
            $scope.users= r.data;
        });
    };

    $scope.getMenusOne = function(id){
    var ParentMenus = $http.get('create-sidebar-menu/' + id);
        ParentMenus.then(function (r) {
            $scope.MenusOne = r.data;
        });
    };

    $scope.getMenusTwo = function(id){
    var ParentMenus = $http.get('create-sidebar-menu/' + id);
        ParentMenus.then(function (r) {
            $scope.MenusTwo = r.data;
        });
    };

    $scope.saveUser = function(){
        $scope.menu.forms = JSON.stringify($scope.checkmenus);
        console.log($scope.menu);
        if (!$scope.menu.email || !$scope.menu.name || !$scope.menu.company_name || !$scope.menu.password || !$scope.menu.is_admin) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.menu, function (v, k) {
                Data.append(k, v);
            });
            $http.post('regiter-admin', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                if(res.data.status == 201){
                    swal({
                        title: "Save!",
                        text: res.data.success,
                        type: "success"
                    });
                    $scope.menu = {};
                    $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
                }
            });
        }
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

    /* $scope.getUserSidebarMenus = function(){
        var UserMenus = $http.get('get-user-sidebar-menus');
        UserMenus.then(function (r) {
            $scope.usermenus = r.data;                
            console.log($scope.usermenus);
        });
    }; */
});