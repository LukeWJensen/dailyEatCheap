var app = angular.module('dailyEatCheapApp');

app.controller('submitEatCtrl', function($scope, $http, WPService, yelpService, existingEatsService, submitEatService){

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

    //create an object to hold our form data
    $scope.formData = {
        daysValid: []
    };

    //allow user to select restaurant from returned collection for Eat submission
    $scope.selectRestaurant = function(clickedItem){

        //bind the clicked element to the scope for use in the view
        $scope.selectedRestaurant = clickedItem.toElement;

        //add selected restaurant's Yelp ID and additional info to formData object
        $scope.formData.yelpID = clickedItem.toElement.id;
        $scope.formData.name = clickedItem.toElement.dataset.name;
        $scope.formData.address = clickedItem.toElement.dataset.address;
        $scope.formData.city = clickedItem.toElement.dataset.city;
        $scope.formData.state = clickedItem.toElement.dataset.state;

        //check for any existing Eats that exist for the selected restaurant
        existingEatsService.checkEats($scope.formData.yelpID, function(eats) {

            $scope.existingEats = eats;

        });

        //set variable in the scope to hide the restaurant search form
        $scope.hideRestaurantSearch = true;

    };

    //add days_valid term IDs to formData
    $scope.addDay = function(selectedDay){

        var daysValidArr = $scope.formData.daysValid,
            daysValidInt = parseInt(selectedDay.toElement.value);

        //if the number in not yet in the array, add it
        if(daysValidArr.indexOf(daysValidInt) === -1) {
            $scope.formData.daysValid.push(daysValidInt);
        }else {
            //if it is in the array find its index and remove it
            var intIndex = daysValidArr.indexOf(daysValidInt);
            $scope.formData.daysValid.splice(intIndex, 1);
        }
    };

    //post Eat to Wordpress
    $scope.submitEat = function() {

        submitEatService.submitEat($scope.formData);

    };
});