ReportTierApp.controller('ReportController', function ($scope, $http) {
    $scope.filter = {};
    $scope.filterEmployee = function(){
        if (!$scope.filter.to_salary || !$scope.filter.from_salary) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            var Data = new FormData();
            angular.forEach($scope.filter, function (v, k) {
                Data.append(k, v);
            });
            $http.post('get-hr-report', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
            });
        }
    };
});