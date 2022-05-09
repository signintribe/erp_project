CreateTierApp.controller('CompanyController', function ($scope, $http) {
    $("#employee").addClass('menu-open');
    $("#employee a[href='#']").addClass('active');
    $("#employee-contact-person").addClass('active');
    $scope.url = $("#appurl").val();

    $scope.getEmployees = function () {
        $http.get('getEmployees').then(function (response) {
            if (response.data.length > 0) {
                $scope.Users = response.data;
            }
        });
    };

    $scope.save_contactPerson = function(){
        $scope.contactperson.company_id = $("#company_id").val();
        $scope.contactperson.actor_name = 'employee';
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
        $http.get($scope.url + 'get-company-info/employee/'+ $("#company_id").val()).then(function (response) {
            if (response.data.length > 0) {
                $scope.contactpersons = response.data;
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
            $scope.contactperson.actor_id = parseInt($scope.contactperson.actor_id);
            if($scope.contactperson.picture){
                $scope.catimg = $scope.url +"public/contactperson_picture/" + $scope.contactperson.picture;
            }
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