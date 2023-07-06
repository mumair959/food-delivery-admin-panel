pohnchaDooApp.controller('categoryCtrl', function($scope, $http, toastr, env) {
    $scope.categories = [];
    $scope.category = {};
    $scope.previous = null;
    $scope.next = null;
    $scope.all_available = '1';
    let url = env.API_URL;

    $scope.init = function() {
        $http({
            method : "GET",
              url : url+"get_categories"
          }).then(function(response) {
              console.log(response);
            $scope.categories = response.data.data;
            $scope.previous = response.data.prev_page_url;
            $scope.next = response.data.next_page_url; 

            let na = $scope.categories.filter(category => (category.is_available == '0'));
            if (na.length > 0) {
                $scope.all_available = '0';
            }           
          }, function(response) {
            console.log(response);
        });
    };

    $scope.updateAllCategoryAvailibility = function () {
        $scope.categories.forEach(elem => {
            elem.is_available = $scope.all_available;
        });

        $http({
            method : "POST",
              url : url+"update_all_categories_availibility",
              data : {is_available: $scope.all_available}
          }).then(function(response) {
              console.log(response.data);  
              toastr.success(response.data,'Categories Availibility Updated!');
          }, function(response) {
            console.log(response);
        });
    }

    $scope.gotoPage = function(link) {
        $scope.categories = [];
        $scope.previous = null;
        $scope.next = null;

        $http({
            method : "GET",
              url : link
          }).then(function(response) {
              console.log(response);
            $scope.categories = response.data.data;
            $scope.previous = response.data.prev_page_url;
            $scope.next = response.data.next_page_url;            
          }, function(response) {
            console.log(response);
        });
    };

    $scope.getCategoryInfo = function (id) {
        $http({
            method : "GET",
              url : url+"get_categories_data",
              params : {id : id}
          }).then(function(response) {
              $scope.category = response.data;   
              $scope.category.id = id;        
          }, function(response) {
            console.log(response);
        });
    }

    $scope.updateCategoryAvailibility = function (availibility) {
        $http({
            method : "POST",
              url : url+"update_category_availibility",
              data : {category_id: availibility.id, is_available: availibility.is_available}
          }).then(function(response) {
              console.log(response.data);  
              toastr.success(response.data,'Category Availibility Updated!');
          }, function(response) {
            for (let [key, value] of Object.entries(response.data.errors)) {
                toastr.error(value[0],'Error!'); 
            }
        });
    }

    $scope.addCategory = function (category) {
        $http({
            method : "POST",
              url : url+"save_categories",
              data : category
          }).then(function(response) {
              console.log(response.data);  
              toastr.success(response.data,'New Category Added!');
              window.location.href = '/categories';
          }, function(response) {
            for (let [key, value] of Object.entries(response.data.errors)) {
                toastr.error(value[0],'Error!'); 
            }
        });
    }

    $scope.updateCategory = function (category) {
        category.id = $scope.category.id;
        $http({
            method : "POST",
              url : url+"update_categories",
              data : category
          }).then(function(response) {
              console.log(response.data);  
              toastr.success(response.data,'Category Updated Successfully!');
              window.location.href = '/categories';
          }, function(response) {
            for (let [key, value] of Object.entries(response.data.errors)) {
                toastr.error(value[0],'Error!'); 
            }
        });
    }

});