TaskTierApp.controller('DespetchInventoryController', function ($scope, $http) {
    $scope.searchPendingSo = function(pending_so, $status){
        var PendingSo = $http.get('get-sale-order/' + pending_so + '/' +  $status);
        PendingSo.then(function (r) {
            $scope.pendingSo = r.data;
        });
    };

    $scope.di = {};
    $scope.so = {};
    $scope.selectSo = function(so){
        $scope.so = so;
        $scope.pendingSo = {};
        $scope.di.so_id = so.id;
        $scope.di.old_net_amount = so.net_amount;
        $scope.di.due_quantity = so.quantity;
        $scope.di.old_gross_price = so.gross_price;
        $scope.di.product_id = so.product_id;
        $("#checklist").show();
        $("#TaxRow").show();
        $("#LogisticRow").show();
        $scope.getChecklist(so.id);
        $scope.getTaxes(so.id);
        $scope.getDeliveryCharges(so.id);
        $("#po_details").show();
        $("#received").show();
        $("#remaining").show();
    };

    $scope.lessQuantity = function(qty){
        if(parseInt($scope.so.quantity) != 0){
            $scope.so.gross_price = $scope.so.unit_price * qty;
            $scope.di.new_gross_price = $scope.so.gross_price;
            $scope.di.remaining_quantity = parseInt($scope.so.quantity) - parseInt($scope.so.despatch_qty) - qty;
            $scope.di.sogross_price = $scope.so.gross_price * $scope.di.remaining_quantity;
            $scope.so.net_amount = (parseInt($scope.so.gross_price) + parseFloat($scope.totalTaxes) + parseInt($scope.so.total_delivery_charges)) - parseInt($scope.so.discount_amount);
            $scope.di.sonet_amount = (parseInt($scope.di.pogross_price) + parseFloat($scope.totalTaxes) + parseInt($scope.so.total_delivery_charges)) - parseInt($scope.so.discount_amount);
            console.log($scope.so.gross_price, $scope.totalTaxes, $scope.so.total_delivery_charges, $scope.so.discount_amount);
            $scope.di.new_net_amount = $scope.so.net_amount;
        }else{
            $scope.received_all = 'Fully Received';
        }
    };

    $scope.getChecklist = function(po_id){
        var CheckList = $http.get('get-checklist/' + po_id);
        CheckList.then(function (r) {
            $scope.checList = r.data;
        });
    };

    $scope.getTaxes = function(po_id){
        var CheckList = $http.get('get-taxes/' + po_id);
        CheckList.then(function (r) {
            $scope.AddTaxes = r.data.taxes;
            $scope.totalTaxes = r.data.totalTax;
        });
    };

    $scope.getDeliveryCharges = function(po_id){
        var DeliveryCharges = $http.get('get-logistics/' + po_id);
        DeliveryCharges.then(function (r) {
            $scope.logisticscharges = r.data.logistics;
            $scope.so.total_delivery_charges = r.data.total_delivery_charges;
        });
    };

    $scope.soForEdit = function(pending_po, $status){
        var PendingPo = $http.get('get-po/' + pending_po + '/' +  $status);
        PendingPo.then(function (r) {
            $scope.so = {};
            $scope.so = r.data[0];
            $("#checklist").show();
            $("#TaxRow").show();
            $("#LogisticRow").show();
            $scope.getChecklist($scope.so.id);
            $scope.getTaxes($scope.so.id);
            $scope.getDeliveryCharges($scope.so.id);
            $scope.di.po_id = $scope.so.id;
            $scope.di.old_net_amount = $scope.so.net_amount;
            $scope.di.due_quantity = $scope.so.quantity;
            $scope.di.old_gross_price = $scope.so.gross_price;
            $scope.di.product_id = $scope.so.product_id;
            $scope.di.new_gross_price = $scope.so.gross_price;
            $("#po_details").show();
            $("#receivedforedit").show();
            $("#remaining").show();
            $("#showcalc").show();
            $scope.netAmount();
        });
    };

    $scope.netAmount = function(){
        $scope.so.received_qty = $scope.di.received_qty;
        $scope.so.gross_price = $scope.so.unit_price * $scope.di.received_qty;
        $scope.di.remaining_quantity = parseInt($scope.so.quantity) - parseInt($scope.so.received_qty);
        $scope.di.pogross_price = $scope.so.gross_price * $scope.di.remaining_quantity;
        $scope.so.net_amount = (parseInt($scope.so.gross_price) + parseFloat($scope.totalTaxes) + parseInt($scope.so.total_delivery_charges)) - parseInt($scope.so.discount_amount);
        $scope.di.ponet_amount = (parseInt($scope.di.pogross_price) + parseFloat($scope.totalTaxes) + parseInt($scope.so.total_delivery_charges)) - parseInt($scope.so.discount_amount);
        $scope.di.new_net_amount = $scope.so.net_amount;
    };

    $scope.editRI = function(ri_id){
        var ReceiveInventory = $http.get('recieve-inventory/' + ri_id + '/edit');
        ReceiveInventory.then(function (r) {
            $scope.di = r.data.data;
            $scope.di.received_qty = 0;
            $scope.soForEdit($scope.di.po_number, $scope.di.po_status);
        });
    };

    $scope.saveDespatchInventory = function(){
        if($scope.di.remaining_quantity >= 0){
            if (!$scope.di.invoice_number || !$scope.di.pending_so || !$scope.di.despatch_qty) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                $("#loader").removeClass("fa-save").addClass('fa-spinner fa-pulse fa-sw');
                var Data = new FormData();
                angular.forEach($scope.di, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('sales-invoice', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    if(res.data.status == true){
                        swal({
                            title: "Save!",
                            text: res.data.message,
                            type: "success"
                        });
                        $scope.getDespatchInventroy();
                        $scope.di = {};
                        $("#checklist").hide();
                        $("#TaxRow").hide();
                        $("#LogisticRow").hide();
                        $("#po_details").hide();
                        $scope.so.total_delivery_charges = 0;
                        $scope.totalTaxes = 0;
                        $scope.AddTaxes = {};
                        $scope.logisticscharges = {};
                        $("#loader").removeClass("fa-spinner fa-pulse fa-sw").addClass('fa-save');
                    }else if(res.data.status == false){
                        swal({
                            title: "Warning!",
                            text: res.data.message,
                            type: "warning"
                        });
                        $scope.error = res.data.message;
                        $("#loader").removeClass("fa-spinner fa-pulse fa-sw").addClass('fa-save');
                    }
                });
            }
        }else{
            swal('Warning', 'Remaing Quantity Can Not Negitive Value', 'warning');
        }
    };

    $scope.getDespatchInventroy = function(){
        $scope.dis = {};
        $scope.limit = 30;
        $scope.offset = 0;
        $scope.array = {
            'limit' : $scope.limit,
            'offset' : $scope.offset,
            'company_id' : $("#company_id").val()
        };
        $scope.array = JSON.stringify($scope.array);
        var RI = $http.get('sales-invoice/' + $scope.array);
        RI.then(function (r) {
            if(r.data.length > 0){
                $scope.dis = r.data;
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
        var POInfo = $http.get('sales-invoice/' + $scope.array);
        POInfo.then(function (r) {
            if(r.data.length> 0 ){
                $scope.dis = $scope.dis.concat(r.data);
                $scope.offset += $scope.limit;
                $("#loadMorebtn").show();
            }else{
                $("#loadMorebtn").hide();
                $scope.nomore = "There is no more record found";
            }
        });
    };

    $scope.deleteDI = function(inv_id){
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
            $http.delete('sales-invoice/' + inv_id).then(function (response) {
                if(response.data.status == true){
                    $scope.getDespatchInventroy();
                    swal("Deleted!", response.data.message, "success");
                }else{
                    swal("Not Deleted!", response.data.message, "error");
                }
            });
        });
    };
});