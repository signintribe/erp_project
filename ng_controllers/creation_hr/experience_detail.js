CreateTierApp.controller('ExperienceController', function ($scope, $http) {
    $('#worked_from').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('#worked_to').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $("#employee").addClass('menu-open');
    $("#employee a[href='#']").addClass('active');
    $("#employee-experience").addClass('active');
    $scope.experience = {};
    $scope.totalPeriod = function(){
        var checkBox = document.getElementById("prsnt");
        if (checkBox.checked == true){
            const date = new Date();

            let cday = date.getDate();
            let cmonth = date.getMonth() + 1;
            let cyear = date.getFullYear();

            let currentDate = `${cyear}-${cmonth}-${cday}`;
            console.log(currentDate);
            const date1 = new Date($scope.experience.worked_from);
            const date2 = new Date(currentDate);
            var diff = Math.floor(date2.getTime() - date1.getTime());
            var day = 1000 * 60 * 60 * 24;
            var days = Math.floor(diff/day);
            var months = Math.floor(days/31);
            var years = Math.floor(months/12);
            var message = days + " days ";
            message += months + " months ";
            message += years + " years";
            $scope.experience.total_period = message;
            $scope.experience.worked_to = 'present';
            alert($scope.experience.worked_to);
        } else {
            if($scope.experience.worked_to){
                const date1 = new Date($scope.experience.worked_from);
                const date2 = new Date($scope.experience.worked_to);
                var diff = Math.floor(date2.getTime() - date1.getTime());
                var day = 1000 * 60 * 60 * 24;
                var days = Math.floor(diff/day);
                var months = Math.floor(days/31);
                var years = Math.floor(months/12);
                var message = days + " days ";
                message += months + " months ";
                message += years + " years";
                $scope.experience.total_period = message;
            }else{
                $scope.experience.total_period = "";
            }
        }
    };
    $scope.appurl = $("#app_url").val();
    $scope.getEmployees = function () {
        $http.get('getEmployees/'+$("#company_id").val()).then(function (response) {
            if (response.data.length > 0) {
                $scope.Users = response.data;
            }
        });
    };

    $scope.deleteExperience = function (id) {
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
            $http.delete('maintain-employee-experience/' + id).then(function (response) {
                $scope.getExperiences();
                swal("Deleted!", response.data, "success");
            });
        });
    };

    $scope.getExperiences = function () {
        $scope.experiences = {};
        $http.get('maintain-employee-experience').then(function (response) {
            if (response.data.length > 0) {
                $scope.experiences = response.data;
            }
        });
    };

    $scope.editExperience = function (id) {
        $http.get('maintain-employee-experience/' + id + '/edit').then(function (response) {
            $scope.experience = response.data;
            $scope.experience.employee_id = parseInt($scope.experience.employee_id);
            $scope.getAddress($scope.experience.address_id);
        });
    };

    $scope.getAddress = function(address_id){
        $http.get($scope.appurl+'getAddress/' + address_id).then(function (response) {
            if (response.data) {
                angular.extend($scope.experience, response.data);
                $scope.getContact($scope.experience.contact_id);
            }
        });
    };

    $scope.getContact = function(contact_id){
        $http.get($scope.appurl+'getContact/' + contact_id).then(function (response) {
            if (response.data) {
                angular.extend($scope.experience, response.data);
            }
        });
    };

    $scope.save_experience = function(){
        if (!$scope.experience.employee_id || !$scope.experience.designation || !$scope.experience.organization || !$scope.experience.reference_number || !$scope.experience.address_line_1 || !$scope.experience.phone_number) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $scope.experience.worked_from = $('#worked_from input').val();
            $scope.experience.worked_to = $('#worked_to input').val();
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.experience, function (v, k) {
                Data.append(k, v);
            });
            $http.post('maintain-employee-experience', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.experience = {};
                $scope.getExperiences();
                $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
            });
        }
    };
});