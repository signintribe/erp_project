CreateTierApp.controller('AttributeController', function ($scope, $http) {
    $("#mstrial-management").addClass('menu-open');
    $("#mstrial-management a[href='#']").addClass('active');
    $("#add-attribute").addClass('active');
    $scope.get_allcategories = function () {
        $http.get('product-categories').then(function (response) {
            if (response.data.length > 0) {
                $scope.categories = response.data;
            }
        });
    };
    $scope.attribute = {};
    $scope.appurl = $("#appurl").val();
    $scope.save_attributeInformation = function(){
        if (!$scope.attribute.attribute_name) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.attribute, function (v, k) {
                Data.append(k, v);
            });
            $http.post('maintain-attributes', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data.message,
                    type: "success"
                });
                $("#loader").removeClass('fa-spinner fa-fw fa-pulse').addClass('fa-save');
                $scope.attribute = {};
               $scope.getAttributeInformation();
            });
        }
    };


    $scope.getAttributeInformation = function () {
        $scope.attributeinformations = {};
        $http.get('maintain-attributes').then(function (response) {
            if (response.data.length > 0) {
                $scope.attributeinformations = response.data;
            }
        });
    };

    $scope.editAttributeInformation = function (id) {
        $http.get('maintain-attributes/'+id+'/edit').then(function (response) {
            $scope.attribute = response.data;
            $scope.attribute.category_id = parseInt($scope.attribute.category_id);
        });
    };

    $scope.deleteAttributeInformation = function (id) {
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
            $http.delete('maintain-attributes/' + id).then(function (response) {
                if(response.data.status == true){
                    $scope.getAttributeInformation();
                    swal("Deleted!", response.data.message, "success");
                }else{
                    swal("Not Deleted!", response.data.message, "error");
                }
            });
        });
    };

});