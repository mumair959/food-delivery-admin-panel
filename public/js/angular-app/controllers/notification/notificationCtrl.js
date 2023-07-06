pohnchaDooApp.controller('notificationCtrl', function($scope, $http, toastr, env) {
    $scope.notification = {};
    $scope.old_notifications = [];
    $scope.previous = null;
    $scope.next = null;

    let url = env.API_URL;

    $scope.init = function() {
        $http({
            method : "GET",
              url : url+"get_old_notifications"
          }).then(function(response) {
              console.log(response);
            $scope.old_notifications = response.data.data;
            $scope.previous = response.data.prev_page_url;
            $scope.next = response.data.next_page_url;            
          }, function(response) {
            console.log(response);
        });
    };

    $scope.getNotificationDetail = function(id) {
        if (id != undefined) {
            $http({
                method : "GET",
                url : url+"get_notification_detail/"+id
              }).then(function(response) {
                $scope.notification = response.data;            
              }, function(response) {
                console.log(response);
            });
        }
    };

    $scope.gotoPage = function(link) {
        $scope.old_notifications = [];
        $scope.previous = null;
        $scope.next = null;

        $http({
            method : "GET",
              url : link
          }).then(function(response) {
              console.log(response);
            $scope.old_notifications = response.data.data;
            $scope.previous = response.data.prev_page_url;
            $scope.next = response.data.next_page_url;            
          }, function(response) {
            console.log(response);
        });
    };

    $scope.sendNotification = function (notification) {
        $http({
            method : "POST",
              url : url+"send_push_notification",
              data : notification
          }).then(function(response) {
              toastr.success(response.data.success,'Notification Sent!');
          }, function(response) {
            console.log(response);
        });
    }
});