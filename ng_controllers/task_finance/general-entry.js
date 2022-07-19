TaskTierApp.controller('CategoryController', function ($scope, $http, $compile, $filter) {
    $("#banking-finance").addClass('menu-open');
    $("#banking-finance a[href='#']").addClass('active');
    $("#add-gl").addClass('active');
    $('#entry_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#cheque_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#depostie_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $scope.CategoryName = "";
    $scope.resetscope = function () {
        $scope.Accounts = [];
        $scope.Types = [];
        $scope.Entries = {};
        $scope.ps = {};
        $scope.Entries.Data = [{}, {}];
        $scope.getAccounts();
        $scope.getProjects();
    };
    $scope.getAccounts = function () {
        var Accounts = $http.get($("#appurl").val() + 'AllchartofAccount');
        Accounts.then(function (r) {
            $scope.Accounts = r.data;
        });
    };

    $http.get('user-types').then(function (res) {
        $scope.Types = res.data;
    });
    $scope.totatl = function () {
        $scope.TotalDebit = 0;
        $scope.TotalCredit = 0;
        angular.forEach($scope.Entries.Data, function (v, k) {
            if (v.debit) {
                $scope.TotalDebit += v.debit;
            }
            if (v.credit) {
                $scope.TotalCredit += v.credit;
            }
        });

    };

    $scope.settype = function (Entry, a) {
        console.log(Entry, a);
        Entry.account_type_id = a.parent;
        Entry.account_Id = a.id;
    };

    $scope.SaveEntries = function () {
        $scope.Entries.date = $("#entry_date input").val();
        console.log($scope.Entries);
        if (!$scope.Entries.invoice_number || !$scope.Entries.date) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $scope.Entries.project_systems = JSON.stringify($scope.ps);
            $scope.Entries.Data = JSON.stringify($scope.Entries.Data,  function( key, value ) {
                if( key === "$$hashKey" ) {
                    return undefined;
                }
                return value;
            });

            var Data = new FormData();
            angular.forEach($scope.Entries, function (v, k) {
                Data.append(k, v);
            });
            $http.post($("#appurl").val() + 'Save-General-Entries', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                if(res.data.status == true){
                    $scope.Entries = {};
                    $scope.Entries.Data = [{}, {}];
                    $scope.ps = {};
                    swal('Success', res.data.message, 'success');
                }else if(res.data.status == false){
                    swal('Warning', res.data.message, 'warning');
                    $scope.Entries.Data = [{}, {}];
                    $scope.TotalDebit = 0;
                    $scope.TotalCredit = 0;
                } 
            });
        }
    };

    $scope.readUrl = function (element) {
        var reader = new FileReader();//rightbennerimage
        reader.onload = function (event) {
            $scope.comLogo = event.target.result;
            $scope.$apply(function ($scope) {
                $scope.Entries.deposit_slip = element.files[0];
            });
        };
        reader.readAsDataURL(element.files[0]);
    };


    $scope.getBanks = function(){
        var Banks = $http.get($("#appurl").val() + 'company/maintain-company-bankdetail');
        Banks.then(function (r) {
            $scope.BaknsDetail = r.data;
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
        $http.get($("#appurl").val() + 'project-system/create-projects/'+ JSON.stringify(arr)).then(function (response) {
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

    $scope.getActivities = function(project_id){
        $scope.ps.activity_id = 0;
        $http.get($("#appurl").val() + 'project-system/get-project-activities/'+ project_id + '/' + $("#company_id").val()).then(function (response) {
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
        $scope.ps.phase_id = 0;
        $http.get($("#appurl").val() + 'project-system/get-activity-phases/'+ activity_id + '/' + $("#company_id").val()).then(function (response) {
            if (response.data.data.length > 0) {
                $scope.phases = response.data.data;
                $scope.tasks = {};
            }else{
                $scope.nomorephase = "There is no phases";
            }
        });
    };

    $scope.getPhasesTasks = function(phase_id){
        $scope.ps.task_id = 0;
        $http.get($("#appurl").val() + 'project-system/get-phases-tasks/'+ phase_id + '/' + $("#company_id").val()).then(function (response) {
            if (response.data.data.length > 0) {
                $scope.tasks = response.data.data;
            }else{
                $scope.nomoretask = "There is no tasks";
            }
        });
    };
});