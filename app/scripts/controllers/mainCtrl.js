/**
 * @ngdoc function
 * @name dailyEatCheapApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the dailyEatCheapApp
 */
var app = angular.module('dailyEatCheapApp');

//Main controller
app.controller('MainCtrl', ['$scope', '$http' , 'WPService', function($scope, $http, WPService) {

    $http.get('wp-json/wp/v2/eats?per_page=50').success(function(res){
        console.log(res);
        $scope.deals = res;
    });

    //data from WP-service
    $scope.WPData = WPService;

}]);