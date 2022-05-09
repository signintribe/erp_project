CreateTierApp.controller('PayscaleController', function ($scope, $http) {
    $('#valid_till').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $("#employee").addClass('menu-open');
    $("#employee a[href='#']").addClass('active');
    $("#employee-payscale").addClass('active');
    $scope.payscale = {};
    $scope.app_url = $("#appurl").val();
    $scope.all_companies = function () {
        $http.get($scope.app_url + 'company/getcompanyinfo').then(function (response) {
            if (response.data.length > 0) {
                $scope.companies = response.data;
            }
        });
    };


    $scope.getoffice = function (company_id) {
        $scope.offices = {};
        $http.get($scope.app_url + 'company/getoffice/'+company_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.offices = response.data;
            }
        });
    };
    
    $scope.getDepartments = function (office_id) {
        $scope.departments = {};
        $http.get($scope.app_url + 'company/get-departments/'+office_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.departments = response.data;
            }
        });
    };

    $scope.getGroups = function (dep_id) {
        $scope.groups = {};
        $http.get($scope.app_url + 'company/get-groups/' + dep_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.groups = response.data;
            }
        });
    };

    $scope.get_payscale = function(){
        $http.get($scope.app_url + 'company/maintain-payscale').then(function (response) {
            if(response.data.length > 0){
                $scope.payscales = response.data;
            }
        });
    }

    $scope.editPayscale = function(id){
        $http.get($scope.app_url + 'company/maintain-payscale/'+ id + '/edit').then(function (response) {
            $scope.payscale = response.data[0];
            $scope.payscale.company_id = parseInt($scope.payscale.company_id);
            $scope.payscale.office_id = parseInt($scope.payscale.office_id);
            $scope.payscale.department_id = parseInt($scope.payscale.department_id);
            $scope.payscale.group_id = parseInt($scope.payscale.group_id);
            $scope.payscale.status = $scope.payscale.status == 0 ? false : true;
            $("#ShowPrint").show();
        });
    }


    $scope.save_payscale = function () {
        if (!$scope.payscale.department_id || !$scope.payscale.payscale_name || !$scope.payscale.initial_pay) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $scope.payscale.valid_till = $("#valid_till input").val();
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.payscale, function (v, k) {
                Data.append(k, v);
            });
            $http.post($scope.app_url + 'company/maintain-payscale', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                $scope.get_payscale();
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.payscale = {};
                $scope.get_payscale();
                $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
            });
        }
    };

    $scope.deletePayScale = function(id){
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
            $http.delete($scope.app_url + 'company/maintain-payscale/'+id).then(function (response) {
                $scope.get_payscale();
                swal("Deleted!", response.data, "success");
            });
        });
    };
});