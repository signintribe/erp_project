CreateTierApp.controller('CategoryController', function ($scope, $http) {
    $("#mstrial-management").addClass('menu-open');
    $("#mstrial-management a[href='#']").addClass('active');
    $("#add-category").addClass('active');
    $scope.get_allcategories = function (cat_id) {
        $http.get('get_categories/' + cat_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.categories = response.data;
            }
        });
    };
    
    $scope.get_categorywithitsparents = function (parent_id) {
        $scope.categorywithparents = {};
        $scope.categoryiesone = {};
        $scope.categoryiestwo = {};
        $scope.categoryiesthree = {};
        $scope.categoryiesfour = {};
        $scope.categoryiesfive = {};
        $("#catone").html('<div class="square-path-loader"></div>');
        $http.get('get-categorywithitsparents/' + parent_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.categorywithparents = response.data;
                $("#catone").html('');
            } else {
                $("#catone").html('');
            }
        });
    };

    $scope.get_categoriesone = function (parent_id) {
        $scope.categoryiesone = {};
        $scope.categoryiestwo = {};
        $scope.categoryiesthree = {};
        $scope.categoryiesfour = {};
        $scope.categoryiesfive = {};
        $("#cattwo").html('<div class="square-path-loader"></div>');
        $http.get('get-categorywithitsparents/' + parent_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.categoryiesone = response.data;
                $("#cattwo").html('');
            } else {
                $("#cattwo").html('');
            }
        });
    };

    $scope.get_categoriestwo = function (parent_id) {
        $scope.categoryiestwo = {};
        $scope.categoryiesthree = {};
        $scope.categoryiesfour = {};
        $scope.categoryiesfive = {};
        $("#catthree").html('<div class="square-path-loader"></div>');
        $http.get('get-categorywithitsparents/' + parent_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.categoryiestwo = response.data;
                $("#catthree").html('');
            } else {
                $("#catthree").html('');
            }
        });
    };

    $scope.get_categoriesthree = function (parent_id) {
        $scope.categoryiesthree = {};
        $scope.categoryiesfour = {};
        $scope.categoryiesfive = {};
        $("#catfour").html('<div class="square-path-loader"></div>');
        $http.get('get-categorywithitsparents/' + parent_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.categoryiesthree = response.data;
                $("#catfour").html('');
            } else {
                $("#catfour").html('');
            }
        });
    };

    $scope.get_categoriesfour = function (parent_id) {
        $scope.categoryiesfour = {};
        $scope.categoryiesfive = {};
        $("#catfive").html('<div class="square-path-loader"></div>');
        $http.get('get-categorywithitsparents/' + parent_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.categoryiesfour = response.data;
                $("#catfive").html('');
            } else {
                $("#catfive").html('');
            }
        });
    };

    $scope.get_categoriesfive = function (parent_id) {
        $scope.categoryiesfive = {};
        $("#catsix").html('<div class="square-path-loader"></div>');
        $http.get('get-categorywithitsparents/' + parent_id).then(function (response) {
            if (response.data.length > 0) {
                $scope.categoryiesfive = response.data;
                $("#catsix").html('');
            } else {
                $("#catsix").html('');
            }
        });
    };

    $scope.get_category = function (category_id) {
        $http.get('get_categories/' + category_id).then(function (response) {
            $scope.category = response.data[0];
            if($scope.category.category_image){
                $scope.catimage = 'public/category_images/' + $scope.category.category_image;
            }else{
                $scope.catimage = "";
            }
        });
    };

    $scope.readUrl = function (element) {
        var reader = new FileReader();//rightbennerimage
        reader.onload = function (event) {
            $scope.catimage = event.target.result;
            $scope.$apply(function ($scope) {
                $scope.category.categoryimage = element.files[0];
            });
        };
        reader.readAsDataURL(element.files[0]);
    };

    $scope.delete_category = function (category_id) {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {
            $http.get('delete_category/' + category_id).then(function (response) {
                if(response.data.status == true){
                    $scope.get_allcategories(0);
                    $scope.get_categorywithitsparents(1);
                    swal("Deleted!", response.data.message, "success");
                }else{
                    swal("Not Delete!", response.data.message, "error");
                }
            });
        });
    };

    $scope.category = {};
    $scope.save_category = function () {
        console.log($scope.category);
        if (!$scope.category.category_name) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.category, function (v, k) {
                Data.append(k, v);
            });
            $http.post('save_category', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                $scope.save_message = res.data;
                swal('Success', res.data, 'success');
                $scope.category = {};
                $("#loader").removeClass('fa-spinner fa-fw fa-pulse').addClass('fa-save');
                $scope.get_allcategories(0);
                $scope.get_allcategories(1);
            });
        }
    };
});