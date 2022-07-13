TaskTierApp.controller('QuotationSalesController', function ($scope, $http) {
    $scope.sq = {};
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
    $scope.sq.net_amount = 0;
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
       $scope.sq.checklist = JSON.stringify($scope.checkList);

   };

   $scope.apply_to = function(){
        $scope.sq.applied_entity= '';
        $scope.sq.applied_id = '';
   };

   $scope.fillTender = function(tender){
        $scope.sq.applied_entity = tender.tender_no;
        $scope.sq.applied_id = tender.id;
        $scope.tenders = {};
   };

   $scope.fillRequestion = function(req){
        $scope.sq.applied_entity = req.requestion_no;
        $scope.sq.applied_id = req.id;
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
        $scope.sq.product_name = product.product_name;
        $scope.sq.product_id = product.id;
        $scope.allinventories = {};
    };

    /**
     * Add gross price with quantity
     */
     $scope.sq.quantity = 0;
    $scope.grossPrice = function(){
        if($scope.sq.quantity == 0){
            $scope.sq.gross_price = parseInt($scope.sq.unit_price);
        }else{
            $scope.sq.gross_price = parseInt($scope.sq.unit_price) * parseInt($scope.sq.quantity);
        }
        $scope.sq.net_amount = $scope.sq.gross_price;
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
        $scope.sq.tax_details = JSON.stringify($scope.AddTaxes);
        $("#addtax"+tax.id).hide();
        $scope.totalTaxes += parseFloat(tax.tax_percentage);
        $scope.totalTaxes = parseFloat($scope.totalTaxes.toFixed(2));
        $scope.sq.net_amount = parseFloat($scope.sq.gross_price) + parseFloat($scope.totalTaxes); 
        $scope.sq.discount_amount = 0;
        $("#LogisticRow").show();
    };

    $scope.removeTax = function(tax){
        $("#addtax"+tax.id).show();
    };

    $scope.cancelTax = function(){
        $scope.AddTaxes = [];
        $scope.sq.tax_details = "";
        $scope.sq.net_amount -= $scope.totalTaxes;
        $scope.totalTaxes = 0;
        $("#LogisticRow").hide();
        $scope.logisticscharges = [];
        $scope.sq.net_amount -= $scope.sq.total_delivery_charges;
        $scope.sq.total_delivery_charges = 0;
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

    $scope.sq.total_delivery_charges = 0;
    $scope.logisticscharges = [];
    $scope.addDeliveryCharges = function(charges, logistic){
        $scope.logisticscharges.push(logistic);
        $scope.sq.logistics = JSON.stringify($scope.logisticscharges);
        $scope.sq.total_delivery_charges += parseInt(charges);
        //$scope.sq.logistic_type = charges;
        $scope.sq.net_amount += charges;
        $("#addCharges" + logistic.id).hide();
    };

    $scope.cancelDeliveryCharges = function(){
        $scope.logisticscharges = [];
        $scope.sq.net_amount -= $scope.sq.total_delivery_charges;
        $scope.sq.total_delivery_charges = 0;
    };

    /**
     * Less the discount
     */
    $scope.lessDiscount = function(){
        $scope.sq.net_amount-= parseFloat($scope.sq.discount_amount);
        $scope.sq.net_amount = parseFloat($scope.sq.net_amount.toFixed(2));
    };

    $scope.searchCustomer = function (customer) {
        $scope.customerinfo = {};
        $http.get($scope.appurl + 'customer/search-customer/' + customer).then(function (response) {
            if (response.data.length > 0) {
                $scope.customerinfo = response.data;
            }
        });
    };

    $scope.getQuotation = function (quotation_id) {
        $http.get('quotation-sale/' + quotation_id + '/edit').then(function (response) {
            $scope.sq = response.data.quotation;
            $("#checklist").hide();
            $("#getchecklist").show();
            $scope.getselectedchecklist = response.data.checklist;
            $("#TaxRow").show();
            $scope.AddTaxes = response.data.taxes;
            $scope.totalTaxes = response.data.totalTax;
            $("#LogisticRow").show();
            $scope.logisticscharges = response.data.delivery;
            $scope.sq.total_delivery_charges = response.data.total_delivery_charges;
            $scope.sq.net_amount = parseFloat(response.data.quotation.net_amount);
            $("#quotation_status").show();
        });
    };

    $scope.cancekQuotation = function(){
        $scope.sq = {};
        $("#checklist").show();
        $("#getchecklist").hide();
        $("#TaxRow").hide();
        $("#LogisticRow").hide();
        $scope.sq.total_delivery_charges = 0;
        $scope.totalTaxes = 0;
        $scope.totalTaxes = {};
        $scope.logisticscharges = {};
    };
    
    $scope.chnageCheckList = function(){
        $("#checklist").show();
        $("#getchecklist").hide();
    };

    $scope.selectCustomer = function(customer){
        $scope.sq.customer_id = customer.id;
        $scope.sq.customer_name = customer.customer_name;
        $scope.customerinfo = {};
    };

    $scope.saveQuotation = function(){
        if (!$scope.sq.customer_id || !$scope.sq.applied_id || !$scope.sq.product_id || !$scope.sq.quotation_number) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass("fa-save").addClass('fa-spinner fa-pulse fa-sw');
            var Data = new FormData();
            angular.forEach($scope.sq, function (v, k) {
                Data.append(k, v);
            });
            $http.post('quotation-sale', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                if(res.data.status == true){
                    swal({
                        title: "Save!",
                        text: res.data.message,
                        type: "success"
                    });
                    $scope.getQuotationInfo();
                    $scope.sq = {};
                    $('input:checkbox').removeAttr('checked');
                    $scope.logisticscharges = [];
                    $scope.sq.net_amount -= $scope.sq.total_delivery_charges;
                    $scope.sq.total_delivery_charges = 0;

                    $scope.AddTaxes = [];
                    $scope.sq.tax_details = "";
                    $scope.sq.net_amount -= $scope.totalTaxes;
                    $scope.totalTaxes = 0;
                    $("#LogisticRow").hide();
                    $("#TaxRow").hide();
                    $scope.logisticscharges = [];
                    $scope.sq.net_amount -= $scope.sq.total_delivery_charges;
                    $scope.sq.total_delivery_charges = 0;
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
        var POInfo = $http.get('quotation-sale/' + $scope.array);
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
        var POInfo = $http.get('quotation-sale/' + $scope.array);
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
            $http.delete('quotation-sale/' + id).then(function (response) {
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