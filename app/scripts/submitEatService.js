var app = angular.module('dailyEatCheapApp');

app.service('submitEatService', function($http){

    this.selectRestaurant = function(selectedResult){

        console.log(selectedResult.toElement.id);

    }

});