TaskTierApp.controller('ApplyleaveController', function ($scope, $http) {
    $('#required_from').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('#required_to').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $scope.aplv = {};
    $scope.dateDiff = function(){
        const date1 = new Date($scope.aplv.fromdate);
        const date2 = new Date($scope.aplv.todate);
        const diffTime = Math.abs(date2 - date1);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
        console.log(diffTime + " milliseconds");
        $scope.aplv.avail_leave = diffDays
        console.log(diffDays + " days");
    };

    $scope.get_leaves = function(){
        $http.get('get-leaves-for-apply').then(function (response) {
            if(response.data.status == true){
                $scope.leaves = response.data.data;
            }else if(response.data.status == false){
                $scope.servermessage = response.data.message;
            }
        });
    }

    $scope.leaveDetail= function(leave){
        if($scope.aplv.avail_leave){
            $("#leave_type").text(leave.leave_type);
            $("#prfmsg").text(leave.leave_proof);
            $scope.aplv.total_leave = leave.total_leave;
            $scope.aplv.leave_id = leave.id;
            $http.get('prev-employee-leave-balance/' + $("#company_id").val() + '/' + leave.id).then(function (response) {
                $scope.LeavesBalance = response.data;
                if($scope.LeavesBalance){
                    $scope.aplv.available_balance = $scope.LeavesBalance - $scope.aplv.avail_leave;
                    $scope.aplv.prev_balance = $scope.LeavesBalance;
                }else{
                    $scope.aplv.available_balance = $scope.aplv.total_leave - $scope.aplv.avail_leave;
                    $scope.aplv.prev_balance = $scope.aplv.total_leave;
                }
            });
        }else{
            swal('Alert', 'Please Select Leave Range', 'warning');
        }

    };

    $scope.getEmployees = function () {
        $http.get('getEmployees/' + $("#company_id").val()).then(function (response) {
            if (response.data.length > 0) {
                $scope.Users = response.data;
            }else{
                $(".loader").html('');
            }
        });
    };

    $scope.readUrl = function (element) {
        var reader = new FileReader();//rightbennerimage
        reader.onload = function (event) {
            $scope.catimg = event.target.result;
            $scope.$apply(function ($scope) {
                $scope.aplv.proof = element.files[0];
            });
        };
        reader.readAsDataURL(element.files[0]);
    };

    $scope.saveLeave = function(){
        if (!$scope.aplv.leave_id || !$scope.aplv.look_after || !$scope.aplv.todate || !$scope.aplv.fromdate) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.aplv, function (v, k) {
                Data.append(k, v);
            });
            $http.post('apply-leave-form', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
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

    $scope.getLeaves = function(){
        $("#data-loader").addClass('fa fa-spinner fa-3x fa-sw fa-pulse');
        $http.get('apply-leave-form/' + $("#company_id").val()).then(function (response) {
            if (response.data.length > 0) {
                $scope.Leaves = response.data;
                $("#data-loader").removeClass('fa fa-spinner fa-3x fa-sw fa-pulse');
            }else{
                $("#data-loader").removeClass('fa fa-spinner fa-3x fa-sw fa-pulse');
            }
        });
    };
});