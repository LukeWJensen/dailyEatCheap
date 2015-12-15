var app = angular.module('dailyEatCheapApp');

//controller for single Eat pages
app.controller('EatCtrl', function($scope, $stateParams, $http, eatDataService, yelpService){

    eatDataService.getEatData($stateParams).then(function(eatData){

        var WPeatData = eatData.data[0],
            yelpID = WPeatData.rw_yelp_id[0];

        $scope.eatData = eatData.data[0];

        //get restaurant data via the Yelp API
        yelpService.getRestaurantData(yelpID, function(restaurantData){
            $scope.rData = restaurantData;
        }).then(function(rData){

            //use latitude and longitude from rData on $scope to build a Google Map
            var lat = rData.data.location.coordinate.latitude,
                long = rData.data.location.coordinate.longitude;
            $scope.map = { center: { latitude: lat, longitude: long }, zoom: 15 };
            $scope.marker = {
                id: $scope.eatData.id,
                coords: {
                    latitude: lat,
                    longitude: long
                }
            };

            console.log($scope);

        });

    });

});