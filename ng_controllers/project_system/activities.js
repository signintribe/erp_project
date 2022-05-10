CreateTierApp.controller('CreateActivitiesController', function ($scope, $http) {
    $("#ps-open").addClass('menu-open');
    $("#ps-active").addClass('active');
    $("#create-activities").addClass('active');

    $('#todate').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#fromdate').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $scope.resetscope = function(){
        $scope.getProjects();
        $scope.getActivities();
        $scope.activity = {};
    };

    $scope.getProjects = function(){
        $("#loader").addClass('fa fa-spinner fa-fw fa-3x fa-pulse');
        $scope.offset = 0;
        $scope.limit = 20;
        var arr = {
            'offset':$scope.offset,
            'limit':$scope.limit,
            'company_id': $("#company_id").val()
        };
        $http.get('create-projects/'+ JSON.stringify(arr)).then(function (response) {
            if (response.data.data.length > 0) {
                $scope.allprojects = response.data.data;
                $scope.offset += $scope.limit;
                $("#loader").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
                $("#loadmore-btn").show('slow');
            }else{
                $("#loadmore-btn").hide('slow');
                $scope.nomore = "There is no data";
                $("#loader").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
            }
        });
    };

    $scope.getActivities = function(){
        $("#loader-activities").addClass('fa fa-spinner fa-fw fa-3x fa-pulse');
        $scope.offset = 0;
        $scope.limit = 20;
        var arr = {
            'offset':$scope.offset,
            'limit':$scope.limit,
            'company_id': $("#company_id").val()
        };
        $http.get('create-activities/'+ JSON.stringify(arr)).then(function (response) {
            if (response.data.data.length > 0) {
                $scope.allactivities = response.data.data;
                $scope.offset += $scope.limit;
                $("#loader-activities").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
                $("#loadmore-activities-btn").show('slow');
            }else{
                $("#loadmore-activities-btn").hide('slow');
                $scope.nomoreactivities = "There is no data";
                $("#loader-activities").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
            }
        });
    };
    
    $scope.loadMoreActivities = function(){
        $("#loader-activities").addClass('fa fa-spinner fa-fw fa-3x fa-pulse');
        var arr = {
            'offset':$scope.offset,
            'limit':$scope.limit,
            'company_id': $("#company_id").val()
        };
        $http.get('create-activities/'+ JSON.stringify(arr)).then(function (response) {
            if (response.data.data.length > 0) {
                $scope.allactivities = $scope.allactivities.concat(response.data.data);
                $scope.offset += $scope.limit;
                $("#loader-activities").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
                $("#loadmore-activities-btn").show('slow');
            }else{
                $("#loadmore-activities-btn").hide('slow');
                $scope.nomoreactivities = "There is no data";
                $("#loader-activities").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
            }
        });
    };

    $scope.loadMore = function(){
        $("#loadmore-btn i").addClass('fa-fw fa-pulse');
        var arr = {
            'offset':$scope.offset,
            'limit':$scope.limit,
            'company_id': $("#company_id").val()
        };
        $http.get('create-projects/'+ JSON.stringify(arr)).then(function (response) {
            if (response.data.data.length > 0) {
                $scope.allprojects = response.data.data;
                $scope.offset += $scope.limit;
                $("#loadmore-btn i").addClass('fa-fw fa-pulse');
                $("#loadmore-btn").show('slow');
            }else{
                $scope.nomore = "There is no more data";
                $("#loadmore-btn").hide('slow');
                $("#loader").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
            }
        });
    };

    $scope.editActivites = function(id){
        $http.get('create-activities/'+ id + '/edit').then(function (response) {
            if (response.data.status == true) {
                $scope.activity = response.data.data;
                $scope.activity.project_id = parseInt(response.data.data.project_id);
            }else{
                $scope.nomore = "There is no more data";
                $("#loadmore-btn").hide('slow');
            }
        });
    };
    
    $scope.deleteActivites = function(id){
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
            $http.delete('create-activities/' + id).then(function (response) {
                if(response.data.status == true){
                    swal("Deleted!", response.data.message, "success");
                    $scope.resetscope();
                }else{
                    swal("Error!", response.data.message, "error");
                }
            });
        });
    };

    $scope.saveActivity = function(){
        if(!$scope.activity.activity_name || !$scope.activity.project_id){
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        }else{
            $(".btn-success i").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
            $scope.activity.start_date = $("#todate input").val();
            $scope.activity.end_date = $("#fromdate input").val();
            $scope.activity.company_id = $("#company_id").val();
            $scope.appurl = $("#appurl").val();
            var Data = new FormData();
            angular.forEach($scope.activity, function (v, k) {
                Data.append(k, v);
            });
            $http.post('create-activities', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                if(res.data.status == true){
                    swal({
                        title: "Save!",
                        text: res.data.message,
                        type: "success"
                    });
                    $scope.activity = {};
                    $scope.resetscope();
                    $(".btn-success i").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
                }
            });
        }
    };
});