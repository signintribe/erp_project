CreateTierApp.controller('CategoryController', function ($scope, $http, $compile, $filter) {
    $('#account_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $("#banking-finance").addClass('menu-open');
    $("#banking-finance a[href='#']").addClass('active');
    $("#chart-account").addClass('active');
    $scope.resetscope = function () {
        $scope.Category = {};
        $scope.C = {};
        $scope.categories = [];
        $scope.SaveLabel = 'Save';
        $scope.getcategories();
        $scope.getAccounts();
    };
    $scope.getcategories = function () {
        $scope.parent = [];
        var categories = $http.get('get-account-categories');
        categories.then(function (r) {
            $scope.allcats = r.data;
        });
    };

    $scope.getAccounts = function () {
        var Accounts = $http.get('AllchartofAccount');
        Accounts.then(function (r) {
            $scope.Accounts = r.data;
        });
    };
    //save Category
    $scope.save_category = function () {
        if (!$scope.Category.ParentcategoryId || !$scope.Category.CategoryName || !$scope.Category.AccountId) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#savebtn").removeClass('fa-save').addClass('fa-spinner fa-pulse');
            $scope.Category.date = $("#account_date input").val();
            if (!$scope.Category.ParentcategoryId) {
                $scope.Category.ParentcategoryId = 1;
            }
            $("#CategoryName").removeClass('has-error');
            $http.post('save-account', $scope.Category).then(function (res) {
                //var button = $compile(angular.element('<button class="btn btn-success float-right btn-md" ng-click="save_category()"><i class="fa fa-save" id="savebtn"></i> Save</button>'))($scope);
                $("#savebtn").removeClass('fa-spinner fa-pulse').addClass('fa-save');
                swal("Save!", res.data, "success");
                $scope.resetscope();
            });
        }
    };

    $scope.getChilds = function(category){
        $scope.childaccounts = {};
        var child = $http.get('getAccountCategories/' + category.id);
        child.then(function (r) {
            if(r.data.length > 0){
                $scope.childaccounts = r.data;
                $scope.selectedCate = {};
            }else{
                $scope.selectedCate = category;
            }
        });
    }

    $scope.getCategory = function (category) {
        $scope.selectedCate = category;
    };
    $scope.CancelEditing = function (id) {
        var button = $compile(angular.element('<button class="btn btn-success btn-xs pull-right" ng-click="save_category()"><i class="fa fa-save"></i> Save</button>'))($scope);
        $("#Save-button").html(button);
        $scope.resetscope();
    };
    //set Associated category array
    $scope.associate = function (id) {
        console.log(id);
        var id = parseInt(id);
        if ($scope.Category.ParentcategoryId) {
            $scope.C['Check' + $scope.Category.ParentcategoryId] = false;
        }
        $scope.Category.ParentcategoryId = id;
        console.log($scope.Category);
    };

    $scope.editAccount = function(account){
        $scope.Category = account;
        $("#openingBalance").hide();
    };

    $scope.getchield = function (id, objid) {
        var brows = $("#brows" + objid).attr('brows');
        if (typeof brows === "undefined") {
            $("#brows" + objid).attr('brows', 'true').removeClass('fa-plus').addClass('fa-minus');
            $("#par" + objid + " div").eq(1).html('<div class="sk-spinner sk-spinner-wave"  ng-if="!categories"><div class="sk-rect1"></div><div class="sk-rect2"></div><div class="sk-rect3"></div><div class="sk-rect4"></div><div class="sk-rect5"></div></div>');
            var chields = $http.get('getAccountCategories/' + id);
            chields.then(function (r) {
                $scope["par" + objid] = '';
                $scope["par" + objid] = r.data;
                var content = angular.element('<div ng-cloak ng-repeat="v in par' + objid + '" ng-init="parseId(v)" id="par<% v.id %>" style="width: 435px;">\
                                                <div class="checkbox checkbox-success"  style="padding-left: 0px;">\
                                                    <span class="browsedbutton fa fa-plus" ng-if="v.product_category === 0" style="float:left;" id="brows<% v.id %>" ng-click="getchield(v.id,v.id)"></span>\
                                                    <span class="static-div-minus" ng-if="v.product_category"></span>\
                                                    <input type="checkbox" id="<% v.id %>"  ng-model="C[\'Check\'+v.id]" ng-click="associate(v.id)" style="float:left; margin-left: 1px"/>\
                                                    <label style="margin-left: 20px; font-weight: normal;" ng-dblclick="editcat($event, v)" id="categoryforedit<% v.id %>" ng-bind="v.CategoryName +\' => \'+ v.AccountId"></label><small ng-if="v.service" class="text-success">Service</small>\
                                                    <Edit id="placeforedit<% v.id %>"></Edit>\
                                                </div>\
                                                <div  class="catstyletwo" style="margin-left:20px;"></div>\
                                         </div>');
                $compile(content)($scope);
                $("#par" + objid + " div").eq(1).html(content);
            });
        } else {
            $("#brows" + objid).removeAttr('brows').addClass('fa-plus').removeClass('fa-minus');
            $("#par" + objid + " div").eq(1).html('');
        }
    };
    //convert string to integer 
    $scope.parseId = function (val) {

        val.product_category = parseInt(val.product_category);
    };
    $scope.delete_category = function (id) {
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
            var delete_category = $http.get('delete-account-category/' + id);
            delete_category.then(function (result) {
                swal("Deleted!", result.data, "success");
                $scope.resetscope();
            });
        });
    };
});