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
   
});