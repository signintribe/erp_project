CreateTierApp.controller('viewLogisticsController', function ($scope, $http) {
    $("#sourcing").addClass('menu-open');
    $("#sourcing a[href='#']").addClass('active');
    $("#view-logistics").addClass('active');
    $scope.getLogisticInfo = function(){
        $scope.logisticsInfo = {};
        $http.get('get-logistics/' + $("#company_id").val()).then(function (response) {
            if (response.data.length > 0) {
                $scope.logisticsInfo = response.data;
            }
        });
    };

    $scope.deleteLogisticInfo = function (id) {
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
            $http.delete('delete-logistic/' + id).then(function (response) {
                if(response.data.status == true){
                    $scope.getLogisticInfo();
                    swal("Deleted!", response.data.message, "success");
                }else{
                    swal("Not Deleted!", response.data.message, "error");
                }

            });
        });
    };
});