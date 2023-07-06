pohnchaDooApp.controller('dashboardCtrl', function($scope, $http, env) {
    $scope.vendors = null;
    $scope.riders = null;
    $scope.customers = null;
    $scope.top_customer = null;  
    $scope.top_vendor = null; 
    $scope.top_product = null;        
    $scope.orders = null;
    
    let url = env.API_URL;
    $scope.init = function() {        
        $http({
            method : "GET",
              url : url+"dashboard"
          }).then(function(response) {
            $scope.vendors = response.data.vendors;
            $scope.riders = response.data.riders;
            $scope.customers = response.data.customers;
            $scope.top_customer = response.data.top_customer; 
            $scope.top_vendor = response.data.top_vendor;
            $scope.top_product = response.data.top_product;            
            $scope.orders = response.data.orders;
          }, function(response) {
            console.log(response);
        });
    };
});