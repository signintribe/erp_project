TaskTierApp.controller('POController', function ($scope, $http) {
    $("#purchases").addClass('menu-open');
    $("#purchases a[href='#']").addClass('active');
    $("#purchase-order").addClass('active');
    $('#po_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#quotation_till').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#delivery_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $scope.po = {};
    $scope.appurl = $("#appurl").val();
    $scope.po.net_amount = 0;
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
        let index = $scope.checkList.indexOf(list);
        if(index == -1){
            $scope.checkList.push(list);
        }else{
            $scope.checkList.splice(index, 1);
        }
        $scope.po.checklist = JSON.stringify($scope.checkList);
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
     * @param {*} barcode 
     * Get product items
     */
    $scope.getInventory = function (barcode) {
        $http.get($scope.appurl + 'search-inventory/' + barcode).then(function (response) {
            if (response.data.length > 0) {
                $scope.allinventories = response.data;
                $scope.noinventories = "";
            }else{
              $scope.noinventories = barcode;
              $scope.allinventories = "";
            }
        });
    };

    $scope.selectProduct = function(product){
        $scope.po.product_item = product.product_name;
        $scope.po.product_id = product.id;
        $scope.allinventories = {};
    };

    /**
     * Add gross price with quantity
     */
    $scope.grossPrice = function(){
        $scope.po.gross_price = parseInt($scope.po.unit_price) * parseInt($scope.po.quantity);
        $scope.po.net_amount = $scope.po.gross_price;
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
        $scope.po.tax_details = JSON.stringify($scope.AddTaxes);
        $("#addtax"+tax.id).hide();
        $scope.totalTaxes += parseFloat(tax.tax_percentage);
        $scope.totalTaxes = parseFloat($scope.totalTaxes.toFixed(2));
        $scope.po.net_amount = parseFloat($scope.po.gross_price) + parseFloat($scope.totalTaxes); 
    };

    $scope.removeTax = function(tax){
        $("#addtax"+tax.id).show();
    };

    $scope.cancelTax = function(){
        $scope.AddTaxes = [];
        $scope.po.tax_details = "";
        $scope.po.net_amount -= $scope.totalTaxes;
        $scope.totalTaxes = 0;
    };

    /**
     * Get the logistics
     */
    $scope.getLogisticInfo = function(){
        $scope.logisticsInfo = {};
        $http.get($scope.appurl + 'sourcing/get-logistics/' + $("#company_id").val()).then(function (response) {
            if (response.data.length > 0) {
                $scope.logisticsInfo = response.data;
            }
        });
    };

    $scope.po.total_delivery_charges = 0;
    $scope.logisticscharges = [];
    $scope.addDeliveryCharges = function(charges, logistic){
        $scope.logisticscharges.push(logistic);
        $scope.po.logistics = JSON.stringify($scope.logisticscharges);
        console.log($scope.logisticscharges); 
        $scope.po.total_delivery_charges += parseInt(charges);
        $scope.po.logistic_type = charges;
        $scope.po.net_amount += $scope.po.total_delivery_charges
        $("#addCharges" + logistic.id).hide();
    };

    $scope.cancelDeliveryCharges = function(){
        $scope.logisticscharges = [];
        $scope.po.net_amount -= $scope.po.total_delivery_charges;
        $scope.po.total_delivery_charges = 0;
    };

    /**
     * Less the discount
     */
    $scope.lessDiscount = function(){
        $scope.po.net_amount-= parseFloat($scope.po.discount_amount);
        $scope.po.net_amount = parseFloat($scope.po.net_amount.toFixed(2));
    };

    $scope.searchVendor = function (vendor) {
        $scope.vendorinfo = {};
        $http.get('search-vendor/' + vendor).then(function (response) {
            if (response.data.length > 0) {
                $scope.vendorinfo = response.data;
            }
        });
    };

    $scope.selectVendor = function(vendor){
        $scope.po.vendor_id = vendor.id;
        $scope.po.vendor = vendor.organization_name;
        $scope.vendorinfo = {};
    };

    $scope.getPoInfo = function () {
        var POInfo = $http.get('get-purchase-order-info/' + $("#company_id").val());
        POInfo.then(function (r) {
            $scope.POInfo = r.data;
        });
    };
    /**
     * These are the old functions start
     */

    $scope.getVendorInfo = function () {
        $scope.vendors = {};
        $http.get($scope.appurl+'vendor/maintain-vendor-information').then(function (response) {
            if (response.data.length > 0) {
                $scope.vendors = response.data;
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

    $scope.savePurchaseOrder = function(){
        if (!$scope.po.vendor_id || !$scope.po.quotation_id || !$scope.po.product_id || !$scope.po.po_number) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass("fa-save").addClass('fa-spinner fa-pulse fa-sw');
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
                $scope.po = {};
                $("#loader").removeClass("fa-spinner fa-pulse fa-sw").addClass('fa-save');
            });
        }
    };
    
});