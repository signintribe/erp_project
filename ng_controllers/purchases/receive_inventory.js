TaskTierApp.controller('ReceiveInventoryController', function ($scope, $http) {
    $scope.searchPendingPo = function(pending_po, $status){
        var PendingPo = $http.get('get-po/' + pending_po + '/' +  $status);
        PendingPo.then(function (r) {
            $scope.pendingPo = r.data;
        });
    };

    $scope.ri = {};
    $scope.po = {};
    $scope.selectPo = function(po){
        $scope.po = po;
        $scope.pendingPo = {};
        $scope.ri.po_id = po.id;
        $scope.ri.old_net_amount = po.net_amount;
        $scope.ri.due_quantity = po.quantity;
        $scope.ri.old_gross_price = po.gross_price;
        $scope.ri.product_id = po.product_id;
        $("#checklist").show();
        $("#TaxRow").show();
        $("#LogisticRow").show();
        $scope.getChecklist(po.id);
        $scope.getTaxes(po.id);
        $scope.getDeliveryCharges(po.id);
        $("#po_details").show();
        $("#received").show();
        $("#remaining").show();
    };

    $scope.lessQuantity = function(qty){
        if(parseInt($scope.po.quantity) != 0){
            $scope.po.gross_price = $scope.po.unit_price * qty;
            $scope.ri.new_gross_price = $scope.po.gross_price;
            $scope.ri.remaining_quantity = parseInt($scope.po.quantity) - parseInt($scope.po.received_qty) - qty;
            $scope.ri.pogross_price = $scope.po.gross_price * $scope.ri.remaining_quantity;
            $scope.po.net_amount = (parseInt($scope.po.gross_price) + parseFloat($scope.totalTaxes) + parseInt($scope.po.total_delivery_charges)) - parseInt($scope.po.discount_amount);
            $scope.ri.ponet_amount = (parseInt($scope.ri.pogross_price) + parseFloat($scope.totalTaxes) + parseInt($scope.po.total_delivery_charges)) - parseInt($scope.po.discount_amount);
            console.log($scope.po.gross_price, $scope.totalTaxes, $scope.po.total_delivery_charges, $scope.po.discount_amount);
            $scope.ri.new_net_amount = $scope.po.net_amount;
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
            alert($scope.totalTaxes);
        });
    };

    $scope.getDeliveryCharges = function(po_id){
        var DeliveryCharges = $http.get('get-logistics/' + po_id);
        DeliveryCharges.then(function (r) {
            $scope.logisticscharges = r.data.logistics;
            $scope.po.total_delivery_charges = r.data.total_delivery_charges;
        });
    };

    $scope.POForEdit = function(pending_po, $status){
        var PendingPo = $http.get('get-po/' + pending_po + '/' +  $status);
        PendingPo.then(function (r) {
            $scope.po = {};
            $scope.po = r.data[0];
            $("#checklist").show();
            $("#TaxRow").show();
            $("#LogisticRow").show();
            $scope.getChecklist($scope.po.id);
            $scope.getTaxes($scope.po.id);
            $scope.getDeliveryCharges($scope.po.id);
            $scope.ri.po_id = $scope.po.id;
            $scope.ri.old_net_amount = $scope.po.net_amount;
            $scope.ri.due_quantity = $scope.po.quantity;
            $scope.ri.old_gross_price = $scope.po.gross_price;
            $scope.ri.product_id = $scope.po.product_id;
            $scope.ri.new_gross_price = $scope.po.gross_price;
            $("#po_details").show();
            $("#receivedforedit").show();
            $("#remaining").show();
            $("#showcalc").show();
            $scope.netAmount();
        });
    };

    $scope.netAmount = function(){
        $scope.po.received_qty = $scope.ri.received_qty;
        $scope.po.gross_price = $scope.po.unit_price * $scope.ri.received_qty;
        $scope.ri.remaining_quantity = parseInt($scope.po.quantity) - parseInt($scope.po.received_qty);
        $scope.ri.pogross_price = $scope.po.gross_price * $scope.ri.remaining_quantity;
        $scope.po.net_amount = (parseInt($scope.po.gross_price) + parseFloat($scope.totalTaxes) + parseInt($scope.po.total_delivery_charges)) - parseInt($scope.po.discount_amount);
        $scope.ri.ponet_amount = (parseInt($scope.ri.pogross_price) + parseFloat($scope.totalTaxes) + parseInt($scope.po.total_delivery_charges)) - parseInt($scope.po.discount_amount);
        $scope.ri.new_net_amount = $scope.po.net_amount;
    };

    $scope.editRI = function(ri_id){
        var ReceiveInventory = $http.get('recieve-inventory/' + ri_id + '/edit');
        ReceiveInventory.then(function (r) {
            $scope.ri = r.data.data;
            $scope.ri.received_qty = 0;
            $scope.POForEdit($scope.ri.po_number, $scope.ri.po_status);
        });
    };

    $scope.saveReceiveInventory = function(){
        if($scope.ri.remaining_quantity >= 0){
            if (!$scope.ri.invoice_number || !$scope.ri.pending_po || !$scope.ri.received_qty) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                $("#loader").removeClass("fa-save").addClass('fa-spinner fa-pulse fa-sw');
                var Data = new FormData();
                angular.forEach($scope.ri, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('recieve-inventory', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    if(res.data.status == true){
                        swal({
                            title: "Save!",
                            text: res.data.message,
                            type: "success"
                        });
                        $scope.getReceiveInventroy();
                        $scope.ri = {};
                        $("#checklist").hide();
                        $("#TaxRow").hide();
                        $("#LogisticRow").hide();
                        $("#po_details").hide();
                        $scope.po.total_delivery_charges = 0;
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

    $scope.getReceiveInventroy = function(){
        $scope.ris = {};
        $scope.limit = 30;
        $scope.offset = 0;
        $scope.array = {
            'limit' : $scope.limit,
            'offset' : $scope.offset,
            'company_id' : $("#company_id").val()
        };
        $scope.array = JSON.stringify($scope.array);
        var RI = $http.get('recieve-inventory/' + $scope.array);
        RI.then(function (r) {
            if(r.data.length > 0){
                $scope.ris = r.data;
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
        var POInfo = $http.get('recieve-inventory/' + $scope.array);
        POInfo.then(function (r) {
            if(r.data.length> 0 ){
                $scope.ris = $scope.ris.concat(r.data);
                $scope.offset += $scope.limit;
                $("#loadMorebtn").show();
            }else{
                $("#loadMorebtn").hide();
                $scope.nomore = "There is no more record found";
            }
        });
    };

    $scope.deleteRI = function(inv_id){
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
            $http.delete('recieve-inventory/' + inv_id).then(function (response) {
                if(response.data.status == true){
                    $scope.getReceiveInventroy();
                    swal("Deleted!", response.data.message, "success");
                }else{
                    swal("Not Deleted!", response.data.message, "error");
                }
            });
        });
    };
});