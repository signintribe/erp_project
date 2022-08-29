TaskTierApp.controller('WorkflowController', function ($scope, $http) {
    $scope.workflow = {};
    $('#forworded_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $scope.appurl = $("#appurl").val();
    $scope.company_id = $("#company_id").val();
    
    $scope.changeSearchType = function(){
        if($scope.workflow.searchfor == 'Leave'){
            $("#leavetype").show();
            $("#searchbox").hide();
            $scope.get_leaves();
        }else{
            $("#searchbox").show();
            $("#leavetype").hide();
        }
    };

    $scope.getPendingLeaves = function(leave_id){
        $http.get('get-pending-leaves/' + leave_id).then(function (response) {
            if(response.data.status == true){
                $scope.pending_leaves = response.data.data;
            }
        });
    }

    $scope.get_leaves = function(){
        $http.get($scope.appurl + 'hr/get-leaves-for-apply').then(function (response) {
            if(response.data.status == true){
                $scope.leaves = response.data.data;
            }else if(response.data.status == false){
                $scope.servermessage = response.data.message;
            }
        });
    };

    $scope.getResult = function(search){
        switch($scope.workflow.searchfor){
            case 'Leave':
                var url = "get-leave/"+search;break;
            case 'Purchase_Quotation':
                var url = "purchases/get-quotations/" + search;break;
            case 'Sale_Quotation':
                var url = "sales/get-quotation-sale/" + search;break;
            case 'Requestion':
                var url = "tender/get-requestion-for-quotation/" + search;break;
            case 'Sale_Order':
                var url = "sales/get-sale-order/"+search+"/0";break;
            case 'Task':
                var url = "";break;
            case 'Tender':
                var url = "tender/get-tenders-for-quotation/"+search;break;
        }
        
        $http.get($scope.appurl + url).then(function (response) {
            if (response.data.length > 0) {
                $scope.getLeave = {};
                $scope.getPQuotation = {};
                $scope.getSQuotation = {};
                $scope.getRequestion = {};
                $scope.getSO = {};
                $scope.getTask = {};
                $scope.getTender = {};
                switch($scope.workflow.searchfor){
                    case 'Leave':
                        $scope.getLeave = response.data;break;
                    case 'Purchase_Quotation':
                        $scope.getPQuotation = response.data;break;
                    case 'Sale_Quotation':
                        $scope.getSQuotation = response.data;break;
                    case 'Requestion':
                        $scope.getRequestion = response.data;break;
                    case 'Sale_Order':
                        $scope.getSO = response.data;break;
                    case 'Task':
                        $scope.getTask = response.data;break;
                    case 'Tender':
                        $scope.getTender = response.data;break;
                }
                $("#search-box").show();
            }
        });
    };

    $scope.getWorkFlow = function(workflowfor){
        $scope.workflow.workflowfor = workflowfor;
        $("#search-box").hide();
        $scope.getLeave = {};
        $scope.getPQuotation = {};
        $scope.getSQuotation = {};
        $scope.getRequestion = {};
        $scope.getSO = {};
        $scope.getTask = {};
        $scope.getTender = {};
    };

    $scope.getoffice = function () {
        $scope.offices = {};
        $http.get($scope.appurl + 'company/getoffice/'+$scope.company_id ).then(function (response) {
            if (response.data.length > 0) {
                $scope.offices = response.data;
            }
        });
    };

    $scope.getDepartments = function (office_id) {
        $scope.departments = {};
        $http.get($scope.appurl + 'company/get-departments/'+office_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.departments = response.data;
            }
        });
    };

    $scope.getRoles = function (dept_id) {
        $scope.allroles = {};
        $http.get($("#appurl").val() + 'company/get-employee-roles/'+ dept_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.allroles = response.data;
            }
        });
    };

    $scope.getActions = function (role_id) {
        $scope.allactions = {};
        $http.get($("#appurl").val() + 'company/get-role-actions/'+ role_id).then(function (response) {
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

    $scope.saveWorkflow = function(){
        if (!$scope.workflow.workflowfor || !$scope.workflow.searchfor || !$scope.workflow.office_id || !$scope.workflow.forword_to || !$scope.workflow.assign_to) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
            var Data = new FormData();
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
                    $scope.getMyWorkFlows();
                    $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
                }else{
                    swal({
                        title: "Warning!",
                        text: res.data.message,
                        type: "warning"
                    });
                    $scope.getMyWorkFlows();
                    $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
                }
            });
        }
    };

    $scope.readUrl = function (element) {
        var reader = new FileReader();//rightbennerimage
        reader.onload = function (event) {
            $scope.attach_file = event.target.result;
            $scope.$apply(function ($scope) {
                $scope.workflow.attach_file = element.files[0];
            });
        };
        reader.readAsDataURL(element.files[0]);
    };
    $scope.paginate = {};
    $scope.getMyWorkFlows = function(){
        $scope.myworkflows = {};
        $scope.offset = 0;
        $scope.limit = 20;
        $scope.paginate = {
            'limit' : $scope.limit,
            'offset' : $scope.offset,
            'company_id' : $("#company_id").val()
        };
        $http.get('add-work-flow/' + JSON.stringify($scope.paginate)).then(function (response) {
            if (response.data.length > 0) {
                $scope.myworkflows = response.data;
                $scope.offset += $scope.limit;
            }
        });
    };

    $scope.loadMore = function(){
        //$scope.myworkflows = {};
        $scope.paginate = {
            'limit' : $scope.limit,
            'offset' : $scope.offset,
            'company_id' : $("#company_id").val()
        };
        $("#load-more").addClass('fa-sw fa-pulse');
        $http.get('add-work-flow/'+ JSON.stringify($scope.paginate)).then(function (response) {
            if (response.data.length > 0) {
                $scope.myworkflows = $scope.myworkflows.concat(response.data);
                $scope.offset += $scope.limit;
                $("#load-more").removeClass('fa-sw fa-pulse');
            }else{
                $scope.nomore = "There is no more records";
                $("#btn-loadmore").hide();
            }
        });
    };

    $scope.deleteWorkflow = function(id){
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
                $scope.getMyWorkFlows();
                swal("Deleted!", response.data, "success");
            });
        });
    };
});