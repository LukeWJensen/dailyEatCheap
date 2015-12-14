var app = angular.module('dailyEatCheapApp');

app.service('eatDataService', function($http){

    this.getEatData = function(stateParams){

        //check if any Eats already exists for this restaurant
        return $http.get('wp-json/wp/v2/eats?filter[name]=='+stateParams.slug).then(function(eatData){
            return eatData;
        });
    };

});