var app = angular.module('dailyEatCheapApp');

//sayHello Directive
app.directive('sayHello', function(){
    return {
        restrict: 'EA',
        templateUrl: decLocalized.views + 'say-hello.html',
        controller: ['WPService', function(WPService) {
            WPService.getCurrentUser();
        }]
    };
});