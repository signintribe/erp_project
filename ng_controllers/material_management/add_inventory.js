CreateTierApp.controller('InventoryController', function ($scope, $http) {
    $("#mstrial-management").addClass('menu-open');
    $("#mstrial-management a[href='#']").addClass('active');
    $("#add-inventory").addClass('active');
    $scope.appurl = $("#appurl").val();
    $scope.getAccounts = function () {
        var Accounts = $http.get($scope.appurl + 'AllchartofAccount');
        Accounts.then(function (r) {
            $scope.Accounts = r.data;
        });
    };
    $scope.inventory = {};


    //$scope.inventory.attr_value = [];
    //console.log($scope.inventory.attr_value);

    $scope.inventory.purchase_price = 0;
    $scope.inventory.cost_price = 0; 
    $scope.inventory.carriage_inward_charges = 0; 
    $scope.inventory.delivery_charges = 0;
    $scope.addProfit = function(){
        if(!$scope.inventory.profit_type){
            swal('Warning', 'Please select profit type and add gross price first', 'warning');
        }else{
            if($scope.inventory.profit_type == 'percent'){
                if($scope.inventory.purchase_price == 0){
                    $scope.inventory.purchase_price = $scope.inventory.delivery_charges + $scope.inventory.cost_price + $scope.inventory.carriage_inward_charges;
                }
                $scope.inventory.sale_price = 0;
                $scope.profit = $scope.inventory.purchase_price * $scope.inventory.profit/100;
                $scope.inventory.sale_price = $scope.profit + $scope.inventory.purchase_price;
            }else if($scope.inventory.profit_type == 'amount'){
                if($scope.purchase_price == 0){
                    $scope.purchase_price = $scope.inventory.cost_price + $scope.inventory.carriage_inward_charges + $scope.inventory.delivery_charges;
                }
                $scope.inventory.sale_price = 0;
                $scope.inventory.sale_price = $scope.inventory.profit + $scope.inventory.purchase_price;
            }
        }
    };
    $scope.alltaxes = [];
    $scope.selectedTax = function(taxid, tax){
        if($scope.inventory.cost_price){
            $scope.gross_price = $scope.inventory.delivery_charges + $scope.inventory.cost_price + $scope.inventory.carriage_inward_charges;
            tax_amount = $scope.gross_price * tax / 100;
            if($scope.inventory.purchase_price == 0){
                $scope.inventory.purchase_price += tax_amount + $scope.gross_price;
            }else{
                $scope.inventory.purchase_price += tax_amount;
            }
            $("#addtax"+taxid).hide();
            $scope.alltaxes.push(taxid);
            console.log($scope.alltaxes);
        }else{
            swal('Warning', 'Please add gross price first', 'warning');
        }
    };

    $scope.cancelTax = function(taxid, tax){
        if($scope.inventory.purchase_price != 0){
            $scope.gross_price = $scope.inventory.delivery_charges + $scope.inventory.cost_price + $scope.inventory.carriage_inward_charges;
            //var tax_amount = $scope.gross_price * tax / 100;
            $scope.inventory.purchase_price = $scope.gross_price;
            $scope.alltaxes = [];
            $(".btn-addtax").show();
        }
    }

    $scope.saveInventory = function(){
        //$scope.inventory.attributes = JSON.stringify($scope.attrvals);
        $scope.inventory.taxes_included = JSON.stringify($scope.alltaxes);
        console.log($scope.inventory);
        if (!$scope.inventory.product_name) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.inventory, function (v, k) {
                Data.append(k, v);
            });
            $http.post('save-inventory', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                //$scope.inventory = {};
                //$scope.alltaxes = [];
                $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
            });
        }
    };

   
    $scope.getVendors = function () {
        $scope.vendorinformations = {};
        $http.get($scope.appurl + 'vendor/maintain-vendor-information').then(function (response) {
            if (response.data.length > 0) {
                $scope.vendorinformations = response.data;
            }
        });
    };

    $scope.getCompanyTaxes = function () {
        $http.get('bank/manage-tax/'+ $("#company_id").val()).then(function (response) {
            if (response.data.status == true) {
                $scope.Taxes = response.data.data;
            }
        });
    };

    $scope.get_allcategories = function (category_id) {
        $http.get($scope.appurl + 'get_categories/' + category_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.categories = response.data;
            }
        });
    };

    $scope.get_categorywithitsparents = function (parent_id) {
        $scope.categorywithparents = {};
        $("#catone").html('<div class="square-path-loader"></div>');
        $http.get($scope.appurl + 'get-categorywithitsparents/' + parent_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.categorywithparents = response.data;
                $("#catone").html('');
            } else {
                $("#catone").html('');
                $scope.getAttributes(parent_id);
            }
        });
    };

    $scope.get_categoriesone = function (parent_id) {
        $scope.categoryiesone = {};
        $scope.categoryiestwo = {};
        $scope.categoryiesthree = {};
        $scope.categoryiesfour = {};
        $scope.categoryiesfive = {};
        $("#cattwo").html('<div class="square-path-loader"></div>');
        $http.get($scope.appurl + 'get-categorywithitsparents/' + parent_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.categoryiesone = response.data;
                $("#cattwo").html('');
            } else {
                $("#cattwo").html('');
                $scope.getAttributes(parent_id);
            }
        });
    };

    $scope.get_categoriestwo = function (parent_id) {
        $scope.categoryiestwo = {};
        $scope.categoryiesthree = {};
        $scope.categoryiesfour = {};
        $scope.categoryiesfive = {};
        $("#catthree").html('<div class="square-path-loader"></div>');
        $http.get($scope.appurl + 'get-categorywithitsparents/' + parent_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.categoryiestwo = response.data;
                $("#catthree").html('');
            } else {
                $("#catthree").html('');
                $scope.getAttributes(parent_id);
            }
        });
    };

    $scope.get_categoriesthree = function (parent_id) {
        $scope.categoryiesthree = {};
        $scope.categoryiesfour = {};
        $scope.categoryiesfive = {};
        $("#catfour").html('<div class="square-path-loader"></div>');
        $http.get($scope.appurl + 'get-categorywithitsparents/' + parent_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.categoryiesthree = response.data;
                $("#catfour").html('');
            } else {
                $("#catfour").html('');
                $scope.getAttributes(parent_id);
            }
        });
    };

    $scope.get_categoriesfour = function (parent_id) {
        $scope.categoryiesfour = {};
        $scope.categoryiesfive = {};
        $("#catfive").html('<div class="square-path-loader"></div>');
        $http.get($scope.appurl + 'get-categorywithitsparents/' + parent_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.categoryiesfour = response.data;
                $("#catfive").html('');
            } else {
                $("#catfive").html('');
                $scope.getAttributes(parent_id);
            }
        });
    };

    $scope.get_categoriesfive = function (parent_id) {
        $scope.categoryiesfive = {};
        $("#catsix").html('<div class="square-path-loader"></div>');
        $http.get($scope.appurl + 'get-categorywithitsparents/' + parent_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.categoryiesfive = response.data;
                $("#catsix").html('');
            } else {
                $("#catsix").html('');
                $scope.getAttributes(parent_id);
            }
        });
    };


    $scope.attrvalue = [];
    $scope.getAttrValue = function(id, value){
        if(value != undefined || value != ''){
            $scope.attrvalue.push({
                attr_id : id,
                attr_value : value
            });
            $scope.inventory.attributes = JSON.stringify($scope.attrvalue);
            console.log($scope.inventory.attributes);
        }
    };


    $scope.getAttributes = function (category_id) {
        $scope.attributes = {};
        $("#attrbuts").html('<div class="square-path-loader"></div>');
        $http.get($scope.appurl + 'get-attr-values/' + category_id).then(function (response) {
            if (response.data.status == true) {
                $scope.attributes = response.data.data;
                $("#attrbuts").html('');
                console.log($scope.attributes);
            } else {
                $("#attrbuts").html('');
            }
        });
    };
    
    /* $scope.attrvals = [];
    $scope.getAttr = function(attr_id){
        let index = $scope.attrvals.indexOf(attr_id);
        if(index == -1){
            $scope.attrvals.push(attr_id);
        }else{
            $scope.attrvals.splice(index, 1);
        }
    }; */

    $scope.get_category = function (category_id) {
        $http.get($scope.appurl + 'get_categories/' + category_id).then(function (response) {
            $scope.category = response.data[0];
        });
    };
});