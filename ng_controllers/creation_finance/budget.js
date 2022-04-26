CreateTierApp.controller('BankController', function ($scope, $http) {
    $("#banking-finance").addClass('menu-open');
    $("#banking-finance a[href='#']").addClass('active');
    $("#budget").addClass('active');
    $scope.url = $("#appurl").val();
    $scope.budget = {};

    $scope.getAccounts = function () {
        var Accounts = $http.get('get-accounts-budget');
        Accounts.then(function (r) {
            $scope.Accounts = r.data;
        });
    };

    $scope.getBudgetDetail = function () {
        var Accounts = $http.get('get-budget-detail');
        Accounts.then(function (r) {
            if(r.data.status==true){
                $scope.budgetDetail = r.data.data;
            }else{
                $scope.nobudget = "Budget Not Define";
            }
        });
    };

    $scope.addBudget = function(acc_id){
        $scope.budget.account_id = acc_id;
        $scope.budget.company_id = $("#company_id").val();
        $scope.budget.july = $("#jul"+acc_id).val();
        $scope.budget.august = $("#aug"+acc_id).val();
        $scope.budget.september = $("#sep"+acc_id).val();
        $scope.budget.october = $("#oct"+acc_id).val();
        $scope.budget.november = $("#nov"+acc_id).val();
        $scope.budget.december = $("#dec"+acc_id).val();
        $scope.budget.january = $("#jan"+acc_id).val();
        $scope.budget.february = $("#feb"+acc_id).val();
        $scope.budget.march = $("#mar"+acc_id).val();
        $scope.budget.april = $("#apr"+acc_id).val();
        $scope.budget.may = $("#may"+acc_id).val();
        $scope.budget.june = $("#jun"+acc_id).val();
        if (!$scope.budget.account_id) {
            alert("please select account id");
        } else {
            var Data = new FormData();
            angular.forEach($scope.budget, function (v, k) {
                Data.append(k, v);
            });
            $http.post('save-budget', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                if(res.data.status == true){
                    swal("Save!", res.data.message, "success");
                    $scope.budget = {};
                    $scope.getAccounts();
                    $scope.getBudgetDetail();
                }else{
                    swal("Sorry!", res.data.message, "error");
                }
            });
        }
    };

    $scope.updateBudget = function(){
        if (!$scope.budget.account_id) {
            alert("please select account id");
        } else {
            $scope.budget.company_id = $scope.budget.company_id == 0 ? $("#company_id").val() : $scope.budget.company_id ;
            console.log($scope.budget);
            var Data = new FormData();
            angular.forEach($scope.budget, function (v, k) {
                Data.append(k, v);
            });
            $http.post('save-budget', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                if(res.data.status == true){
                    swal("Save!", res.data.message, "success");
                    $scope.budget = {};
                    $scope.getAccounts();
                    $scope.getBudgetDetail();
                    $("#editBudget").modal('hide');
                }else{
                    swal("Sorry!", res.data.message, "error");
                }
            });
        }
    };

    $scope.deleteBudget = function(budget_id){
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
            var delete_category = $http.get('delete-budget/' + budget_id);
            delete_category.then(function (result) {
                if(result.data.status == true){
                    swal("Deleted!", result.data.message, "success");
                    $scope.getAccounts();
                    $scope.getBudgetDetail();
                }
            });
        });
    };

    $scope.editBudget = function(budget){
        $scope.budget = budget;
        console.log($scope.budget);

    };
});