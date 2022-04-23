CreateTierApp.controller('ComContactController', function ($scope, $http) {
    $("#company").addClass('menu-open');
    $("#company a[href='#']").addClass('active');
    $("#company-contact").addClass('active');
    $scope.company = {};
    $scope.app_url = $('#baseurl').val();
    $scope.get_allcompanyinfo = function () {
        $http.get('getcompanyinfo').then(function (response) {
            if (response.data.length > 0) {
                $scope.companies = response.data;
            }
        });
    };

    $scope.get_companycontact = function () {
        $http.get('maintain-company-contact').then(function (response) {
            if (response.data.length > 0) {
                $scope.contacts = response.data;
            }
        });
    };

    $scope.deleteComContact = function (id) {
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
            $http.delete('maintain-company-contact/' + id).then(function (response) {
                $scope.get_companycontact();
                if(response.data){
                    swal("Delete!", response.data.message, "success");
                }else{
                    swal("Not Delete!", response.data.message, "error");
                }
            });
        });
    };

    $scope.editComContact = function (id) {
        $http.get('maintain-company-contact/' + id + '/edit').then(function (response) {
            if (response.data[0]) {
                $scope.company = response.data[0];
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

    /* $scope.check_company = function (company_name) {
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
    }; */


    $scope.save_comContactInfo = function () {
        //console.log($scope.company);
        if (!$scope.company.mobile_number) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.company, function (v, k) {
                Data.append(k, v);
            });
            $http.post('maintain-company-contact', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                $("#loader").removeClass('fa-spinner fa-fw fa-pulse').addClass('fa-save');
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.get_companycontact();
            });
        }
    };

    /* $scope.update_companyinfo = function () {
        if (!$scope.company.company_name || !$scope.company.phone_number || !$scope.company.mobile_number || !$scope.company.address_line_1 || !$scope.company.country || !$scope.company.linkedin || !$scope.company.website) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
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
                $scope.get_allcompanyinfo();
                /* $("#restrict").show();
                $("#updatebtn").hide(); 
            });
        }
    };
    $("#updatebtn").hide(); */
});