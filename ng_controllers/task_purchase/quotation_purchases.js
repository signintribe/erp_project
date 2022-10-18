TaskTierApp.controller('QuotationPurchaseController', function ($scope, $http) {
    $scope.pq = {};
    $('#quotation_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#quotation_till').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#delivery_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $scope.appurl = $("#appurl").val();
    $scope.pq.net_amount = 0;
    $scope.getAppliedTo = function(applied_entity, apply_to){
        if(apply_to == "Tender"){
            $http.get($scope.appurl + 'tender/get-tenders-for-quotation/' + applied_entity).then(function (response) {
                if (response.data.length > 0) {
                    $scope.tenders = response.data;
                }
            });
        }else if(apply_to == "Requestion"){
            $scope.tenders = {};
            $http.get($scope.appurl + 'tender/get-requestion-for-quotation/' + applied_entity).then(function (response) {
                if (response.data.length >= 0) {
                    $scope.requestions = response.data;
                }
            });
        }
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
       console.log($scope.checkList);
       $scope.pq.checklist = JSON.stringify($scope.checkList);
   };

   $scope.apply_to = function(){
        $scope.pq.applied_entity= '';
        $scope.pq.applied_id = '';
   };

   $scope.fillTender = function(tender){
        $scope.pq.applied_entity = tender.tender_no;
        $scope.pq.applied_id = tender.id;
        $scope.tenders = {};
   };

   $scope.fillRequestion = function(req){
        $scope.pq.applied_entity = req.requestion_no;
        $scope.pq.applied_id = req.id;
        $scope.requestions = {};
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
        $scope.pq.product_name = product.product_name;
        $scope.pq.product_id = product.id;
        $scope.allinventories = {};
    };

    /**
     * Add gross price with quantity
     */
     $scope.pq.quantity = 0;
    $scope.grossPrice = function(){
        if($scope.pq.quantity == 0){
            $scope.pq.gross_price = parseInt($scope.pq.unit_price);
        }else{
            $scope.pq.gross_price = parseInt($scope.pq.unit_price) * parseInt($scope.pq.quantity);
        }
        $scope.pq.net_amount = $scope.pq.gross_price;
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
        $scope.pq.tax_details = JSON.stringify($scope.AddTaxes);
        $("#addtax"+tax.id).hide();
        $scope.totalTaxes += parseFloat(tax.tax_percentage);
        $scope.totalTaxes = parseFloat($scope.totalTaxes.toFixed(2));
        $scope.pq.net_amount = parseFloat($scope.pq.gross_price) + parseFloat($scope.totalTaxes); 
        $scope.pq.discount_amount = 0;
        $("#LogisticRow").show();
    };

    $scope.removeTax = function(tax){
        $("#addtax"+tax.id).show();
    };

    $scope.cancelTax = function(){
        $scope.AddTaxes = [];
        $scope.pq.tax_details = "";
        $scope.pq.net_amount -= $scope.totalTaxes;
        $scope.totalTaxes = 0;
        $("#LogisticRow").hide();
        $scope.logisticscharges = [];
        $scope.pq.net_amount -= $scope.pq.total_delivery_charges;
        $scope.pq.total_delivery_charges = 0;
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

    $scope.pq.total_delivery_charges = 0;
    $scope.logisticscharges = [];
    $scope.addDeliveryCharges = function(charges, logistic){
        $scope.logisticscharges.push(logistic);
        $scope.pq.logistics = JSON.stringify($scope.logisticscharges);
        $scope.pq.total_delivery_charges += parseInt(charges);
        //$scope.pq.logistic_type = charges;
        $scope.pq.net_amount += charges;
        $("#addCharges" + logistic.id).hide();
    };

    $scope.cancelDeliveryCharges = function(){
        $scope.logisticscharges = [];
        $scope.pq.net_amount -= $scope.pq.total_delivery_charges;
        $scope.pq.total_delivery_charges = 0;
    };

    /**
     * Less the discount
     */
    $scope.lessDiscount = function(){
        $scope.pq.net_amount-= parseFloat($scope.pq.discount_amount);
        $scope.pq.net_amount = parseFloat($scope.pq.net_amount.toFixed(2));
    };

    $scope.searchVendor = function (vendor) {
        $scope.vendorinfo = {};
        $http.get('search-vendor/' + vendor).then(function (response) {
            if (response.data.length > 0) {
                $scope.vendorinfo = response.data;
            }
        });
    };

    $scope.getQuotation = function (quotation_id) {
        $http.get('manage-purchase-quotations/' + quotation_id + '/edit').then(function (response) {
            $scope.pq = response.data.quotation;
            $("#checklist").hide();
            $("#getchecklist").show();
            $scope.getselectedchecklist = response.data.checklist;
            $("#TaxRow").show();
            $scope.AddTaxes = response.data.taxes;
            $scope.totalTaxes = response.data.totalTax;
            $("#LogisticRow").show();
            $scope.logisticscharges = response.data.delivery;
            $scope.pq.total_delivery_charges = response.data.total_delivery_charges;
            $scope.pq.net_amount = parseFloat(response.data.quotation.net_amount);
            $("#quotation_status").show();
        });
    };

    $scope.cancekQuotation = function(){
        $scope.pq = {};
        $("#checklist").show();
        $("#getchecklist").hide();
        $("#TaxRow").hide();
        $("#LogisticRow").hide();
        $scope.pq.total_delivery_charges = 0;
        $scope.totalTaxes = 0;
        $scope.totalTaxes = {};
        $scope.logisticscharges = {};
    };
    
    $scope.chnageCheckList = function(){
        $("#checklist").show();
        $("#getchecklist").hide();
    };

    $scope.selectVendor = function(vendor){
        $scope.pq.vendor_id = vendor.id;
        $scope.pq.organization_name = vendor.organization_name;
        $scope.vendorinfo = {};
    };

    $scope.saveQuotation = function(){
        if (!$scope.pq.vendor_id || !$scope.pq.applied_id || !$scope.pq.product_id || !$scope.pq.quotation_number) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass("fa-save").addClass('fa-spinner fa-pulse fa-sw');
            var Data = new FormData();
            angular.forEach($scope.pq, function (v, k) {
                Data.append(k, v);
            });
            $http.post('manage-purchase-quotations', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                if(res.data.status == true){
                    swal({
                        title: "Save!",
                        text: res.data.message,
                        type: "success"
                    });
                    $scope.getQuotationInfo();
                    $scope.pq = {};
                    $('input:checkbox').removeAttr('checked');
                    $scope.logisticscharges = [];
                    $scope.pq.net_amount -= $scope.pq.total_delivery_charges;
                    $scope.pq.total_delivery_charges = 0;

                    $scope.AddTaxes = [];
                    $scope.pq.tax_details = "";
                    $scope.pq.net_amount -= $scope.totalTaxes;
                    $scope.totalTaxes = 0;
                    $("#LogisticRow").hide();
                    $("#TaxRow").hide();
                    $scope.logisticscharges = [];
                    $scope.pq.net_amount -= $scope.pq.total_delivery_charges;
                    $scope.pq.total_delivery_charges = 0;
                    $scope.getLogisticInfo();
                    $("#loader").removeClass("fa-spinner fa-pulse fa-sw").addClass('fa-save');
                }
            });
        }
    };

    $scope.getQuotationInfo = function () {
        $scope.limit = 30;
        $scope.offset = 0;
        $scope.array = {
            'limit' : $scope.limit,
            'offset' : $scope.offset,
            'company_id' : $("#company_id").val()
        };
        $scope.array = JSON.stringify($scope.array);
        var POInfo = $http.get('manage-purchase-quotations/' + $scope.array);
        POInfo.then(function (r) {
            if(r.data.data.length > 0){
                $scope.QuotationInfo = r.data.data;
                $scope.offset += $scope.limit;
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
        var POInfo = $http.get('manage-purchase-quotations/' + $scope.array);
        POInfo.then(function (r) {
            if(r.data.data.length > 0){
                $scope.QuotationInfo.concat(r.data.data);
                $scope.offset += $scope.limit;
            }else{
                $("#loadMorebtn").hide();
                $scope.nomore = "There is no more record found";
            }
        });
    };

    $scope.deleteQuotation = function (id) {
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
            $http.delete('manage-purchase-quotations/' + id).then(function (response) {
                if(response.data.status == true){
                    $scope.getQuotationInfo();
                    swal("Deleted!", response.data.message, "success");
                }else{
                    swal("Not Deleted!", response.data.message, "error");
                }
            });
        });
    };
});