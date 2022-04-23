CreateTierApp.controller('ShiftsController', function ($scope, $http) {
    $("#company").addClass('menu-open');
    $("#company a[href='#']").addClass('active');
    $("#company-shift").addClass('active');
    $scope.shift = {};
    $scope.app_url = $("#appurl").val();

    $scope.totalShiftHours = function(){
        var hours = parseInt($("#end_time").val().split(':')[0], 10) - parseInt($("#start_time").val().split(':')[0], 10);
        if(hours < 0) hours = 24 + hours;
        $("#totalHours").text(hours);
        $scope.totalShiftHours = hours;
    };
    $scope.MealBreakTime = 0;
    $scope.totalMealBrake = function(){
        var hours = parseInt($("#mealend_time").val().split(':')[0], 10) - parseInt($("#mealstart_time").val().split(':')[0], 10);
        if(hours < 0) hours = 24 + hours;
        $("#totalmeal_hours").text(hours);
        $scope.MealBreakTime = hours;
    };
    $scope.TeaBreakTime = 0;
    $scope.totalTeaBreak = function(){
        var hours = parseInt($("#teaend_time").val().split(':')[0], 10) - parseInt($("#teastart_time").val().split(':')[0], 10);
        if(hours < 0) hours = 24 + hours;
        $("#totaltea_hours").text(hours);
        $scope.TeaBreakTime = hours;
        $scope.TotalBreakHours = $scope.MealBreakTime + $scope.TeaBreakTime;
        $scope.shift.total_workinhours = $scope.totalShiftHours - $scope.TotalBreakHours;
    };

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

    $scope.get_shifts = function(){
        $http.get('maintain-shift').then(function (response) {
            if(response.data.length > 0){
                $scope.shifts = response.data;
            }
        });
    };

    $scope.editShift = function(id){
        $http.get('maintain-shift/'+ id + '/edit').then(function (response) {
            $scope.shift = response.data[0];
            $scope.shift.company_id = parseInt($scope.shift.company_id);
            $scope.shift.office_id = parseInt($scope.shift.office_id);
            $scope.shift.department_id = parseInt($scope.shift.department_id);
            $("#ShowPrint").show();
            //Total Shift Time
            var totalShiftHours = parseInt($scope.shift.shift_end_time.split(':')[0], 10) - parseInt($scope.shift.shift_start_time.split(':')[0], 10);
            if(totalShiftHours < 0) totalShiftHours = 24 + totalShiftHours;
            $("#totalHours").text(totalShiftHours);
            $scope.totalShiftHours = totalShiftHours;
            //Total Meal Break Time
            var MealBreakTime = parseInt($scope.shift.mealbreak_end_time.split(':')[0], 10) - parseInt($scope.shift.mealbreak_start_time.split(':')[0], 10);
            if(MealBreakTime < 0) MealBreakTime = 24 + MealBreakTime;
            $("#totalmeal_hours").text(MealBreakTime);
            $scope.MealBreakTime = MealBreakTime;
            //Total Working Hours and tea time
            var TeaBreakTime = parseInt($scope.shift.teabreak_end_time.split(':')[0], 10) - parseInt($scope.shift.teabreak_start_time.split(':')[0], 10);
            if(TeaBreakTime < 0) TeaBreakTime = 24 + TeaBreakTime;
            $("#totaltea_hours").text(TeaBreakTime);
            $scope.TeaBreakTime = TeaBreakTime;
            $scope.TotalBreakHours = $scope.MealBreakTime + $scope.TeaBreakTime;
            $scope.shift.total_workinhours = $scope.totalShiftHours - $scope.TotalBreakHours;
        });
    }


    $scope.save_shifts = function () {
        if (!$scope.shift.department_id || !$scope.shift.shift_name) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.shift, function (v, k) {
                Data.append(k, v);
            });
            $http.post('maintain-shift', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                //$scope.get_calendars();
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $("#loader").removeClass('fa-spinner fa-fw fa-pulse').addClass('fa-save');
                $scope.get_shifts();
            });
        }
    };

    $scope.deleteShifts = function(id){
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
            $http.delete('maintain-shift/' +id).then(function (response) {
                $scope.get_shifts();
                swal("Deleted!", response.data, "success");
            });
        });
    };
});