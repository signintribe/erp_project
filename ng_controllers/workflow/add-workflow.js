TaskTierApp.controller('WorkflowController', function ($scope, $http) {
    $scope.workflow = {};
    $('#forworded_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $scope.appurl = $("#appurl").val();
    $scope.company_id = $("#company_id").val();
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
                    $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
                }else{
                    swal({
                        title: "Warning!",
                        text: res.data.message,
                        type: "warning"
                    });
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
});