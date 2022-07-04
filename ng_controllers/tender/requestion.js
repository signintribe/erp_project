CreateTierApp.controller('RequestionController', function ($scope, $http) {
    $('#requestion_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    
    $('#require_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#require_till').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $scope.resetscope = function(){
        $scope.request = {};
        $scope.get_departments();
        $scope.getEmployees();
        $scope.getRequestion();
    };

    $scope.getRequestion = function () {
        $("#recordloader").addClass('fa fa-spinner fa-sw fa-3x fa-pulse');
        $scope.offset = 0;
        $scope.limit = 30;
        var array = {
            'company_id' : $("#company_id").val(),
            'limit' : $scope.limit,
            'offset' : $scope.offset
        } 
        $scope.vals = JSON.stringify(array);
        $http.get('maintain-requestion/' + $scope.vals).then(function (response) {
            if (response.data.data.length > 0) {
                $scope.requestion = response.data.data;
                $scope.offset += $scope.limit;
                $("#recordloader").removeClass('fa fa-spinner fa-sw fa-3x fa-pulse');
            }else{
                $scope.nomore = 'There is no records found';
                $("#recordloader").removeClass('fa fa-spinner fa-sw fa-3x fa-pulse');
            }
        });
    };

    $scope.getSingleRequestion = function (request_id) {
        $http.get('maintain-requestion/' + request_id + '/edit').then(function (response) {
            if(response.data.status == true){
                $scope.request = response.data.data[0];
            }else{
                $scope.nodatafound = response.data.message;
            }
        });
    };

    $scope.loadMore = function () {
        $("#loading").addClass('fa-pulse fa-sw');
        var array = {
            'company_id' : $("#company_id").val(),
            'limit' : $scope.limit,
            'offset' : $scope.offset
        } 
        $scope.vals = JSON.stringify(array);
        $http.get('maintain-requestion/' + $scope.vals).then(function (response) {
            if (response.data.data.length > 0) {
                $scope.requestion = $scope.requestion.concat(response.data.data);
                $scope.offset += $scope.limit;
                $("#loading").removeClass('fa-pulse fa-sw');
            }else{
                $scope.nomore = 'There is no more records';
                $("#loading").removeClass('fa-pulse fa-sw');
            }
        });
    };

    $scope.saveRequestion = function(){
        if (!$scope.request.requestion_date || !$scope.request.requestion_no) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $scope.request.company_id = $("#company_id").val();
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.request, function (v, k) {
                Data.append(k, v);
            });
            $http.post('maintain-requestion', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                if(res.data.status == true){
                    swal({
                        title: "Save!",
                        text: res.data.message,
                        type: "success"
                    });
                    $("#loader").removeClass('fa-spinner fa-fw fa-pulse').addClass('fa-save');
                    $scope.request = {};
                    $scope.getRequestion();
                }else{
                    swal({
                        title: "Not Save!",
                        text: res.data.message,
                        type: "error"
                    });
                }
            });
        }
    };

    $scope.get_departments = function () {
        $http.get($("#appurl").val() + 'company/getdepartments').then(function (response) {
            if (response.data.length > 0) {
                $scope.departments = response.data;
            }
        });
    };

    $scope.getInventory = function (barcode) {
        if(barcode){
            $http.get($("#appurl").val() + 'search-inventory/' + barcode).then(function (response) {
                if (response.data.length > 0) {
                    $("#select_product").slideDown('slow');
                    $scope.allinventories = response.data;
                    $scope.noinventories = "";
                }else{
                    $scope.noinventories = barcode;
                    $scope.allinventories = "";
                }
            });
        }else{
            $scope.allinventories = "";
        }
    };
    
    $scope.getProductId = function(product_id, product_name){
        $scope.request.product_id = product_id;
        $scope.request.product_name = product_name;
        $scope.allinventories = {};
        $("#select_product").slideUp('slow');
    };

    $scope.getEmployees = function () {
        $(".loader").html('<div class="square-path-loader"></div>');
        $http.get($("#appurl").val() + 'hr/getEmployees/' + $("#company_id").val()).then(function (response) {
            if (response.data.length > 0) {
                $scope.Users = response.data;
                $(".loader").html('');
            }else{
                $(".loader").html('');
            }
        });
    };

    $scope.deleteRequestion = function(request_id){
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
            $http.delete('maintain-requestion/' + request_id).then(function (response) {
                if(response.data.status == true){
                    $scope.getRequestion();
                    swal("Deleted!", response.data.message, "success");
                }else{
                    swal("Not Deleted!", response.data.message, "error");
                }
            });
        });
    };
});