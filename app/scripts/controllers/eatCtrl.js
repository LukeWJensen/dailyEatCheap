var app = angular.module('dailyEatCheapApp');

//controller for single Eat pages
app.controller('EatCtrl', function($scope, $stateParams, $http, eatDataService){

    console.log('ctrl is running');

    eatDataService.getEatData($stateParams).then(function(eatData){

        var WPeatData = eatData.data[0],
            eatSlug = WPeatData.slug;

        console.log('service returned data');

        $scope.eatData = eatData.data[0];



    });

});