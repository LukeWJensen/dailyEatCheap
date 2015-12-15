var app = angular.module('dailyEatCheapApp');

//controller for single Eat pages
app.controller('EatCtrl', function($scope,$window, $stateParams, $http, eatDataService, yelpService){

    eatDataService.getEatData($stateParams).then(function(eatData){

        var WPeatData = eatData.data[0],
            yelpID = WPeatData.rw_yelp_id[0];

        console.log('Eat data service fired. Got yelp ID: '+yelpID);

        $scope.eatData = eatData.data[0];

        //get restaurant data via the Yelp API
        yelpService.getRestaurantData(yelpID, function(restaurantData){

        }).then(function(rData){

            $scope.rData = rData.data;

            console.log('Yelp service fired. Got restaurant data: '+$scope.rData.id);

            console.log($scope.rData.location.display_address[0]);

            //use latitude and longitude from rData on $scope to build a Google Map
            var lat = $scope.rData.location.coordinate.latitude,
                long = $scope.rData.location.coordinate.longitude;
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