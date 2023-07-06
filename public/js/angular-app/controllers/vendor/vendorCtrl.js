pohnchaDooApp.controller('vendorCtrl', function($scope, $http, toastr, env) {
    $scope.vendors = [];
    $scope.categories = [];
    $scope.previous = null;
    $scope.next = null;
    $scope.vendorDetail = {};
    $scope.vendor = {};
    let url = env.API_URL;
    $scope.init = function() {
        $http({
            method : "GET",
              url : url+"get_all_vendors"
          }).then(function(response) {
              console.log(response);
            $scope.vendors = response.data.data;
            $scope.previous = response.data.prev_page_url;
            $scope.next = response.data.next_page_url;            
          }, function(response) {
            console.log(response);
        });
    };

    $scope.get_vendor_detail = function(id) {
        $http({
            method : "GET",
              url : url+"get_vendor_details",
              params : {id : id}
          }).then(function(response) {
            $scope.vendorDetail = response.data;           
          }, function(response) {
            console.log(response);
        });
    };

    $scope.getAllCategories = function(id) {
        $http({
            method : "GET",
              url : url+"get_all_categories",
          }).then(function(response) {
            $scope.categories = response.data;         
          }, function(response) {
            console.log(response);
        });
    };

    $scope.addVendor = function (vendor) {
        $http({
            method : "POST",
              url : url+"save_vendor",
              data : vendor
          }).then(function(response) {
              console.log(response.data);  
              toastr.success(response.data,'Vendor Added!');
              $scope.vendor = {};
          }, function(response) {
            for (let [key, value] of Object.entries(response.data.errors)) {
                toastr.error(value[0],'Error!'); 
            }
        });
    }

    $scope.updateVendor = function (vendor) {
        $http({
            method : "POST",
              url : url+"update_vendor",
              data : vendor
          }).then(function(response) {
              console.log(response.data);  
              toastr.success(response.data,'Vendor Updated!');
          }, function(response) {
            for (let [key, value] of Object.entries(response.data.errors)) {
                toastr.error(value[0],'Error!'); 
            }
        });
    }

    $scope.updateVendorAvailibility = function (availibility) {
        $http({
            method : "POST",
              url : url+"update_vendor_availibility",
              data : {vendor_id: availibility.id, is_available: availibility.is_available}
          }).then(function(response) {
              console.log(response.data);  
              toastr.success(response.data,'Vendor Availibility Updated!');
          }, function(response) {
            for (let [key, value] of Object.entries(response.data.errors)) {
                toastr.error(value[0],'Error!'); 
            }
        });
    }

    $scope.getVendorInfo = function (vendorId) {
        $http({
            method : "GET",
              url : url+"get_vendor_details",
              params : {id : vendorId}
          }).then(function(response) {
            $scope.vendor = response.data;  
            console.log($scope.vendor);
          }, function(response) {
            console.log(response);
        });       
    }

    $scope.gotoPage = function(link) {
        $scope.vendors = [];
        $scope.previous = null;
        $scope.next = null;
        $scope.searchText = '';

        $http({
            method : "GET",
              url : link
          }).then(function(response) {
              console.log(response);
            $scope.vendors = response.data.data;
            $scope.previous = response.data.prev_page_url;
            $scope.next = response.data.next_page_url;            
          }, function(response) {
            console.log(response);
        });
    };

    // Watch for search
    $scope.$watch("searchText", function (newVal, oldVal)
    {
        if (newVal != '') {
            $http({
                method : "GET",
                  url : url+"get_all_vendors",
                  params : {searchText : newVal}
              }).then(function(response) {
                  console.log(response);
                $scope.vendors = response.data.data;
                $scope.previous = response.data.prev_page_url;
                $scope.next = response.data.next_page_url;            
              }, function(response) {
                console.log(response);
            });
        }
        else{
            $scope.init();
        }      
        
    });
});