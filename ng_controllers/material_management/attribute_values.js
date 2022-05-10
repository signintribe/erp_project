CreateTierApp.controller('AttributeValueController', function ($scope, $http) {
    $("#mstrial-management").addClass('menu-open');
    $("#mstrial-management a[href='#']").addClass('active');
    $("#add-attrValue").addClass('active');
    $scope.get_allattributes = function (category_id) {
        $http.get('get-attributes/'+category_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.attributes = response.data;
            }
        });
    };
    $scope.value = {};
    $scope.appurl = $("#appurl").val();
    $scope.save_attributevalueInfo = function(){
        if (!$scope.value.value_name) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.value, function (v, k) {
                Data.append(k, v);
            });
            $http.post('maintain-attribute-values', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data.message,
                    type: "success"
                });
                $("#loader").removeClass('fa-spinner fa-fw fa-pulse').addClass('fa-save');
                $scope.value = {};
               $scope.getAttributeValueInfo();
            });
        }
    };


    $scope.getAttributeValueInfo = function () {
        $scope.attributevalueinfo = {};
        $http.get('maintain-attribute-values').then(function (response) {
            if (response.data.length > 0) {
                $scope.attributevalueinfo = response.data;
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

    $scope.editAttributeValueInfo = function (id) {
        $http.get('maintain-attribute-values/'+id+'/edit').then(function (response) {
            $scope.get_allattributes(response.data[0].category_id);
            $scope.value = response.data[0];
            $scope.value.attribute_id = parseInt($scope.value.attribute_id);
            $scope.value.category_id = parseInt($scope.value.category_id);
        });
    };

    $scope.deleteAttributeValueInfo = function (id) {
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
            $http.delete('maintain-attribute-values/' + id).then(function (response) {
                if(response.data.status == true){
                    $scope.getAttributeValueInfo();
                    swal("Deleted!", response.data.message, "success");
                }else{
                    swal("Not Deleted!", response.data.message, "error");
                }
            });
        });
    };

});