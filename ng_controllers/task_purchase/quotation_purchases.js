TaskTierApp.controller('QuotationPurchaseController', function ($scope, $http) {
   
    $scope.getAppliedTo = function(applied_entity, apply_to){
        if(apply_to == "Tender"){
            $http.get('get-tenders-for-quotation/' + applied_entity).then(function (response) {
                if (response.data.length > 0) {
                    $scope.tenders = response.data;
                }
            });
        }else if(apply_to == "Requestion"){
            $http.get('product-categories').then(function (response) {
                if (response.data.length > 0) {
                    $scope.productCategories = response.data;
                }
            });
        }
   };

   $scope.fillTender = function(tender){
        $scope.pq.applied_entity = tender.tender_name;
        $scope.tenders = {};
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




});