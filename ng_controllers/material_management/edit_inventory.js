CreateTierApp.controller('InventoryController', function ($scope, $http) {
    $("#mstrial-management").addClass('menu-open');
    $("#mstrial-management a[href='#']").addClass('active');
    $("#view-inventory").addClass('active');
    $scope.appurl = $("#appurl").val();
    $scope.getAccounts = function () {
        var Accounts = $http.get($scope.appurl + 'AllchartofAccount');
        Accounts.then(function (r) {
            $scope.Accounts = r.data;
        });
    };
    $scope.inventory = {};
    $scope.change_category = function(){
        $('#categories').show('slow');
    };
    $scope.saveInventory = function(){
        $scope.inventory.attributes = JSON.stringify($scope.attrvals);
        $scope.inventory.taxes_included = JSON.stringify($scope.alltaxes);
        //console.log($scope.inventory);
        if (!$scope.inventory.product_name || !$scope.inventory.barcode_id) {
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
            $http.post($scope.appurl + 'save-inventory', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                if(res.data.status == true){
                    swal({
                        title: "Save!",
                        text: res.data.message,
                        type: "success"
                    });
                }else{
                    swal('Warning!', res.data.message, 'warning');
                }
                $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
            });
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


            $("#addtax"+taxid).hide();
            $scope.alltaxes.push(taxid);
            console.log($scope.alltaxes);
        }else{
            swal('Warning', 'Please add gross price first', 'warning');
        }
    };

    $scope.getCompanyTaxes = function () {
        $http.get($scope.appurl + 'bank/manage-tax/'+ $("#company_id").val()).then(function (response) {
            if (response.data.status == true) {
                $scope.Taxes = response.data.data;
            }
        });
    };

    $scope.changeTaxes = function(){
        $("#selectedTaxes").hide();
        $("#changeTaxes").show();
        $scope.inventory.purchase_price = 0;
        $scope.inventory.sale_price = 0;
    };
   
    $scope.getVendors = function () {
        $scope.vendorinformations = {};
        $http.get($scope.appurl + 'vendor/maintain-vendor-information').then(function (response) {
            if (response.data.length > 0) {
                $scope.vendorinformations = response.data;
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

    $scope.addProfit = function(){
        if(!$scope.inventory.profit_type){
            swal('Warning', 'Please select profit type and add gross price first', 'warning');
        }else{
            if($scope.inventory.profit_type == 'percent'){
                if($scope.inventory.purchase_price == 0){
                    $scope.inventory.purchase_price = parseInt($scope.inventory.delivery_charges) + parseInt($scope.inventory.cost_price) + parseInt($scope.inventory.carriage_inward_charges);
                }
                $scope.inventory.sale_price = 0;
                $scope.profit = $scope.inventory.purchase_price * $scope.inventory.profit/100;
                $scope.inventory.sale_price = parseInt($scope.profit) + parseInt($scope.inventory.purchase_price);
            }else if($scope.inventory.profit_type == 'amount'){
                if($scope.purchase_price == 0){
                    $scope.purchase_price = parseInt($scope.inventory.cost_price) + parseInt($scope.inventory.carriage_inward_charges) + parseInt($scope.inventory.delivery_charges);
                }
                $scope.inventory.sale_price = 0;
                $scope.inventory.sale_price = parseInt($scope.inventory.profit) + parseInt($scope.inventory.purchase_price);
            }
        }
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

    $scope.getAttributes = function (category_id) {
        $scope.attributes = {};
        $("#attrbuts").html('<div class="square-path-loader"></div>');
        $http.get($scope.appurl + 'get-attr-values/' + category_id).then(function (response) {
            if (response.data.status == true) {
                $scope.attributes = response.data.data;
                $("#attrbuts").html('');
                //console.log($scope.attributes);
            } else {
                $("#attrbuts").html('');
            }
        });
    };
    $scope.attrvals = [];
    $scope.getAttr = function(attr_id){
        let index = $scope.attrvals.indexOf(attr_id);
        if(index == -1){
            $scope.attrvals.push(attr_id);
        }else{
            $scope.attrvals.splice(index, 1);
        }
    };

    $scope.get_category = function (category_id) {
        $http.get($scope.appurl + 'get_categories/' + category_id).then(function (response) {
            $scope.category = response.data[0];
        });
    };

    $scope.editInventoryInfo = function (id) {
        $http.get($scope.appurl + 'get-inventory-info/'+id).then(function (response) {
            $scope.inventory = response.data;
            $scope.getInventoryStock($scope.inventory.id);
            $scope.getInventoryPricing($scope.inventory.id);
            $scope.getInventoryAccount($scope.inventory.id);
            $scope.getInventoryVendor($scope.inventory.id);
            $scope.getInventoryCategory($scope.inventory.category_id);
            $scope.getInventoryAttributes($scope.inventory.category_id);
            $scope.getSelectedAttributes($scope.inventory.id);
            //console.log($scope.inventory);
        });
    };

    $scope.getInventoryStock = function(id){
        $http.get($scope.appurl + 'get-stock/'+id).then(function (response) {
            angular.extend($scope.inventory, response.data);                
        });
    };

    $scope.getInventoryPricing = function(id){
        $http.get($scope.appurl + 'get-pricing/'+id).then(function (response) {
            angular.extend($scope.inventory, response.data);
            $scope.inventory.cost_price = parseInt($scope.inventory.cost_price);
            $scope.inventory.carriage_inward_charges = parseInt($scope.inventory.carriage_inward_charges);          
            $scope.inventory.delivery_charges = parseInt($scope.inventory.delivery_charges);    
            $scope.inventory.sale_price = parseInt($scope.inventory.sale_price);    
            $scope.inventory.profit = parseInt($scope.inventory.profit);    
            $scope.getSelectedTaxes(id);      
        });
    };

    $scope.getSelectedTaxes = function (product_id) {
        $http.get($scope.appurl + 'get-seleted-taxes/' + product_id).then(function (response) {
            if (response.data.status == true) {
                $scope.SeletedTaxes = response.data.data;
            }
        });
    };

    $scope.cancelTax = function(product_id){
        $scope.getInventoryPricing(product_id);
        $("#selectedTaxes").show();
        $("#changeTaxes").hide();
    }

    $scope.getInventoryAccount = function(id){
        $http.get($scope.appurl + 'get-account/' + id).then(function (response) {
            angular.extend($scope.inventory, response.data);  
            $scope.inventory.chartof_account_cost = parseInt(response.data.chartof_account_cost);
            $scope.inventory.chartof_account_inventory = parseInt(response.data.chartof_account_inventory);
            $scope.inventory.chartof_account_sale = parseInt(response.data.chartof_account_sale);              
        });
    };

    $scope.getInventoryVendor = function(id){
        $http.get($scope.appurl + 'get-vendor/' + id).then(function (response) {
            angular.extend($scope.inventory, response.data); 
            $scope.inventory.vendor_name = parseInt(response.data.vendor_name);              
            if($scope.inventory.product_status == 0 || $scope.inventory.product_status == '0'){
                $scope.inventory.product_status = '0';                
            }else{
                $scope.inventory.product_status = '1';                
            }
        });
    };

    $scope.getInventoryCategory = function(id){
        $http.get($scope.appurl + 'get-category/' + id).then(function (response) {
            $scope.selectedCategories = response.data;
            console.log($scope.selectedCategories);
        });
    };

    $scope.getInventoryAttributes = function(id){
        $scope.catattributes = {};
        $("#attrbuts").html('<div class="square-path-loader"></div>');
        $http.get($scope.appurl + 'get-attribute/' + id).then(function (response) {
            if (response.data.status == true) {
                $scope.catattributes = response.data.data;
                $("#attrbuts").html('');
                //console.log($scope.catattributes);
            } else {
                $("#attrbuts").html('');
            }
        });
    };

    $scope.getSelectedAttributes = function(id){
        $http.get($scope.appurl + 'get-selected-atts/' + id).then(function (response) {
            $scope.SelectedAttributes = response.data;
        });
    };
});