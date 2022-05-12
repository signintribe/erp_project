CreateTierApp.controller('DesigntionController', function ($scope, $http) {
    $scope.resetscope = function(){
        $scope.designation = {}; 
        $scope.get_designations();
        $("#showreset").hide();
    };
    $scope.app_url = $('#appurl').val();
    $scope.company_id = $('#company_id').val();
    
    $scope.getoffice = function (company_id) {
        $scope.offices = {};
        $http.get($scope.app_url + 'company/getoffice/'+company_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.offices = response.data;
            }
        });
    };
    
    $scope.getDepartments = function (office_id) {
        $scope.departments = {};
        $http.get($scope.app_url + 'company/get-departments/'+office_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.departments = response.data;
            }
        });
    };

    $scope.get_groups = function(department_id){
        $http.get($scope.app_url + 'company/get-employee-group/' + department_id).then(function (response) {
            if(response.data.length > 0){
                $scope.allgroups = response.data;
            }
        });
    };

    $scope.get_designations = function(){
        $("#spinner").addClass('fa fa-spinner fa-pulse fa-sw fa-3x');
        $http.get($scope.app_url + 'company/designation-form/' + $scope.company_id).then(function (response) {
            if(response.data.length > 0){
                $scope.alldesignations = response.data;
                $("#spinner").removeClass('fa fa-spinner fa-pulse fa-sw fa-3x');
            }else{
                $("#spinner").removeClass('fa fa-spinner fa-pulse fa-sw fa-3x');
                $scope.norecord = "There is no record found";
            }
        });
    };

    $scope.deleteDesignation = function(des_id){
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
            $http.delete($scope.app_url + 'company/designation-form/'+des_id).then(function (response) {
                $scope.get_groups();
                swal("Deleted!", response.data, "success");
                $scope.get_designations();
            });
        });
    };

    $scope.saveDesignation = function(){
        if (!$scope.designation.designation_name || !$scope.designation.group_id) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            if($scope.designation.status == true){
                $scope.designation.status = 1;
            }else{
                $scope.designation.status = 0;
            }
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.designation, function (v, k) {
                Data.append(k, v);
            });
            $http.post($scope.app_url + 'company/designation-form', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                $("#loader").removeClass('fa-spinner fa-fw fa-pulse').addClass('fa-save');
                if(res.data.status == "true"){
                    swal({
                        title: "Save!",
                        text: res.data.message,
                        type: "success"
                    });
                    $scope.get_designations();
                    $scope.designation = {};
                    $scope.group = {};
                }else{
                    swal({
                        title: "Error!",
                        text: "There is problem while saving designation",
                        type: "error"
                    });
                }
            });
        }
    };

    $scope.editDesignation = function(des){
        $scope.departments = {};
        $scope.allgroups = {};
        $scope.getDepartments(des.office_id);
        $scope.get_groups(des.department_id);
        $scope.designation = des;
        $scope.designation.department_id = parseInt($scope.designation.department_id);
        $("#showreset").show();
    };
    $scope.resetForm = function(){
        $scope.departments = {};
        $scope.allgroups = {};
        $scope.designation = {};
        $("#showreset").hide();
    };

    $scope.readUrl = function (element) {
        var reader = new FileReader();//rightbennerimage
        reader.onload = function (event) {
            $scope.attachment = event.target.result;
            $scope.$apply(function ($scope) {
                $scope.designation.attachment = element.files[0];
            });
        };
        reader.readAsDataURL(element.files[0]);
    };
});
