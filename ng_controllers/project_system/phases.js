CreateTierApp.controller('CreatePhasesController', function ($scope, $http) {
    $("#ps-open").addClass('menu-open');
    $("#ps-active").addClass('active');
    $("#create-phases").addClass('active');

    $('#todate').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#fromdate').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $scope.resetscope = function(){
        $scope.getProjects();
        $scope.getPhases();
        $scope.phase = {};
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

    $scope.getPhases = function(){
        $("#loader-phases").addClass('fa fa-spinner fa-fw fa-3x fa-pulse');
        $scope.offset = 0;
        $scope.limit = 20;
        var arr = {
            'offset':$scope.offset,
            'limit':$scope.limit,
            'company_id': $("#company_id").val()
        };
        $http.get('create-phases/'+ JSON.stringify(arr)).then(function (response) {
            if (response.data.data.length > 0) {
                $scope.allPhases = response.data.data;
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
        $scope.phase.activity_id = 0;
        $http.get('get-project-activities/'+ project_id + '/' + $("#company_id").val()).then(function (response) {
            if (response.data.status == true) {
                $scope.activities = response.data.data;
            }else{
                $scope.nomore = "There is no data";
            }
        });
    };

    $scope.editPhase = function(id){
        $http.get('create-phases/'+ id + '/edit').then(function (response) {
            if (response.data.status == true) {
                $scope.getActivities(response.data.data[0].project_id);
                $scope.phase = response.data.data[0];
                $scope.phase.project_id = parseInt($scope.phase.project_id); 
                $scope.phase.activity_id = parseInt($scope.phase.activity_id); 
            }else{
                $scope.nomore = "There is no more data";
                $("#loadmore-btn").hide('slow');
            }
        });
    };
    
    $scope.deletePhases = function(id){
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
            $http.delete('create-phases/' + id).then(function (response) {
                if(response.data.status == true){
                    swal("Deleted!", response.data.message, "success");
                    $scope.resetscope();
                }else{
                    swal("Error!", response.data.message, "error");
                }
            });
        });
    };

    $scope.savePhase = function(){
        if(!$scope.phase.phase_name || !$scope.phase.project_id || !$scope.phase.activity_id){
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        }else{
            $(".btn-success i").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
            $scope.phase.start_date = $("#todate input").val();
            $scope.phase.end_date = $("#fromdate input").val();
            $scope.phase.company_id = $("#company_id").val();
            $scope.appurl = $("#appurl").val();
            var Data = new FormData();
            angular.forEach($scope.phase, function (v, k) {
                Data.append(k, v);
            });
            $http.post('create-phases', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                if(res.data.status == true){
                    swal({
                        title: "Save!",
                        text: res.data.message,
                        type: "success"
                    });
                    $scope.phase = {};
                    $scope.activities = {};
                    $scope.resetscope();
                    $(".btn-success i").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
                }
            });
        }
    };
});