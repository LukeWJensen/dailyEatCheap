var app = angular.module('dailyEatCheapApp');

//Main controller
app.controller('MainCtrl', ['$scope', '$http' , 'WPService', function($scope, $http, WPService) {

    $http.get('wp-json/wp/v2/eats?per_page=50').success(function(eats){
        $scope.eats = eats;
    });

    //data from WP-service
    $scope.WPData = WPService;

}]);