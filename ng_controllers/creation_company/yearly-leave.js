CreateTierApp.controller('YearlyLeaveController', function ($scope, $http) {
    $("#company").addClass('menu-open');
    $("#company a[href='#']").addClass('active');
    $("#yearly-leave").addClass('active');
    $scope.yl = {};
    $scope.app_url = $("#appurl").val();
    $scope.all_companies = function () {
        $http.get('getcompanyinfo').then(function (response) {
            if (response.data.length > 0) {
                $scope.companies = response.data;
            }
        });
    };


    $scope.getoffice = function (company_id) {
        $scope.offices = {};
        $http.get('getoffice/'+company_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.offices = response.data;
            }
        });
    };
    
    $scope.getDepartments = function (office_id) {
        $scope.departments = {};
        $http.get('get-departments/'+office_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.departments = response.data;
            }
        });
    };

    $scope.getGroups = function (dep_id) {
        $scope.groups = {};
        $http.get('get-groups/' + dep_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.groups = response.data;
            }
        });
    };

    $scope.get_leaves = function(){
        $http.get('maintain-leaves').then(function (response) {
            if(response.data.length > 0){
                $scope.leaves = response.data;
            }
        });
    }

    $scope.editLeaves = function(id){
        $http.get('maintain-leaves/'+ id + '/edit').then(function (response) {
            $scope.yl = response.data[0];
            $scope.yl.company_id = parseInt($scope.yl.company_id);
            $scope.yl.office_id = parseInt($scope.yl.office_id);
            $scope.yl.department_id = parseInt($scope.yl.department_id);
            $scope.yl.group_id = parseInt($scope.yl.group_id);
            $("#ShowPrint").show();
        });
    }


    $scope.save_leave = function () {
        if (!$scope.yl.department_id || !$scope.yl.leave_type) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.yl, function (v, k) {
                Data.append(k, v);
            });
            $http.post('maintain-leaves', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                $scope.get_leaves();
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $("#loader").removeClass('fa-spinner fa-fw fa-pulse').addClass('fa-save');
                $scope.yl = {};
            });
        }
    };

    $scope.deleteYearlyLeave = function(id){
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
            $http.delete('maintain-leaves/'+id).then(function (response) {
                $scope.get_leaves();
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