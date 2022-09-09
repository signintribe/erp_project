TaskTierApp.controller('WorkflowController', function ($scope, $http) {
    $scope.workflow = {};
    $scope.specwf = {};
    $scope.appurl = $("#baseurl").val();
    $scope.company_id = $("#company_id").val();
    $scope.getWorkFlowNotification = function(notificationFor){
        var getSpecWorkFlow = $http.get('get-workflow-notification/' + notificationFor);
        getSpecWorkFlow.then(function(response){
            if(response.data.status == true){
                $scope.workflows = response.data.data;
            }
            console.log($scope.workflows);
        });
    };

    $scope.getAllWorkFlows = function(location){
        $scope.myworkflows = {};
        $scope.offset = 0;
        $scope.limit = 20;
        $scope.paginate = {
            'limit' : $scope.limit,
            'offset' : $scope.offset,
            'company_id' : $("#company_id").val()
        };
        $("#load-more").addClass('fa-sw fa-pulse');
        var getWorkFlows = $http.get('get-all-workflows/' + JSON.stringify($scope.paginate) + '/' + location);
        getWorkFlows.then(function(response){
            if(response.data.status == true){
                $scope.workflows = response.data.data;
                $scope.offset += $scope.limit;
                $("#load-more").removeClass('fa-sw fa-pulse');
                $("#btn-loadmore").show();
                $scope.nomore = "";
            }
        });
    };

    $scope.loadMore = function(location){
        $scope.paginate = {
            'limit' : $scope.limit,
            'offset' : $scope.offset,
            'company_id' : $("#company_id").val()
        };
        $("#load-more").addClass('fa-sw fa-pulse');
        var getWorkFlows = $http.get('get-all-workflows/' + JSON.stringify($scope.paginate) + '/' + location);
        getWorkFlows.then(function(response){
            if(response.data.data.length > 0){
                $scope.workflows = $scope.workflows.concat(response.data.data);
                $scope.offset += $scope.limit;
                $("#load-more").removeClass('fa-sw fa-pulse');
                $("#btn-loadmore").show();
                $scope.nomore = "";
            }else{
                $scope.nomore = "There is no more records";
                $("#btn-loadmore").hide();
            }
        });
    };

    $scope.getWorkFlow = function(wfid, searchfor){
        $("#view-loader").addClass('fa-spinner fa-sw fa-3x fa-pulse');
        var getOneWorkFlow = $http.get('get-workflow/' + wfid + '/' + searchfor);
        getOneWorkFlow.then(function(response){
            if(response.data.status == true){
                $scope.specwf = response.data.data[0];
                $scope.wfforwards = response.data.forwards;
                $scope.getselectedchecklist = response.data.checklist;
                $scope.taxes = response.data.taxes;
                $scope.deliverycharges = response.data.deliverycharges;
                $("#view-loader").removeClass('fa-spinner fa-sw fa-3x fa-pulse');
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

    $scope.getoffice = function () {
        $scope.offices = {};
        $http.get($scope.appurl + 'company/getoffice/' + $scope.company_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.offices = response.data;
            }
        });
    };

    $scope.getDepartments = function (office_id) {
        $scope.departments = {};
        $http.get($scope.appurl + 'company/get-departments/' + office_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.departments = response.data;
            }
        });
    };

    $scope.getRoles = function (dept_id) {
        $scope.allroles = {};
        $http.get($scope.appurl + 'company/get-employee-roles/'+ dept_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.allroles = response.data;
            }
        });
    };

    $scope.getActions = function (role_id) {
        $scope.allactions = {};
        $http.get($scope.appurl + 'company/get-role-actions/'+ role_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.allactions = response.data;
            }
        });
    };

    $scope.checkList = [];
    $scope.getCheckList = function(list){
        let index = $scope.checkList.indexOf(list);
        if(index == -1){
            $scope.checkList.push(list);
        }else{
            $scope.checkList.splice(index, 1);
        }
        $scope.workflow.role_action = JSON.stringify($scope.checkList);
        console.log($scope.workflow.role_action);
    };

    $scope.forwardTo = function(flow_id){
        if (!$scope.workflow.office_id || !$scope.workflow.forword_to || !$scope.workflow.assign_to) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-send').addClass('fa-spinner fa-sw fa-pulse');
            var Data = new FormData();
            $scope.workflow.flow_id = flow_id;
            angular.forEach($scope.workflow, function (v, k) {
                Data.append(k, v);
            });
            $http.post('add-work-flow', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                if(res.data.status == true){
                    swal({
                        title: "Save!",
                        text: res.data.message,
                        type: "success"
                    });
                    $scope.workflow = {};
                    $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-send');
                }else{
                    swal({
                        title: "Warning!",
                        text: res.data.message,
                        type: "warning"
                    });
                    $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-send');
                }
            });
        }
    };

});