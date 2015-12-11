var app = angular.module('dailyEatCheapApp');

app.controller('submitEatCtrl', function($scope, $http, WPService, yelpService, submitEatService){

    //check if user is logged in and bind that information to the scope
    WPService.getCurrentUser().then(function(res){

        $scope.loggedIn = false;

        var user = res.data.body;

        //code to run if a user is currently logged in
        if(user.id) {

            //set $scope.loggedIn to true if the logged-in user has permission to create a post
            var userRole = user.roles[0],
                editRoles = ['administrator', 'editor', 'author'],
                canEdit = (editRoles.indexOf(userRole) > -1 ? true : false);
            $scope.loggedIn = ( user.id && canEdit ? true : false );
        }

    });

    //make request to Yelp and return businesses data
    $scope.searchYelp = function() {

        $scope.businesses = [];
        yelpService.retrieveYelp($scope.search, function (data) {

            console.log(data);

            $scope.businesses = data.businesses;
        });
    };

    //allow user to select restaurant from returned collection for Eat submission
    $scope.selectRestaurant = function(clickedItem){

        submitEatService.selectRestaurant(clickedItem);

    };

    //post Eat to Wordpress
    $scope.submitDeal = function() {

    };
});