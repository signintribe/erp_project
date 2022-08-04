CreateTierApp.controller('CalanderController', function ($scope, $http) {
    //Date picker
    $('#start_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('#end_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $("#company").addClass('menu-open');
    $("#company a[href='#']").addClass('active');
    $("#company-calendar").addClass('active');
    $scope.calander = {};
    $scope.app_url = $("#appurl").val();
    $scope.company_id = $("#company_id").val();
    
    $scope.all_companies = function () {
        $http.get('getcompanyinfo').then(function (response) {
            if (response.data.length > 0) {
                $scope.companies = response.data;
            }
        });
    };

    $scope.getoffice = function () {
        $scope.offices = {};
        $http.get('getoffice/'+$scope.company_id).then(function (response) {
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

    $scope.get_calendars = function(){
        $http.get('maintain-calender/' + $("#user_id").val()).then(function (response) {
            if(response.data.length > 0){
                $scope.calendars = response.data;
            }
        });
    }

    $scope.editCalendar = function(id, office_id){
        $scope.getDepartments(office_id);
        $http.get('maintain-calender/'+ id + '/edit').then(function (response) {
            $scope.calander = response.data[0];
            $scope.calander.office_id = parseInt(response.data[0].office_id);
            $scope.calander.department_id = parseInt(response.data[0].department_id);
            //alert($scope.calander.department_id);
            $("#ShowPrint").show();
        });
    }


    $scope.save_calender = function () {
        $scope.calander.calender_start_date = $("#start_date input").val();
        $scope.calander.calender_end_date = $("#end_date input").val();
        if (!$scope.calander.calender_type || !$scope.calander.calender_name || !$scope.calander.calender_end_date || !$scope.calander.calender_start_date) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
            return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.calander, function (v, k) {
                Data.append(k, v);
            });
            $http.post('maintain-calender', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                if(res.data.status == true){
                    $scope.get_calendars();
                    swal({
                        title: "Save!",
                        text: res.data.message,
                        type: "success"
                    });
                    $("#loader").removeClass('fa-spinner fa-fw fa-pulse').addClass('fa-save');
                    $scope.calander = {};
                }else{
                    swal('Warning', res.data.message, 'warning');
                }
            });
        }
    };

    $scope.deleteCalendar = function(id){
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
            $http.delete('maintain-calender/'+id).then(function (response) {
                $scope.get_calendars();
                swal("Deleted!", response.data, "success");
            });
        });
    };
});