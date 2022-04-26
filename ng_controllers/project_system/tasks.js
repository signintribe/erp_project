TaskTierApp.controller('CreateTasksController', function ($scope, $http) {
    $("#ps-open").addClass('menu-open');
    $("#ps-active").addClass('active');
    $("#create-tasks").addClass('active');

    $('#todate').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#fromdate').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $scope.resetscope = function(){
        $scope.getProjects();
        $scope.getTasks();
        $scope.tasks = {};
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
                $scope.allProjects = response.data.data;
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

    $scope.getTasks = function(){
        $("#loader-tasks").addClass('fa fa-spinner fa-fw fa-3x fa-pulse');
        $scope.offset = 0;
        $scope.limit = 20;
        var arr = {
            'offset':$scope.offset,
            'limit':$scope.limit,
            'company_id': $("#company_id").val()
        };
        $http.get('create-tasks/'+ JSON.stringify(arr)).then(function (response) {
            if (response.data.data.length > 0) {
                $scope.allTasks = response.data.data;
                $scope.offset += $scope.limit;
                $("#loader-tasks").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
                $("#loadmore-tasks-btn").show('slow');
            }else{
                $("#loadmore-tasks-btn").hide('slow');
                $scope.nomorephases = "There is no data";
                $("#loader-tasks").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
            }
        });
    };

    $scope.loadMorePhases = function(){
        $("#loader-phases").addClass('fa fa-spinner fa-fw fa-3x fa-pulse');
        var arr = {
            'offset':$scope.offset,
            'limit':$scope.limit,
            'company_id': $("#company_id").val()
        };
        $http.get('create-phases/'+ JSON.stringify(arr)).then(function (response) {
            if (response.data.data.length > 0) {
                $scope.allPhases = $scope.allPhases.concat(response.data.data);
                $scope.offset += $scope.limit;
                $("#loader-phases").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
                $("#loadmore-phases-btn").show('slow');
            }else{
                $("#loadmore-phases-btn").hide('slow');
                $scope.nomorephases = "There is no data";
                $("#loader-phases").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
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
                $scope.allPhases = response.data.data;
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

    $scope.getActivities = function(project_id){
        $scope.tasks.activity_id = 0;
        $http.get('get-project-activities/'+ project_id + '/' + $("#company_id").val()).then(function (response) {
            if (response.data.status == true) {
                $scope.activities = response.data.data;
                $scope.phases = {};
            }else{
                $scope.nomore = "There is no data";
            }
        });
    };

    $scope.getActivityPhases = function(activity_id){
        $scope.tasks.phase_id = 0;
        $http.get('get-activity-phases/'+ activity_id + '/' + $("#company_id").val()).then(function (response) {
            if (response.data.status == true) {
                $scope.phases = response.data.data;
            }else{
                $scope.nomore = "There is no data";
            }
        });
    };

    $scope.editTasks = function(id){
        $http.get('create-tasks/'+ id + '/edit').then(function (response) {
            if (response.data.status == true) {
                $scope.getActivities(response.data.data[0].project_id);
                $scope.getActivityPhases(response.data.data[0].activity_id);
                $scope.tasks = response.data.data[0];
                $scope.tasks.project_id = parseInt(response.data.data[0].project_id);
                $scope.tasks.activity_id = parseInt(response.data.data[0].activity_id);
                $scope.tasks.phase_id = parseInt(response.data.data[0].phase_id);
            }else{
                $scope.nomore = "There is no more data";
                $("#loadmore-btn").hide('slow');
            }
        });
    };
    
    $scope.deletetasks = function(id){
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
            $http.delete('create-tasks/' + id).then(function (response) {
                if(response.data.status == true){
                    swal("Deleted!", response.data.message, "success");
                    $scope.resetscope();
                }else{
                    swal("Error!", response.data.message, "error");
                }
            });
        });
    };

    $scope.saveTasks = function(){
        if(!$scope.tasks.task_name || !$scope.tasks.project_id || !$scope.tasks.activity_id || !$scope.tasks.phase_id){
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        }else{
            $(".btn-success i").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
            $scope.tasks.start_date = $("#todate input").val();
            $scope.tasks.end_date = $("#fromdate input").val();
            $scope.tasks.company_id = $("#company_id").val();
            $scope.appurl = $("#appurl").val();
            var Data = new FormData();
            angular.forEach($scope.tasks, function (v, k) {
                Data.append(k, v);
            });
            $http.post('create-tasks', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                if(res.data.status == true){
                    swal({
                        title: "Save!",
                        text: res.data.message,
                        type: "success"
                    });
                    $scope.tasks = {};
                    $scope.activities = {};
                    $scope.phases = {};
                    $scope.resetscope();
                    $(".btn-success i").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
                }
            });
        }
    };
});