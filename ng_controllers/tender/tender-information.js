CreateTierApp.controller('TenderController', function ($scope, $http) {
    $("#tender").addClass('menu-open');
    $("#tender a[href='#']").addClass('active');
    $("#tender-information").addClass('active');

    $('#advertisment_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    
    $('#submission_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#opening_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#issuance_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#expiry_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $scope.resetScope = function(){
        $scope.app_url = $("#appurl").val();
        $scope.getoffice($("#company_id").val());
        $scope.getTendersInfo();
    };

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

    $scope.get_allattributes = function (category_id) {
        $http.get('get-attributes/'+category_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.attributes = response.data;
            }
        });
    };
    $scope.tender = {};
    $scope.appurl = $("#appurl").val();
    $scope.saveTender = function(){
        if (!$scope.tender.tender_name) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $scope.tender.company_id = $("#company_id").val();
            //$scope.tender.tender_date = $("#tender_date input").val();
            //$scope.tender.submission_date = $("#submission_date input").val();
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.tender, function (v, k) {
                Data.append(k, v);
            });
            $http.post('tender-information', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                if(res.data.status == true){
                    swal({
                        title: "Save!",
                        text: res.data.message,
                        type: "success"
                    });
                    $("#loader").removeClass('fa-spinner fa-fw fa-pulse').addClass('fa-save');
                    $scope.tender = {};
                    $scope.getTendersInfo();
                }else{
                    swal({
                        title: "Not Save!",
                        text: res.data.message,
                        type: "error"
                    });
                }
            });
        }
    };


    $scope.getTendersInfo = function () {
        $scope.allTenders = {};
        $scope.offset = 0;
        $scope.limit = 20;
        var arr = {
            'offset':$scope.offset,
            'limit':$scope.limit,
            'company_id': $("#company_id").val()
        };
        $("#get-loader").html('<i class="fa fa-spinner fa-sw fa-3x fa-pulse"></i>');
        $http.get('tender-information/'+ JSON.stringify(arr)).then(function (response) {
            if (response.data.status == true) {
                if(response.data.data.length > 0){
                    $scope.alltenders = response.data.data;
                    $scope.offset += $scope.limit;
                    $("#loadMore").show();
                }else{
                    $("#loadMore").hide();
                }
                $("#get-loader").html('');
            }else if(response.data.status == false){
                swal({
                    title: "Not Record!",
                    text: response.data.message,
                    type: "error"
                });
                $("#get-loader").html('');
            }else{
                swal({
                    title: "Not Record!",
                    text: response.data.message,
                    type: "error"
                });
                $("#get-loader").html('');
            }
        });

    };

    $scope.loadMore = function () {
        var arr = {
            'offset':$scope.offset,
            'limit':$scope.limit,
            'company_id': $("#company_id").val()
        };
        $("#get-loader").html('<i class="fa fa-spinner fa-sw fa-3x fa-pulse"></i>');
        $http.get('tender-information/'+ JSON.stringify(arr)).then(function (response) {
            if (response.data.data.length > 0) {
                $scope.alltenders = $scope.alltenders.concat(response.data.data);
                $scope.offset += $scope.limit;
                $("#get-loader").html('');
                $("#loadMore").show();
            }else{
                $("#loadMore").hide();
                $("#get-loader").html('');

            }
        });
    };

    $scope.productCategory = function () {
        $http.get('product-categories').then(function (response) {
            if (response.data.length > 0) {
                $scope.productCategories = response.data;
            }
        });
    };

    $scope.editTender = function (tender) {
        $http.get('tender-information/'+tender.id+'/edit').then(function (response) {
            $scope.tender = response.data.tender;
            angular.extend($scope.tender, response.data.orgContact, response.data.orgAddress, response.data.contactPerson);
        });
    };

    $scope.deleteTender = function (id) {
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
            $http.delete('tender-information/' + id).then(function (response) {
                if(response.data.status == true){
                    $scope.getTendersInfo();
                    swal("Deleted!", response.data.message, "success");
                }else{
                    swal("Not Deleted!", response.data.message, "error");
                }
            });
        });
    };

    $scope.readUrl = function (element) {
        var reader = new FileReader();//rightbennerimage
        reader.onload = function (event) {
            $scope.tenderimg = event.target.result;
            $scope.$apply(function ($scope) {
                $scope.tender.tenderimg = element.files[0];
            });
        };
        reader.readAsDataURL(element.files[0]);
    };

});