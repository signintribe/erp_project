TaskTierApp.controller('SalesOrderController', function ($scope, $http) {
    $("#sales").addClass('menu-open');
    $("#sales a[href='#']").addClass('active');
    $("#sales-order").addClass('active');
    $('#so_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#quotation_till').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#delivery_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $scope.so = {};
    $scope.appurl = $("#appurl").val();
    $scope.so.net_amount = 0;
    /**
     * 
     * @param {*} applied_to 
     * New Functions get quotation of search value
     */
    $scope.getAppliedTo = function (applied_to) {
        var Quotations = $http.get('get-quotation-sale/' + applied_to);
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
        $scope.so.checklist = JSON.stringify($scope.checkList);
    };

    /**
     * 
     * @param {*} quot 
     * Assign Quotation id pass to variable
     */
    $scope.assignQuotation = function(quot){
        $scope.so.quotation_id = quot.id;
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
        $scope.so.product_name = product.product_name;
        $scope.so.product_id = product.id;
        $scope.allinventories = {};
    };

    /**
     * Add gross price with quantity
     */
     $scope.so.quantity = 0;
    $scope.grossPrice = function(){
        if($scope.so.quantity == 0){
            $scope.so.gross_price = parseInt($scope.so.unit_price);
        }else{
            $scope.so.gross_price = parseInt($scope.so.unit_price) * parseInt($scope.so.quantity);
        }
        $scope.so.net_amount = $scope.so.gross_price;
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
        $scope.so.tax_details = JSON.stringify($scope.AddTaxes);
        $("#addtax"+tax.id).hide();
        $scope.totalTaxes += parseFloat(tax.tax_percentage);
        $scope.totalTaxes = parseFloat($scope.totalTaxes.toFixed(2));
        $scope.so.net_amount = parseFloat($scope.so.gross_price) + parseFloat($scope.totalTaxes); 
        $scope.so.discount_amount = 0;
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
        $scope.so.tax_details = "";
        $scope.so.net_amount -= $scope.totalTaxes;
        $scope.totalTaxes = 0; */
        $scope.AddTaxes = [];
        $scope.so.tax_details = "";
        $scope.so.net_amount -= $scope.totalTaxes;
        $scope.totalTaxes = 0;
        $("#LogisticRow").hide();
        $scope.logisticscharges = [];
        $scope.so.net_amount -= $scope.so.total_delivery_charges;
        $scope.so.total_delivery_charges = 0;
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

    $scope.so.total_delivery_charges = 0;
    $scope.logisticscharges = [];
    $scope.addDeliveryCharges = function(charges, logistic){
        $scope.logisticscharges.push(logistic);
        $scope.so.logistics = JSON.stringify($scope.logisticscharges);
        console.log($scope.logisticscharges); 
        $scope.so.total_delivery_charges += parseInt(charges);
        //$scope.so.logistic_type = charges;
        $scope.so.net_amount += parseInt(charges);
        $("#addCharges" + logistic.id).hide();
    };

    $scope.cancelDeliveryCharges = function(){
        $scope.logisticscharges = [];
        $scope.so.net_amount -= $scope.so.total_delivery_charges;
        $scope.so.total_delivery_charges = 0;
    };

    /**
     * Less the discount
     */
    $scope.lessDiscount = function(){
        $scope.so.net_amount-= parseFloat($scope.so.discount_amount);
        $scope.so.net_amount = parseFloat($scope.so.net_amount.toFixed(2));
    };

    $scope.searchCustomer = function (customer) {
        $scope.customerinfo = {};
        $http.get($scope.appurl + 'customer/search-customer/' + customer).then(function (response) {
            if (response.data.length > 0) {
                $scope.customerinfo = response.data;
            }
        });
    };

    $scope.selectCustomer = function(customer){
        $scope.so.customer_id = customer.id;
        $scope.so.customer_name = customer.customer_name;
        console.log($scope.so.customer_id, )
        $scope.customerinfo = {};
    };

    $scope.getSoInfo = function () {
        $scope.limit = 30;
        $scope.offset = 0;
        $scope.array = {
            'limit' : $scope.limit,
            'offset' : $scope.offset,
            'company_id' : $("#company_id").val()
        };
        $scope.array = JSON.stringify($scope.array);
        var POInfo = $http.get('maintain-sale-order/' + $scope.array);
        POInfo.then(function (r) {
            if(r.data.data.length> 0 ){
                $scope.SOInfo = r.data.data;
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
        var POInfo = $http.get('maintain-sale-order/' + $scope.array);
        POInfo.then(function (r) {
            if(r.data.data.length> 0 ){
                $scope.SOInfo = $scope.SOInfo.concat(r.data.data);
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

    $scope.saveSaleOrder = function(){
        if (!$scope.so.customer_id || !$scope.so.quotation_id || !$scope.so.product_id || !$scope.so.so_number) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass("fa-save").addClass('fa-spinner fa-pulse fa-sw');
            var Data = new FormData();
            angular.forEach($scope.so, function (v, k) {
                Data.append(k, v);
            });
            $http.post('maintain-sale-order', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                if(res.data.status == true){
                    swal({
                        title: "Save!",
                        text: res.data.message,
                        type: "success"
                    });
                    $scope.so = {};
                    $("#checklist").show();
                    $("#getchecklist").hide();
                    $("#TaxRow").hide();
                    $("#LogisticRow").hide();
                    $scope.so.total_delivery_charges = 0;
                    $scope.totalTaxes = 0;
                    $scope.AddTaxes = {};
                    $scope.logisticscharges = {};
                    $scope.getSoInfo();
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
    
    $scope.deleteSO = function(id){
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
            $http.delete('maintain-sale-order/' + id).then(function (response) {
                if(response.data.status == true){
                    $scope.getSoInfo();
                    swal("Deleted!", response.data.message, "success");
                }else{
                    swal("Not Deleted!", response.data.message, "error");
                }
            });
        });
    };

    $scope.editSO = function(so_id){
        $http.get('maintain-sale-order/' + so_id + '/edit').then(function (response){
            $scope.so = response.data.so[0];
            $scope.so.apply_to = response.data.so[0].quotation_number;
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
            $scope.so.total_delivery_charges = response.data.total_delivery_charges;
            $scope.so.net_amount = parseFloat(response.data.po[0].quotation.net_amount);
            $("#quotation_status").show();
        });
    };

    $scope.cancelSaleOrder = function(){
        $scope.so = {};
        $("#checklist").show();
        $("#getchecklist").hide();
        $("#TaxRow").hide();
        $("#LogisticRow").hide();
        $scope.so.total_delivery_charges = 0;
        $scope.totalTaxes = 0;
        $scope.totalTaxes = {};
        $scope.logisticscharges = {};
    };
});