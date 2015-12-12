var app = angular.module('dailyEatCheapApp');

app.service('yelpService', function($http){

    function randomString(length, chars) {
        var result = '';
        for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
        return result;
    }

    this.retrieveYelp = function(searchObj, callback) {
        var method = 'GET';
        var url = 'http://api.yelp.com/v2/search';
        var params = {
            callback: 'angular.callbacks._0',
            location: searchObj.location,
            oauth_consumer_key: decLocalized.yelpOauthConsumerKey,
            oauth_token: decLocalized.yelpOauthToken,
            oauth_signature_method: "HMAC-SHA1",
            oauth_timestamp: new Date().getTime(),
            oauth_nonce: randomString(32, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'),
            term: searchObj.name
        };
        var consumerSecret = decLocalized.yelpConsumerSecret;
        var tokenSecret = decLocalized.yelpTokenSecret;
        var signature = oauthSignature.generate(method, url, params, consumerSecret, tokenSecret, { encodeSignature: false});
        params['oauth_signature'] = signature;
        $http.jsonp(url, {params: params}).success(callback);
    }

});