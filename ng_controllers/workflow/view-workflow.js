TaskTierApp.controller('WorkflowController', function ($scope, $http) {
    $scope.workflow = {};

    $scope.getWorkFlowNotification = function(notificationFor){
        var getSpecWorkFlow = $http.get('get-workflow-notification/' + notificationFor);
        getSpecWorkFlow.then(function(response){
            if(response.data.status == true){
                $scope.workflows = response.data.data;
            }
            console.log($scope.workflows);
        });
    };

    $scope.getAllWorkFlows = function(){
        var getWorkFlows = $http.get('get-all-workflows');
        getWorkFlows.then(function(response){
            if(response.data.status == true){
                $scope.workflows = response.data.data;
            }
            console.log($scope.workflows);
        });
    };

    $scope.getWorkFlow = function(wfid, searchfor){
        var getOneWorkFlow = $http.get('get-workflow/' + wfid + '/' + searchfor);
        getOneWorkFlow.then(function(response){
            if(response.data.status == true){
                $scope.specwf = response.data.data[0];
            }
            console.log($scope.workflows);
        });
    };

    $scope.deleteWorkflow = function(id, searchfor){
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
            $http.delete('add-work-flow/'+id).then(function (response) {
                $scope.getWorkFlowNotification(searchfor);
                swal("Deleted!", response.data, "success");
            });
        });
    };

    $scope.changeStatus = function(wfid, searchfor, workflowfor, status, avail_leave){
        $http.get('change-workflow-status/' + wfid + '/' + searchfor + '/' + workflowfor + '/' + status + '/' + avail_leave).then(function (response) {
            $scope.getWorkFlowNotification(searchfor);
            swal("Success!", response.data, "success");
        });
    };

});