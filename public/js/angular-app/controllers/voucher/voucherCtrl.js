pohnchaDooApp.controller('voucherCtrl', function($scope, $http, toastr, env) {
    $scope.vouchers = [];
    $scope.voucher = {};
    let url = env.API_URL;

    $scope.init = function () {
        $http({
            method : "GET",
              url : url+"get_all_vouchers"
          }).then(function(response) {
            $scope.vouchers = response.data;        
          }, function(response) {
        });
    }

    $scope.getDetails = function (id) {
        $http({
            method : "GET",
              url : url+"get_voucher_detail",
              params : {id : id}
          }).then(function(response) {
            response.data.start_at = new Date(response.data.start_at);
            response.data.expire_at = new Date(response.data.expire_at);
            $scope.voucher = response.data;        
          }, function(response) {
        });
    }

    $scope.addVoucher = function (voucher) {
        voucher.active = 'yes';  
        $http({
            method : "POST",
            url : url+"save_voucher",
            data : voucher
          }).then(function(response) {
              console.log(response);
              if (response.data.success) {
                toastr.success(response.data.success,'Voucher Created!');
                window.location.href = url+'vouchers';
              }
          }, function(response) {
            console.log(response);
        });
    }

    $scope.updateVoucher = function (voucher) {
        $http({
            method : "POST",
            url : url+"update_voucher",
            data : voucher
          }).then(function(response) {
              console.log(response);
              if (response.data.success) {
                toastr.success(response.data.success,'Voucher Updated!');
                window.location.href = url+'vouchers';
              }
          }, function(response) {
            console.log(response);
        });
    }

    $scope.updateVoucherStatus = function(vouch){
        $http({
            method : "POST",
              url : url+"change_voucher_status",
              data : {voucherId : vouch.id , status: vouch.active}
          }).then(function(response) {
              console.log(response);
              if(response.data.success){
                toastr.success(response.data.success,'Status Updated!');    
              }    
          }, function(response) {
            console.log(response);
        });
    };
});