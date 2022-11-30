TaskTierApp.controller('PayRollController', function ($scope, $http) {
    $scope.app_url = $("#appurl").val();
    $scope.payroll = {};
    $scope.assign_payroll = function () {
        if (!$scope.payroll.office_id || !$scope.payroll.department_id || !$scope.payroll.group_id || !$scope.payroll.payment_type) {
            $scope.showError = true;
            alert($scope.user.password);
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.payroll, function (v, k) {
                Data.append(k, v);
            });
            $http.post('assign-pay-roll', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                if(res.data.status == true){
                    swal({
                        title: "Save!",
                        text: res.data.message,
                        type: "success"
                    });
                    $scope.payroll = {};
                    $scope.getallpayroll();
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


    $scope.get_allpayroll = function () {
        $scope.getallpayroll = {};
        $scope.limit = 30;
        $scope.offset = 0;
        $scope.array = {
            'limit':$scope.limit,
            'offset':$scope.offset,
            'company_id': $("#company_id").val()
        };
        $http.get('assign-pay-roll/' + JSON.stringify($scope.array)).then(function (response) {
            if (response.data.length > 0) {
                $scope.getallpayroll = response.data;
                $scope.offset += $scope.limit;
                $("#btn-loadmore").show();
            }else{
                $scope.nomore = "No records found";
                $("#loadmore-spinner").removeClass('fa-pulse fa-sw');
                $(".btn-loadmore").hide();
            }
        });
    };
    $scope.get_allpayroll();

    $scope.getOnePayroll = function(payroll_id, payroll_type){
        $scope.payrolltype = payroll_type;
        $http.get('assign-pay-roll/' + payroll_id + '/edit').then(function (response) {
            if (response.data.status == true) {
                $scope.onePayroll = response.data.data;
                $scope.payrollpays = response.data.payrollpay;
                $scope.payrollallowance = response.data.payrollallowance;
                $scope.payrolllibility = response.data.payrolllibility;
                $scope.payrollded = response.data.payrollded;
                //$scope.getRunPayAllowance($scope.onePayroll.department_id);
            }
        });
    };

    $scope.loadMore = function(){
        $("#loadmore-spinner").addClass('fa-pulse fa-sw');
        $scope.array = {
            'limit':$scope.limit,
            'offset':$scope.offset,
            'company_id': $("#company_id").val()
        };
        $http.get('assign-pay-roll/' + JSON.stringify($scope.array)).then(function (response) {
            if (response.data.length > 0) {
                $scope.getallpayroll = $scope.getallpayroll.concat(response.data);
                $scope.offset += $scope.limit;
                $("#loadmore-spinner").removeClass('fa-pulse fa-sw');
                $("#btn-loadmore").show();
            }else{
                $scope.nomore = "No more records found";
                $("#loadmore-spinner").removeClass('fa-pulse fa-sw');
                $(".btn-loadmore").hide();
            }
        });
    };

    $scope.getoffice = function () {
        $scope.offices = {};
        $http.get($scope.app_url + 'company/getoffice/' + $("#company_id").val()).then(function (response) {
            if (response.data.length > 0) {
                $scope.offices = response.data;
            }
        });
    };

    $scope.getDepartments = function (office_id) {
        $scope.departments = {};
        $http.get($scope.app_url + 'company/get-departments/' + office_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.departments = response.data;
            }
        });
    };

    $scope.getGroup = function (dept_id) {
        $scope.allgroups = {};
        $http.get($scope.app_url + 'company/get-employee-group/'+ dept_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.allgroups = response.data;
                $scope.getPayAllowance(dept_id);
            }
        });
    };

    $scope.getEmployess = function (group_id) {
        $scope.allemployees = {};
        $http.get($scope.app_url + 'company/get-employees/'+ group_id).then(function (response) {
            if (response.data.status == true) {
                $scope.allemployees = response.data.data;
            }else{
                $scope.norecods = $scope.data.message;
            }
        });
    };

    $scope.getPayAllowance = function(dept_id){
        $scope.allAllowances = {};
        $http.get($scope.app_url + 'hr/get-all-payallowance/'+ dept_id).then(function (response) {
            if (response.data.status == true) {
                $scope.payallowance = response.data.data;
                $scope.pays = response.data.data.pays;
                $scope.allowances = response.data.data.allowances;
                $scope.deductions = response.data.data.deductions;
                $scope.libilities = response.data.data.libilities;
            }else{
                $scope.norecods = $scope.data.message;
            }
        });
    };

    /* $scope.getRunPayAllowance = function(dept_id){
        //$scope.allAllowances = {};
        $http.get($scope.app_url + 'hr/get-all-payallowance/'+ dept_id).then(function (response) {
            if (response.data.status == true) {
                $scope.rpayallowance = response.data.data;
                $scope.rpays = response.data.data.pays;
                $scope.rallowances = response.data.data.allowances;
                $scope.rdeductions = response.data.data.deductions;
                $scope.rlibilities = response.data.data.libilities;
            }else{
                $scope.norecods = $scope.data.message;
            }
        });
    }; */

    $scope.prpays = [];
   /**
    * 
    * @param {*} list 
    * Add check list into array pass to controller
    */
   $scope.getPays = function(list){
       let index = $scope.prpays.indexOf(list);
       if(index == -1){
           $scope.prpays.push(list);
       }else{
           $scope.prpays.splice(index, 1);
       }
       $scope.payroll.prpays = JSON.stringify($scope.prpays);
       console.log($scope.payroll.prpays);
   };

   $scope.allowance = [];
   /**
    * 
    * @param {*} list 
    * Add check list into array pass to controller
    */
   $scope.getAllowance = function(list){
       let index = $scope.allowance.indexOf(list);
       if(index == -1){
           $scope.allowance.push(list);
       }else{
           $scope.allowance.splice(index, 1);
       }
       $scope.payroll.allowance = JSON.stringify($scope.allowance);
       console.log($scope.payroll.allowance);
   };

   $scope.deduct = [];
   /**
    * 
    * @param {*} list 
    * Add check list into array pass to controller
    */
   $scope.getDeduct = function(list){
       let index = $scope.deduct.indexOf(list);
       if(index == -1){
           $scope.deduct.push(list);
       }else{
           $scope.deduct.splice(index, 1);
       }
       $scope.payroll.deduct = JSON.stringify($scope.deduct);
       console.log($scope.payroll.deduct);
   };

   $scope.libility = [];
   /**
    * 
    * @param {*} list 
    * Add check list into array pass to controller
    */
   $scope.getLibility = function(list){
       let index = $scope.libility.indexOf(list);
       if(index == -1){
           $scope.libility.push(list);
       }else{
           $scope.libility.splice(index, 1);
       }
       $scope.payroll.libility = JSON.stringify($scope.libility);
       console.log($scope.payroll.libility);
   };

   $scope.employee = [];
   /**
    * 
    * @param {*} list 
    * Add check list into array pass to controller
    */
   $scope.getEmployees = function(list){
       let index = $scope.employee.indexOf(list);
       if(index == -1){
           $scope.employee.push(list);
       }else{
           $scope.employee.splice(index, 1);
       }
       $scope.payroll.employee = JSON.stringify($scope.employee);
       console.log($scope.payroll.employee);
   };
});