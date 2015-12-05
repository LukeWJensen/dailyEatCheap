var app = angular.module('dailyEatCheapApp');

app.controller('submitDealCtrl', function($scope, yelpService){

    $scope.searchYelp = function() {

        $scope.businesses = [];
        yelpService.retrieveYelp($scope.search, function (data) {

            console.log(data);

            $scope.businesses = data.businesses;
        });
    };
});