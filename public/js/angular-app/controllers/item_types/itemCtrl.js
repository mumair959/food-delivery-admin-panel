pohnchaDooApp.controller('itemCtrl', function($scope, $http, toastr, env) {
    $scope.items = [];
    $scope.item = {};
    $scope.searchText = '';
    
    let url = env.API_URL;

    $scope.init = function() {
        $http({
            method : "GET",
              url : url+"get_all_items"
          }).then(function(response) {
              console.log(response);
            $scope.items = response.data.data;
            $scope.previous = response.data.prev_page_url;
            $scope.next = response.data.next_page_url;            
          }, function(response) {
            console.log(response);
        });
    };

    $scope.gotoPage = function(link) {
        $scope.items = [];
        $scope.previous = null;
        $scope.next = null;

        $http({
            method : "GET",
              url : link
          }).then(function(response) {
              console.log(response);
            $scope.items = response.data.data;
            $scope.previous = response.data.prev_page_url;
            $scope.next = response.data.next_page_url;            
          }, function(response) {
            console.log(response);
        });
    };

    $scope.addItem = function (item) {
        $http({
            method : "POST",
              url : url+"save_item",
              data : item
          }).then(function(response) {
              console.log(response);
              if(response.data){
                toastr.success(response.data,'Item Type Added!');  
                setTimeout(() => {
                    window.location.href = url+'item_types';
                  }, 2000);  
              }    
          }, function(response) {
            for (let [key, value] of Object.entries(response.data.errors)) {
                toastr.error(value[0],'Error!'); 
            }
        });
    }

    $scope.getItemInfo = function (id) {
        $http({
            method : "GET",
              url : url+"get_item_type",
              params : {id : id}
          }).then(function(response) {
              console.log(response);
              $scope.item = response.data;           
          }, function(response) {
            console.log(response);
        });
    }

    $scope.updateItem = function (item) {
        $http({
            method : "POST",
              url : url+"update_item",
              data : item
          }).then(function(response) {
              console.log(response);
              if(response.data){
                toastr.success(response.data,'Item Type Updated!');  
                setTimeout(() => {
                    window.location.href = url+'item_types';
                  }, 2000);  
              }    
          }, function(response) {
            for (let [key, value] of Object.entries(response.data.errors)) {
                toastr.error(value[0],'Error!'); 
            }
        });
    }

    // Watch for search
    $scope.$watch("searchText", function (newVal, oldVal)
    {
        if (newVal != '') {
            $http({
                method : "GET",
                url : url+"get_all_items",
                params : {searchText : newVal}
              }).then(function(response) {
                  console.log(response);
                $scope.items = response.data.data;
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