CreateTierApp.controller('ViewInventoryController', function ($scope, $http) {
    $("#mstrial-management").addClass('menu-open');
    $("#mstrial-management a[href='#']").addClass('active');
    $("#view-inventory").addClass('active');

    $scope.getInventoryInfo = function(){
        $scope.inventoryinfo = {};
        $scope.offset = 0;
        $scope.limit = 50;
        $("#loader").addClass('fa fa-spinner fa-sw fa-3x fa-pulse');
        $http.get('get-inventory/' + $scope.offset + '/' + $scope.limit).then(function (response) {
            if (response.data.length > 0) {
                $scope.allinventories = response.data;
                $("#loader").removeClass('fa fa-spinner fa-sw fa-3x fa-pulse');
                $scope.offset += $scope.limit;
                $("#load-more-btn").show();
            }else{
                $scope.norecord = "There is no recods";
                $("#loader").removeClass('fa fa-spinner fa-sw fa-3x fa-pulse');
                $("#load-more-btn").hide();
            }
        });
    };

    $scope.loadMore = function(){
        $("#load-more").addClass('fa-sw fa-pulse');
        $http.get('get-inventory/' + $scope.offset + '/' + $scope.limit).then(function (response) {
            if (response.data.length > 0) {
                $scope.allinventories = $scope.allinventories.concat(response.data);
                $("#load-more").removeClass('fa-sw fa-pulse');
                $scope.offset += $scope.limit;
            }else{
                $scope.norecord = "There is no more recods";
                $("#load-more").removeClass('fa-sw fa-pulse');
                $("#load-more-btn").hide();
            }
        });
    };

    $scope.getInventory = function (barcode) {
        $http.get('search-inventory/' + barcode).then(function (response) {
            if (response.data.length > 0) {
                $scope.allinventories = response.data;
                $scope.noinventories = "";
            }else{
              $scope.noinventories = barcode;
              $scope.allinventories = "";
            }
        });
    };

    $scope.deleteInventoryInfo = function (id) {
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
            $http.delete('delete-inventory/' + id).then(function (response) {
                $scope.getInventoryInfo();
                swal("Deleted!", response.data, "success");
            });
        });
    };;

});