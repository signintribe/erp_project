TaskTierApp.controller('RequestionController', function ($scope, $http) {
    $scope.requested_department = $("#requested_dept").val();
    if($("#requested_dept").val() == 1){
        $("#hr").addClass('menu-open');
        $("#hr-active").addClass('active');
        $("#hr-requestion").addClass('active');
    }else if($("#requested_dept").val() == 2){
        $("#banking-finance").addClass('menu-open');
        $("#banking-finance-active").addClass('active');
        $("#banking-finance-requestion").addClass('active');
    }else if($("#requested_dept").val() == 3){
        $("#mm").addClass('menu-open');
        $("#mm-active").addClass('active');
        $("#mm-requestion").addClass('active');
    }else if($("#requested_dept").val() == 4){
        $("#ps").addClass('menu-open');
        $("#ps-active").addClass('active');
        $("#ps-requestion").addClass('active');
    }else if($("#requested_dept").val() == 5){
        $("#sorc").addClass('menu-open');
        $("#sorc-active").addClass('active');
        $("#sorc-requestion").addClass('active');
    }else if($("#requested_dept").val() == 6){
        $("#purchases").addClass('menu-open');
        $("#purchases-active").addClass('active');
        $("#purchases-requestion").addClass('active');
    }else if($("#requested_dept").val() == 7){
        $("#sales").addClass('menu-open');
        $("#sales-active").addClass('active');
        $("#sales-requestion").addClass('active');
    }

    $('#requested-date').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $scope.editRequest = function(reqs){
        $scope.request = reqs;
        $scope.request.department = reqs.requested_dept;
    };

    $scope.getInventoryInfo = function(){
        $scope.inventoryinfo = {};
        $http.get('get-inventory/0/30').then(function (response) {
            if (response.data.length > 0) {
                $scope.allinventories = response.data;
                $scope.getEmployees();
            }
        });
    };

    $scope.getEmployees = function () {
        $http.get('hr/getEmployees').then(function (response) {
            if (response.data.length > 0) {
                $scope.Users = response.data;
                $scope.getRequestions();
            }
        });
    };

    $scope.changeStatus = function (request_id, status) {
        $http.get('change-request-status/' + request_id + '/' + status).then(function (res) {
            swal({
                title: "Save!",
                text: res.data,
                type: "success"
            });
            $scope.getRequestions();
        });
    };

    $scope.request = {};
    $scope.saveRequestions = function(){
        $scope.request.requested_date = $("#requested-date input").val();
        if (!$scope.request.department || !$scope.request.product || !$scope.request.requested_person) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $scope.request.requested_dept = $("#requested_dept").val();
            var Data = new FormData();
            angular.forEach($scope.request, function (v, k) {
                Data.append(k, v);
            });
            $http.post('maintain-requestions', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data.message,
                    type: "success"
                });
                $scope.request = {};
                $scope.getRequestions();
            });
        }
    };

    $scope.getRequestions = function(){
        $http.get('maintain-requestions/' + $("#requested_dept").val()).then(function (response) {
            if (response.data.length > 0) {
                $scope.allrequestion = response.data;
            }
        });
    };

    $scope.deleteRequest = function(request_id){
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
            $http.delete('maintain-requestions/'+request_id).then(function (response) {
                $scope.getRequestions();
                swal("Deleted!", response.data, "success");
            });
        });
    };
});