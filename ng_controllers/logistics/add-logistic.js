CreateTierApp.controller('LogisticController', function ($scope, $http) {
    $("#sourcing").addClass('menu-open');
    $("#sourcing a[href='#']").addClass('active');
    $("#add-logistics").addClass('active');
    $scope.logistic = {};

    $scope.saveLogistic = function(){
        if (!$scope.logistic.organization_name || !$scope.logistic.logistic_type) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $scope.logistic.company_id = $("#company_id").val();
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.logistic, function (v, k) {
                Data.append(k, v);
            });
            $http.post('save-logistic', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.logistic = {};
                $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
            });
        }
    };

    $scope.readUrl = function (element) {
        var reader = new FileReader();//rightbennerimage
        reader.onload = function (event) {
            $scope.catimage = event.target.result;
            $scope.$apply(function ($scope) {
                $scope.logistic.logo_file = element.files[0];
            });
        };
        reader.readAsDataURL(element.files[0]);
    };
});