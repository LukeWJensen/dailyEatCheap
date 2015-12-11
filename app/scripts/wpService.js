var app = angular.module('dailyEatCheapApp');

function WPService($http) {

    var WPService = {
        categories: [],
        posts: [],
        pageTitle: 'Latest Posts:',
        currentPage: 1,
        totalPages: 1,
        currentUser: {}
    };

    WPService.getCurrentUser = function() {
        return $http.get('wp-json/wp/v2/users/me?_envelope&context=view').success(function(res){
            WPService.currentUser = res;
        });
    };

    return WPService;
}

app.factory('WPService', ['$http', WPService]);