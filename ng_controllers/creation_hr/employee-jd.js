CreateTierApp.controller('JDController', function ($scope, $http) {
    $("#employee").addClass('menu-open');
    $("#employee a[href='#']").addClass('active');
    $("#employee-jd").addClass('active');
    $scope.jds = {};
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

    $scope.get_jds = function(){
        $http.get($scope.app_url + 'company/maintain-jds').then(function (response) {
            if(response.data.length > 0){
                $scope.alljds = response.data;
            }
        });
    }

    $scope.editJD = function(id){
        $http.get($scope.app_url + 'company/maintain-jds/'+ id + '/edit').then(function (response) {
            $scope.jds = response.data[0];
            $scope.jds.company_id = parseInt($scope.jds.company_id);
            $scope.jds.office_id = parseInt($scope.jds.office_id);
            $scope.jds.department_id = parseInt($scope.jds.department_id);
            $scope.jds.group_id = parseInt($scope.jds.group_id);
            //$scope.jdDoc = $scope.appurl + "public/employeeJD/" + $scope.jds.attachment;
            $("#ShowPrint").show();
        });
    };


    $scope.save_jds = function () {
        if (!$scope.jds.department_id || !$scope.jds.jd_name) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.jds, function (v, k) {
                Data.append(k, v);
            });
            $http.post($scope.app_url + 'company/maintain-jds', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                $scope.get_jds();
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.jds = {};
                $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
            });
        }
    };

    $scope.deleteJobDescription = function(id){
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
            $http.delete($scope.app_url + 'company/maintain-jds/'+id).then(function (response) {
                $scope.get_jds();
                swal("Deleted!", response.data, "success");
            });
        });
    };

    $scope.readUrl = function (element) {
        var reader = new FileReader();//rightbennerimage
        reader.onload = function (event) {
            $scope.jdDoc = event.target.result;
            $scope.$apply(function ($scope) {
                $scope.jds.jdDoc = element.files[0];
            });
        };
        reader.readAsDataURL(element.files[0]);
    };
});