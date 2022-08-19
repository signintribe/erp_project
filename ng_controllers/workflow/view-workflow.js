TaskTierApp.controller('WorkflowController', function ($scope, $http) {
    $scope.workflow = {};

    $scope.getWorkFlowNotification = function(notificationFor){
        var getModuleForms = $http.get('get-workflow-notification/' + notificationFor);
        getModuleForms.then(function(response){
            if(response.data.status == true){
                $scope.workflows = response.data.data;
            }
            console.log($scope.workflows);
        });
    };

    $scope.getWorkFlow = function(wfid, searchfor){
        var getModuleForms = $http.get('get-workflow/' + wfid + '/' + searchfor);
        getModuleForms.then(function(response){
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