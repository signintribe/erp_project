TaskTierApp.controller('CategoryController', function ($scope, $http, $compile, $filter) {
    $("#banking-finance").addClass('menu-open');
    $("#banking-finance a[href='#']").addClass('active');
    $("#add-gl").addClass('active');
    $('#entry_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $scope.CategoryName = "";
    $scope.resetscope = function () {
        $scope.Accounts = [];
        $scope.Types = [];
        $scope.Entries = {};
        $scope.Entries.Data = [{}, {}];
        $scope.getAccounts();
    };
    $scope.getAccounts = function () {
        var Accounts = $http.get('AllchartofAccount');
        Accounts.then(function (r) {
            $scope.Accounts = r.data;
        });
    };

    $http.get('user-types').then(function (res) {
        $scope.Types = res.data;
    });
    $scope.totatl = function () {
        $scope.TotalDebit = 0;
        $scope.TotalCredit = 0;
        angular.forEach($scope.Entries.Data, function (v, k) {
            if (v.debit) {
                $scope.TotalDebit += v.debit;
            }
            if (v.credit) {
                $scope.TotalCredit += v.credit;
            }
        });

    };

    $scope.settype = function (Entry, a) {
        console.log(Entry, a);
        Entry.account_type_id = a.parent;
        Entry.account_Id = a.id;
    };

    $scope.SaveEntries = function () {
        $scope.Entries.date = $("#entry_date input").val();
        $http.post('Save-General-Entries', $scope.Entries).then(function (res) {
            if(res.data.status == true){
                $scope.Entries = {};
                $scope.Entries.Data = [{}, {}];
                $scope.saveMessage = res.data.message;
            }
        });
    };

});