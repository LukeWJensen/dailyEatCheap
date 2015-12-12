var app = angular.module('dailyEatCheapApp');

app.service('submitEatService', function($http){

    //allow user to select restaurant from returned collection for Eat submission
    this.submitEat = function(formData){

        var eatTitle = formData.name+' - '+formData.address+' - '+formData.city+', '+formData.state,
            daysValidStr = formData.daysValid.toString();

        //create the Eat
        $http.post('wp-json/wp/v2/eats', {
            'title': eatTitle,
            'slug': formData.yelpID,
            'rw_yelp_id': formData.yelpID,
            'days_valid': daysValidStr,
            'rw_deal_desc': formData.dealDesc,
            'rw_deal_terms': formData.dealTC,
            'status': 'publish'
        }).success(function(){
            console.log('post created');
        });
    };

});