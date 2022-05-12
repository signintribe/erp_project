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