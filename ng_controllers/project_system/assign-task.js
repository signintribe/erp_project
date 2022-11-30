TaskTierApp.controller('AssignTaskController', function ($scope, $http) {
    $("#ps").addClass('menu-open');
    $("#ps-active").addClass('active');
    $("#assign-tasks").addClass('active');
    $('#assignmentdate').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $scope.resetscope = function(){
        $scope.task = {};
        $scope.getalloffice();
        $scope.getEmployees();
        $scope.getProjects();
    };

    $scope.getalloffice = function () {
        $scope.alloffice = {};
        $http.get($("#app_url").val() + 'company/office-settings').then(function (response) {
            if (response.data.length > 0) {
                $scope.offices = response.data;
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
                $scope.nomoreproject = "There is no projects";
                $("#loader").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
            }
        });
    }; 

    $scope.getDepartments = function (office_id) {
        $scope.departments = {};
        $http.get($("#app_url").val() + 'company/get-departments/'+office_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.departments = response.data;
            }
        });
    };

    $scope.getGroups = function (dep_id) {
        $scope.groups = {};
        $http.get($("#app_url").val() + 'company/get-groups/' + dep_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.groups = response.data;
            }
        });
    };

    $scope.getEmployees = function () {
        $http.get($("#app_url").val() + 'hr/getEmployees/'+$("#company_id").val()).then(function (response) {
            if (response.data.length > 0) {
                $scope.Users = response.data;
            }
        });
    };

    $scope.getActivities = function(project_id){
        $scope.task.activity_id = 0;
        $http.get('get-project-activities/'+ project_id + '/' + $("#company_id").val()).then(function (response) {
            if (response.data.data.length > 0) {
                $scope.activities = response.data.data;
                $scope.phases = {};
                $scope.tasks = {};
            }else{
                $scope.nomoreactivity = "There is no activities";
            }
        });
    };

    $scope.getActivityPhases = function(activity_id){
        $scope.task.phase_id = 0;
        $http.get('get-activity-phases/'+ activity_id + '/' + $("#company_id").val()).then(function (response) {
            if (response.data.data.length > 0) {
                $scope.phases = response.data.data;
                $scope.tasks = {};
            }else{
                $scope.nomorephase = "There is no phases";
            }
        });
    };

    $scope.getPhasesTasks = function(phase_id){
        $scope.task.task_id = 0;
        $http.get('get-phases-tasks/'+ phase_id + '/' + $("#company_id").val()).then(function (response) {
            if (response.data.data.length > 0) {
                $scope.tasks = response.data.data;
            }else{
                $scope.nomoretask = "There is no tasks";
            }
        });
    };

    $scope.assignTask = function(){
        /* if(!$scope.task.office_id || !$scope.task.department_id || !$scope.task.department_id || !$scope.task.assign_employee_id || !$scope.task.group_id || !$scope.task.project_id || !$scope.task.task_id){ */
        if(!$scope.task.project_id){
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        }else{
            $(".btn-success i").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
            $scope.task.assignment_date = $("#assignmentdate input").val();
            $scope.task.company_id = $("#company_id").val();
            $scope.appurl = $("#appurl").val();
            $scope.task.coa = $scope.coa;
            var Data = new FormData();
            angular.forEach($scope.task, function (v, k) {
                Data.append(k, v);
            });
            $http.post('assign-project', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                if(res.data.status == true){
                    swal({
                        title: "Save!",
                        text: res.data.message,
                        type: "success"
                    });
                    $scope.task = {};
                    $scope.activities = {};
                    $scope.phases = {};
                    $scope.tasks = {};
                    $scope.resetscope();
                    $(".btn-success i").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
                }
            });
        }
    };

    $scope.searchBudget = function(search){
        $http.get('search-budget-detail/'+search).then(function (response) {
            if (response.data.data.length > 0) {
                $scope.budgetDetail = response.data.data;
            }
        });
    };

    $scope.coa = [];
    $scope.getCOA = function(attr_id){
        let index = $scope.coa.indexOf(attr_id);
        if(index == -1){
            $scope.coa.push(attr_id);
        }else{
            $scope.coa.splice(index, 1);
        }
    };
});