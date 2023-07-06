pohnchaDooApp.controller('productCtrl', function($scope, $http, toastr, env) {
    $scope.products = [];
    $scope.previous = null;
    $scope.next = null;
    $scope.vendorOptions = [];
    $scope.itemOptions = [];    
    $scope.variantsToRender = [];

    $scope.variant_1_disabled = true;
    $scope.variant_2_disabled = true;
    $scope.variant_3_disabled = true;

    $scope.product_details = {};
    $scope.product = {};

    $scope.filter_by_vendor = null;
    $scope.filter_by_item = null;    
    
    let url = env.API_URL;

    $scope.init = function() {
        $http({
            method : "GET",
              url : url+"get_all_products"
          }).then(function(response) {
              console.log(response);
            $scope.products = response.data.data;
            $scope.previous = response.data.prev_page_url;
            $scope.next = response.data.next_page_url;            
          }, function(response) {
            console.log(response);
        });
    };

    $scope.filter_product = function() {
        $http({
            method : "GET",
              url : url+"get_filter_products",
              params : { vendor_id : $scope.filter_by_vendor, item_id : $scope.filter_by_item }
          }).then(function(response) {
              console.log(response);
            $scope.products = response.data.data;
            $scope.previous = response.data.prev_page_url;
            $scope.next = response.data.next_page_url;            
          }, function(response) {
            console.log(response);
        });
    };

    $scope.gotoPage = function(link) {
        if($scope.filter_by_vendor){
            link = link + '&vendor_id=' + $scope.filter_by_vendor;
        }
        if($scope.filter_by_item){
            link = link + '&item_id=' + $scope.filter_by_item;
        }

        $scope.products = [];
        $scope.previous = null;
        $scope.next = null;

        $http({
            method : "GET",
              url : link
          }).then(function(response) {
              console.log(response);
            $scope.products = response.data.data;
            $scope.previous = response.data.prev_page_url;
            $scope.next = response.data.next_page_url;            
          }, function(response) {
            console.log(response);
        });
    };

    $scope.getVendorOptions = function() {
        $http({
            method : "GET",
              url : url+"get_vedor_options"
          }).then(function(response) {
              console.log(response);  
              $scope.vendorOptions = response.data;        
          }, function(response) {
            console.log(response);
        });
    };

    $scope.getItemOptions = function() {
        $http({
            method : "GET",
              url : url+"get_item_options"
          }).then(function(response) {
              console.log(response);  
              $scope.itemOptions = response.data;        
          }, function(response) {
            console.log(response);
        });
    };

    $scope.updateProductStatus = function(product){
        $http({
            method : "POST",
              url : url+"change_product_status",
              data : {productId : product.id , status: product.is_active}
          }).then(function(response) {
              console.log(response);
              if(response.data.success){
                toastr.success(response.data.success,'Status Updated!');    
              }    
          }, function(response) {
            console.log(response);
        });
    };

    $scope.getDetails = function (productId) {
        $http({
            method : "GET",
              url : url+"get_product_details",
              params : {id : productId}
          }).then(function(response) {
              response.data.net_price = parseInt(response.data.net_price);
              response.data.price = parseInt(response.data.price);
              response.data.is_active = parseInt(response.data.is_active);
              response.data.has_variant = parseInt(response.data.has_variant);
              $scope.product_details = response.data;  
              $scope.product = response.data;
              $scope.product.measure_rate = String($scope.product.measure_rate);
              $scope.product.measure_unit = ($scope.product.measure_unit == null) ? 'None' : $scope.product.measure_unit;
              
              $scope.product.product_variants.forEach((pv) => {
                  pv.price =parseInt(pv.price) ;
                  pv.discount = parseInt(pv.discount);
                  pv.net_price = parseInt(pv.net_price);
              });

          }, function(response) {
            console.log(response);
        });
    };

    $scope.addProduct = function(product){
        product.allVariants = $scope.variantsToRender;
        
        $http({
            method : "POST",
              url : url+"save_product",
              data : product
          }).then(function(response) {
              console.log(response);  
              toastr.success(response.data,'Product Added!');
              setTimeout(() => {
                window.location.href = url+'products';
              }, 2000);
          }, function(response) {
            for (let [key, value] of Object.entries(response.data.errors)) {
                toastr.error(value[0],'Error!'); 
            }
        });
    };

    $scope.updateProduct = function (product) {
        $http({
            method : "POST",
              url : url+"update_product",
              data : product
          }).then(function(response) {
              console.log(response);  
              toastr.success(response.data,'Product Updated!');
              setTimeout(() => {
                window.location.href = url+'products';
              }, 2000);
          }, function(response) {
            for (let [key, value] of Object.entries(response.data.errors)) {
                toastr.error(value[0],'Error!'); 
            }
        });
    }

    $scope.productVariants = function(newVariants){
        $scope.variantsToRender.length = 0;

        newVariants.forEach(function(vary) {
            $scope.variantsToRender.push({
                'variant_name':vary,
                'net_price':$scope.product.net_price,
                'vendor_price':$scope.product.vendor_price,
                'referal_percentage':$scope.product.referal_percentage,                
                'discount':$scope.product.discount,
                'price':$scope.product.price});
        });
        console.log($scope.variantsToRender);
    }

    //###### Angular JS watch section #######
    // Watching variant name changes
    $scope.$watch("product.variant_1", function (newVal, oldVal)
    {
        if(newVal && newVal.length > 0){
            $scope.variant_1_disabled = false;
        }
        else{
            $scope.variant_1_disabled = true;
        }
    });

    $scope.$watch("product.variant_2", function (newVal, oldVal)
    {
        if(newVal && newVal.length > 0){
            $scope.variant_2_disabled = false;
        }
        else{
            $scope.variant_2_disabled = true;
        }
    });

    $scope.$watch("product.variant_3", function (newVal, oldVal)
    {
        if(newVal && newVal.length > 0){
            $scope.variant_3_disabled = false;
        }
        else{
            $scope.variant_3_disabled = true;
        }
    });

    // Watching variant value changes
    $scope.$watch("product.variant_val_1", function (newVal, oldVal)
    {
        let totalVariants = [];
        if(newVal){
            if($scope.product.variant_val_2 && $scope.product.variant_val_2.length > 0){
                totalVariants =  newVal.flatMap(d => $scope.product.variant_val_2.map(v => v +'/'+ d));            
            }
            if($scope.product.variant_val_3 && $scope.product.variant_val_3.length > 0){
                totalVariants = totalVariants.flatMap(d => $scope.product.variant_val_3.map(v => v +'/'+ d));          
            }

            if((!$scope.product.variant_val_2 || $scope.product.variant_val_2.length == 0) && (!$scope.product.variant_val_3 || $scope.product.variant_val_3.length == 0)){
                $scope.productVariants(newVal);
            }
            else{
                $scope.productVariants(totalVariants);                
            }
        }
    });

    $scope.$watch("product.variant_val_2", function (newVal, oldVal)
    {
        let totalVariants = [];
        if(newVal){
            if($scope.product.variant_val_1 && $scope.product.variant_val_1.length > 0){
                totalVariants =  newVal.flatMap(d => $scope.product.variant_val_1.map(v => v +'/'+ d));            
            }
            if($scope.product.variant_val_3 && $scope.product.variant_val_3.length > 0){
                totalVariants = totalVariants.flatMap(d => $scope.product.variant_val_3.map(v => v +'/'+ d));          
            }

            if((!$scope.product.variant_val_1 || $scope.product.variant_val_1.length == 0) && (!$scope.product.variant_val_3 || $scope.product.variant_val_3.length == 0)){
                $scope.productVariants(newVal);
            }
            else{
                $scope.productVariants(totalVariants);
            }
        }
    });

    $scope.$watch("product.variant_val_3", function (newVal, oldVal)
    {
        let totalVariants = [];
        if(newVal){
            if($scope.product.variant_val_2 && $scope.product.variant_val_2.length > 0){
                totalVariants =  newVal.flatMap(d => $scope.product.variant_val_2.map(v => v +'/'+ d));            
            }
            if($scope.product.variant_val_1 && $scope.product.variant_val_1.length > 0){
                totalVariants = totalVariants.flatMap(d => $scope.product.variant_val_1.map(v => v +'/'+ d));          
            }

            if((!$scope.product.variant_val_1 || $scope.product.variant_val_1.length == 0) && (!$scope.product.variant_val_2 || $scope.product.variant_val_2.length == 0)){
                $scope.productVariants(newVal);                
            }
            else{
                $scope.productVariants(totalVariants);                
            }
        }
    });

    // Watch for prices
    $scope.$watch("product.price", function (newVal, oldVal)
    {
        if ($scope.product.price > 0 && $scope.product.discount == undefined) {
            $scope.product.discount = 0;
            $scope.product.net_price = $scope.product.price;
        }
        else if ($scope.product.price > 0 && $scope.product.discount >= 0) {
            $scope.product.net_price = $scope.product.price - $scope.product.discount;
        }             
    });
    
    $scope.$watch("product.discount", function (newVal, oldVal)
    {
        if ($scope.product.price > 0 && $scope.product.discount > 0) {
            $scope.product.net_price = $scope.product.price - $scope.product.discount;
        }             
    });

    $scope.$watch("product.net_price", function (newVal, oldVal)
    {
        if ($scope.product.net_price > 0 && $scope.product.discount == undefined) {
            $scope.product.discount = 0;
            $scope.product.price = $scope.product.net_price;
        }
        else if ($scope.product.net_price > 0 && $scope.product.discount >= 0) {
            $scope.product.price = $scope.product.net_price + $scope.product.discount;
        }
        else if ($scope.product.net_price == 0) {
            $scope.product.price = $scope.product.discount = 0;
        }             
    });
});