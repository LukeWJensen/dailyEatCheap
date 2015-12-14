var app = angular.module('dailyEatCheapApp');

app.service('existingEatsService', function($http){

    this.checkEats = function(eatSlug, callback){

        //check if any Eats already exists for this restaurant
        $http.get('wp-json/wp/v2/eats?filter[meta_key]=rw_yelp_id&filter[meta_value]='+eatSlug).success(callback);
    };

});