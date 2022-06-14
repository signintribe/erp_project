TaskTierApp.controller('POController', function ($scope, $http) {
    $("#purchases").addClass('menu-open');
    $("#purchases a[href='#']").addClass('active');
    $("#purchase-order").addClass('active');
    $scope.po = {};
    $scope.appurl = $("#appurl").val();
    /**
     * 
     * @param {*} applied_to 
     * New Functions get quotation of search value
     */
    $scope.getAppliedTo = function (applied_to) {
        var Quotations = $http.get('get-quotations/' + applied_to);
        Quotations.then(function (r) {
            $scope.quotation = r.data;
        });
    };

    $scope.checkList = [];
    /**
     * 
     * @param {*} list 
     * Add check list into array pass to controller
     */
    $scope.getCheckList = function(list){
        alert(list);
        let index = $scope.checkList.indexOf(list);
        if(index == -1){
            $scope.checkList.push(list);
        }else{
            $scope.checkList.splice(index, 1);
        }
        
    };

    /**
     * 
     * @param {*} quot 
     * Assign Quotation id pass to variable
     */
    $scope.assignQuotation = function(quot){
        $scope.po.quotation_id = quot.id;
        $scope.quotation = {};
    };

    /**
     * Get all taxes for adding in price list
     */
    $scope.getCompanyTaxes = function () {
        $http.get($scope.appurl + 'bank/manage-tax/'+ $("#company_id").val()).then(function (response) {
            if (response.data.status == true) {
                $scope.Taxes = response.data.data;
            }
        });
    };

    /**
     * 
     * @param {*} tax 
     * Taxes add with price
     */
    $scope.AddTaxes = [];
    $scope.totalTaxes = 0;
    $scope.selectedTax = function(tax){
        $scope.AddTaxes.push(tax);
        $("#addtax"+tax.id).hide();
        $scope.totalTaxes += parseFloat(tax.tax_percentage);
        $scope.totalTaxes = parseFloat($scope.totalTaxes.toFixed(2));
    };

    $scope.cancelTax = function(){
        $scope.AddTaxes = [];
        $scope.totalTaxes = 0;
    };






    /**
     * These are the old functions start
     */
    $scope.getAccounts = function () {
        var Accounts = $http.get($scope.appurl + 'AllchartofAccount');
        Accounts.then(function (r) {
            $scope.Accounts = r.data;
        });
    };

    $scope.getVendorInfo = function () {
        $scope.vendors = {};
        $http.get($scope.appurl+'vendor/maintain-vendor-information').then(function (response) {
            if (response.data.length > 0) {
                $scope.vendors = response.data;
            }
        });
    };

    $scope.getVendors = function (ven_id) {
        $scope.vendorinfo = {};
        $http.get('vendor/get-vendor/' + ven_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.vendorinfo = response.data;
            }
        });
    };
    
    $scope.getInventoryInfo = function(){
        $scope.products = {};
        $http.get($scope.appurl+'get-inventory/0/30').then(function (response) {
            if (response.data.length > 0) {
                $scope.products = response.data;
            }
        });
    };
    
    $scope.allproducts = [];
    $scope.addToCart = [];
    $scope.getProductInfo = function(pro_id){
        $http.get('get_pro_info/' + pro_id).then(function (response){
            $scope.allproducts.push(response.data[0]);
        });
    };

    $scope.addProduct = function(pro){
        if(pro.quantity){
            $scope.total = parseInt(pro.unit_price) * parseInt(pro.quantity) - parseInt(pro.discount);
            pro.total_price = $scope.total - parseInt(pro.taxes);
            $("#show").slideDown('slow');
            $("#add" + pro.product_id).hide('slow');
            $scope.addToCart.push(pro);
            //$scope.po = [].concat($scope.po , $scope.addToCart);
            //angular.merge($scope.po , $scope.addToCart);
            //$scope.po = angular.merge($scope.po , $scope.addToCart);
        }else{
            alert('Please Add Quantity');
        }
    };

    $scope.mergeArray = [];
    $scope.savePurchaseOrder = function(){
        /* $scope.mergeArray = [].concat($scope.po , $scope.addToCart);
        $scope.po = angular.merge($scope.po, $scope.mergeArray); */
        //$scope.po = angular.merge($scope.po , cart);
        //$scope.po = angular.merge($scope.po , $scope.addToCart);
        //$scope.po.push($scope.po);
         var order = JSON.stringify($scope.addToCart);
          $scope.po.orderDetail = order;
        if (!$scope.po.vendor_id) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            console.log($scope.po);
            var Data = new FormData();
            angular.forEach($scope.po, function (v, k) {
                Data.append(k, v);
            });
            $http.post('save-purchase-order', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
            });
        }
    };
    
});