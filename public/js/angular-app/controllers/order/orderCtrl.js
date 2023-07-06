pohnchaDooApp.controller('orderCtrl', function($scope, $http, toastr, env) {
    $scope.orders = [];
    $scope.orderDetail = [];
    $scope.previous = null;
    $scope.next = null;
    $scope.order = {};
    $scope.orderInfo = {};    
    let url = env.API_URL;
    $scope.init = function() {
        $http({
            method : "GET",
              url : url+"get_all_orders"
          }).then(function(response) {
              console.log(response);
            $scope.orders = response.data.data;
            $scope.previous = response.data.prev_page_url;
            $scope.next = response.data.next_page_url;            
          }, function(response) {
            console.log(response);
        });
    };

    $scope.gotoPage = function(link) {
        $scope.orders = [];
        $scope.previous = null;
        $scope.next = null;

        $http({
            method : "GET",
              url : link
          }).then(function(response) {
              console.log(response);
            $scope.orders = response.data.data;
            $scope.previous = response.data.prev_page_url;
            $scope.next = response.data.next_page_url;            
          }, function(response) {
            console.log(response);
        });
    };
    
    $scope.openOrderDetail = function (order) {
        $scope.orderInfo.order_id = order.id;
        $scope.orderInfo.customer_name = order.customer.user.first_name+' '+order.customer.user.last_name;
        $scope.orderInfo.phone_num = order.customer.phone_num;
        $scope.orderInfo.address = order.address.house_num+' '+order.address.street+' '+order.address.area;
        $scope.orderInfo.delivery_fee = order.delivery_fee;
        $scope.orderInfo.promocode_fare = order.promocode_fare;        
        $scope.orderInfo.vat = order.vat;
        $scope.orderInfo.net_amount = order.net_amount;
        $scope.orderDetail = order.order_items;
        let orderDetailElem = angular.element('#orderDetailModal');
        orderDetailElem.modal('show');
    }

    $scope.approveOrder = function (order) {
        
    }
});