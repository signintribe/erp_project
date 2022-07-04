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
        $scope.po.product_name = product.product_name;
        $scope.po.product_id = product.id;
        $scope.allinventories = {};
    };

    /**
     * Add gross price with quantity
     */
     $scope.po.quantity = 0;
    $scope.grossPrice = function(){
        if($scope.po.quantity == 0){
            $scope.po.gross_price = parseInt($scope.po.unit_price);
        }else{
            $scope.po.gross_price = parseInt($scope.po.unit_price) * parseInt($scope.po.quantity);
        }
        $scope.po.net_amount = $scope.po.gross_price;
        $("#TaxRow").show();
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
        $scope.po.discount_amount = 0;
        $("#LogisticRow").show();
    };

    $scope.removeTax = function(tax){
        $("#addtax"+tax.id).show();
    };

    $scope.chnageCheckList = function(){
        $("#checklist").show();
        $("#getchecklist").hide();
    };
    
    $scope.cancelTax = function(){
        /* $scope.AddTaxes = [];
        $scope.po.tax_details = "";
        $scope.po.net_amount -= $scope.totalTaxes;
        $scope.totalTaxes = 0; */
        $scope.AddTaxes = [];
        $scope.po.tax_details = "";
        $scope.po.net_amount -= $scope.totalTaxes;
        $scope.totalTaxes = 0;
        $("#LogisticRow").hide();
        $scope.logisticscharges = [];
        $scope.po.net_amount -= $scope.po.total_delivery_charges;
        $scope.po.total_delivery_charges = 0;
        $scope.getLogisticInfo();
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
        //$scope.po.logistic_type = charges;
        $scope.po.net_amount += parseInt(charges);
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
        $scope.limit = 30;
        $scope.offset = 0;
        $scope.array = {
            'limit' : $scope.limit,
            'offset' : $scope.offset,
            'company_id' : $("#company_id").val()
        };
        $scope.array = JSON.stringify($scope.array);
        var POInfo = $http.get('get-purchase-order-info/' + $scope.array);
        POInfo.then(function (r) {
            if(r.data.data.length> 0 ){
                $scope.POInfo = r.data.data;
                $scope.offset += $scope.limit;
                $("#loadMorebtn").show();
            }else{
                $("#loadMorebtn").hide();
                $scope.nomore = "There is no record found";
            }
        });
    };

    $scope.loadMore = function () {
        $scope.array = {
            'limit' : $scope.limit,
            'offset' : $scope.offset,
            'company_id' : $("#company_id").val()
        };
        $scope.array = JSON.stringify($scope.array);
        var POInfo = $http.get('get-purchase-order-info/' + $scope.array);
        POInfo.then(function (r) {
            if(r.data.data.length> 0 ){
                $scope.POInfo = r.data.data;
                $scope.offset += $scope.limit;
                $("#loadMorebtn").show();
            }else{
                $("#loadMorebtn").hide();
                $scope.nomore = "There is no record found";
            }
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
                if(res.data.status == true){
                    swal({
                        title: "Save!",
                        text: res.data.message,
                        type: "success"
                    });
                    $scope.po = {};
                    $("#checklist").show();
                    $("#getchecklist").hide();
                    $("#TaxRow").hide();
                    $("#LogisticRow").hide();
                    $scope.po.total_delivery_charges = 0;
                    $scope.totalTaxes = 0;
                    $scope.AddTaxes = {};
                    $scope.logisticscharges = {};
                    $scope.getPoInfo();
                    $("#loader").removeClass("fa-spinner fa-pulse fa-sw").addClass('fa-save');
                }else{
                    swal({
                        title: "Warning!",
                        text: res.data.message,
                        type: "warning"
                    });
                    $("#loader").removeClass("fa-spinner fa-pulse fa-sw").addClass('fa-save');
                }
            });
        }
    };
    
    $scope.deletePO = function(id){
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
            $http.delete('delete-purchase-order/' + id).then(function (response) {
                if(response.data.status == true){
                    $scope.getPoInfo();
                    swal("Deleted!", response.data.message, "success");
                }else{
                    swal("Not Deleted!", response.data.message, "error");
                }
            });
        });
    };

    $scope.editPO = function(po_id){
        $http.get('edit-purchaseorder/' + po_id).then(function (response){
            $scope.po = response.data.po[0];
            $scope.po.apply_to = response.data.po[0].quotation_number;
            $scope.po.vendor = response.data.po[0].organization_name;
            if(response.data.checklist.length > 0){
                $("#checklist").hide();
                $("#getchecklist").show();
                $scope.getselectedchecklist = response.data.checklist;
            }
            $("#TaxRow").show();
            $scope.AddTaxes = response.data.taxdetail;
            $scope.totalTaxes = response.data.totalTax;
            $("#LogisticRow").show();
            $scope.logisticscharges = response.data.delivery;
            $scope.po.total_delivery_charges = response.data.total_delivery_charges;
            $scope.po.net_amount = parseFloat(response.data.po[0].quotation.net_amount);
            $("#quotation_status").show();
        });
    };

    $scope.cancelPurchaseOrder = function(){
        $scope.po = {};
        $("#checklist").show();
        $("#getchecklist").hide();
        $("#TaxRow").hide();
        $("#LogisticRow").hide();
        $scope.po.total_delivery_charges = 0;
        $scope.totalTaxes = 0;
        $scope.totalTaxes = {};
        $scope.logisticscharges = {};
    };
});