CreateTierApp.controller('CompanyController', function ($scope, $http) {
    $("#company").addClass('menu-open');
    $("#company a[href='#']").addClass('active');
    $("#company-profile").addClass('active');
    $scope.company = {};
    $scope.app_url = $('#baseurl').val();
    $scope.get_allcompanyinfo = function () {
        $http.get('getcompanyinfo').then(function (response) {
            if (response.data.length > 0) {
                $scope.companies = response.data;
            }
        });
    };

    $scope.deleteCompany = function (id) {
        swal({
            title: "Are you sure?",
            text: "Your will not be able to recover this record! ",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-primary",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function(){
            $http.delete('maintain-company/' + id).then(function (response) {
                $scope.get_allcompanyinfo();
                if(response.data.status === 0){
                    swal("Delete!", response.data.message, "success");
                }else{
                    swal("Not Delete!", response.data.message, "error");
                }
            });
        });
    };

    $scope.editCompany = function (id) {
        $http.get('maintain-company/' + id + '/edit').then(function (response) {
            if (response.data) {
                $scope.company = response.data;
                $("#companyname").attr('readonly', 'readonly');
                $("#companyname").attr('disabled', 'disabled');
                $scope.comLogo = $scope.app_url + 'public/company_logs/' + $scope.company.company_logo;
                /* $scope.get_companysocial($scope.company.social_id);
                $scope.get_companyaddress($scope.company.address_id);
                $scope.get_companycontact($scope.company.contact_id); */
                $("#restrict").hide();
                $("#updatebtn").show();
                $("#ShowPrint").show();
            }
        });
    };

    /* $scope.get_companysocial = function (social_id) {
        $http.get('getcompanysocial/' + social_id).then(function (response) {
            if (response.data) {
                angular.extend($scope.company, response.data);
            }
        });
    };

    $scope.get_companyaddress = function (address_id) {
        $http.get('getcompanyaddress/' + address_id).then(function (response) {
            if (response.data) {
                angular.extend($scope.company, response.data);
            }
        });
    };

    $scope.get_companycontact = function (contact_id) {
        $http.get('getcompanycontact/' + contact_id).then(function (response) {
            if (response.data) {
                angular.extend($scope.company, response.data);
            }
        });
    }; */

    $scope.check_company = function (company_name) {
        $http.get('check_company/' + company_name).then(function (response) {
            if (response.data) {
                $scope.checkcompany = response.data.company_name + " is already exist";
                $('#restrict').attr('disabled', 'disabled');
            } else {
                $scope.checkcompany = "This company is not exist";
                $('#restrict').removeAttr('disabled', 'disabled');
            }
        });
    };

    $scope.readUrl = function (element) {
        var reader = new FileReader();//rightbennerimage
        reader.onload = function (event) {
            $scope.comLogo = event.target.result;
            $scope.$apply(function ($scope) {
                $scope.company.companyLogo = element.files[0];
            });
        };
        reader.readAsDataURL(element.files[0]);
    };


    $scope.save_companyinfo = function () {
        console.log($scope.company);
        if (!$scope.company.company_name) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            var Data = new FormData();
            angular.forEach($scope.company, function (v, k) {
                Data.append(k, v);
            });
            $http.post('maintain-company', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.get_allcompanyinfo();
            });
        }
    };

    $scope.update_companyinfo = function () {
        if (!$scope.company.company_name) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-pulse fa-fw');
            var Data = new FormData();
            angular.forEach($scope.company, function (v, k) {
                Data.append(k, v);
            });
            //JSON.stringify($scope.company);
            $http.post('maintain-company' , Data , {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $("#loader").removeClass('fa-spinner fa-pulse fa-fw').addClass('fa-save');
                $scope.get_allcompanyinfo();
                /* $("#restrict").show();
                $("#updatebtn").hide(); */
            });
        }
    };
    $("#updatebtn").hide();
});