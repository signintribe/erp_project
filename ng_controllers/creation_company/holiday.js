CreateTierApp.controller('GHController', function ($scope, $http) {
    $("#company").addClass('menu-open');
    $("#company a[href='#']").addClass('active');
    $("#gazzeted-holiday").addClass('active');
    $('#end_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#start_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $scope.gh = {};
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

    $scope.get_holiday = function(){
        $http.get('maintain-holiday').then(function (response) {
            if(response.data.length > 0){
                $scope.holidays = response.data;
            }
        });
    }

    $scope.editHoliday = function(id){
        $http.get('maintain-holiday/'+ id + '/edit').then(function (response) {
            $scope.gh = response.data[0];
            $scope.gh.company_id = parseInt($scope.gh.company_id);
            $scope.gh.office_id = parseInt($scope.gh.office_id);
            $scope.gh.department_id = parseInt($scope.gh.department_id);
            $("#ShowPrint").show();
        });
    }


    $scope.save_holiday = function () {
        if (!$scope.gh.department_id || !$scope.gh.holiday_name) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $scope.gh.start_date = $('#start_date input').val();
            $scope.gh.end_date = $('#end_date input').val();
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.gh, function (v, k) {
                Data.append(k, v);
            });
            $http.post('maintain-holiday', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                $scope.get_holiday();
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $("#loader").removeClass('fa-spinner fa-fw fa-pulse').addClass('fa-save');
                $scope.gh = {};
            });
        }
    };

    $scope.deleteGazHoliday = function(id){
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
            $http.delete('maintain-holiday/'+id).then(function (response) {
                $scope.get_holiday();
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