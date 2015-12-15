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

app.directive('menuToggle', function(){
    return {
        restrict: 'EA',
        templateUrl: decLocalized.views + 'menu.html',
        link: function($scope){
            $scope.menuToggle = function(){

                var menuRight = document.getElementById('menu-right'),
                    menuToggle = document.getElementById('menu-toggle')

                classie.toggle( menuToggle, 'open' );
                classie.toggle( menuRight, 'open' );

            };
        }
    };
});