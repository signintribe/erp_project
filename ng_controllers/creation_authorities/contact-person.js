CreateTierApp.controller('CompanyController', function ($scope, $http) {
    $("#authorities").addClass('menu-open');
    $("#authorities a[href='#']").addClass('active');
    $("#authorities-contact-person").addClass('active');
    $scope.url = $("#appurl").val();

    $scope.allcompany_registrations = function () {
        $scope.allregistration = {};
        $http.get($scope.url + 'manage-authorities').then(function (response) {
            if (response.data.length > 0) {
                $scope.allregistration = response.data;
            }
        });
    };

    $scope.save_contactPerson = function(){
        $scope.contactperson.company_id = $("#company_id").val();
        $scope.contactperson.actor_name = 'authorities';
        if (!$scope.contactperson.actor_id) {
            $scope.showError = true;
            jQuery("input.required").filter(function () {
                return !this.value;
            }).addClass("has-error");
        } else {
            $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
            var Data = new FormData();
            angular.forEach($scope.contactperson, function (v, k) {
                Data.append(k, v);
            });
            $http.post($scope.url + 'manage-contactperson', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.contactperson = {};
                $scope.getContactPersons();
                $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
            });
        }
    };

    $scope.getContactPersons = function () {
        $scope.contactpersons = {};
        $("#table-loader").html('<i class="fa fa-spinner fa-sw fa-3x fa-pulse"></i>');
        $http.get($scope.url + 'get-company-info/authorities/'+ $("#company_id").val()).then(function (response) {
            if (response.data.length > 0) {
                $scope.contactpersons = response.data;
                $("#table-loader").html('');
            }
        });
    };

    $scope.readUrl = function (element) {
        var reader = new FileReader();//rightbennerimage
        reader.onload = function (event) {
            $scope.catimg = event.target.result;
            $scope.$apply(function ($scope) {
                $scope.contactperson.userpicture = element.files[0];
            });
        };
        reader.readAsDataURL(element.files[0]);
    };

    $scope.deleteContactPerson = function (id) {
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
            $http.delete($scope.url + 'manage-contactperson/' + id).then(function (response) {
                $scope.getContactPersons();
                swal("Deleted!", response.data, "success");
            });
        });
    };

    $scope.editContactPerson = function (id) {
        $http.get($scope.url + 'manage-contactperson/' + id + '/edit').then(function (response) {
            $scope.contactperson = response.data;
            $scope.getContact($scope.contactperson.contact_id);
            $scope.getSocialMedia($scope.contactperson.social_id);
            $scope.getAddress($scope.contactperson.address_id);
            $scope.catimg = $scope.url +"public/contactperson_picture/" + $scope.contactperson.picture;
        });
    };

    $scope.getContact = function(contact_id){
        $http.get($scope.url+'getContact/' + contact_id).then(function (response) {
            if (response.data) {
                angular.extend($scope.contactperson, response.data);
            }
        });
    };

    $scope.getSocialMedia = function(social_id){
        $http.get($scope.url+'getSocialMedia/' + social_id).then(function (response) {
            if (response.data) {
                angular.extend($scope.contactperson, response.data);
            }
        });
    };

    $scope.getAddress = function(address_id){
        $http.get($scope.url+'getAddress/' + address_id).then(function (response) {
            if (response.data) {
                angular.extend($scope.contactperson, response.data);
            }
        });
    };
});