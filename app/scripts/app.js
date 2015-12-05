'use strict';

/**
 * @ngdoc overview
 * @name dailyEatCheapApp
 * @description
 * # dailyEatCheapApp
 *
 * Main module of the application.
 */
var app = angular
    .module('dailyEatCheapApp', [
        'ui.router',
        'ngAnimate',
        'ngResource',
        'ngSanitize',
        'ngTouch'
    ]);

app.config(function ($stateProvider, $urlRouterProvider, $locationProvider, $httpProvider) {

    $locationProvider.html5Mode(true);

    $stateProvider.state('home', {
        url: '/',
        controller: 'MainCtrl',
        templateUrl: decLocalized.views + 'home.html'
    }).state('submit-deal', {
        url: '/submit-deal',
        controller: 'submitDealCtrl',
        templateUrl: decLocalized.views + 'submitDeal.html'
    });

    $httpProvider.interceptors.push([function () {
        return {
            'request': function (config) {
                config.headers = config.headers || {};
                //add nonce to avoid CSRF issues
                config.headers['X-WP-Nonce'] = decLocalized.nonce;

                return config;
            }
        };
    }]);


    //$urlRouterProvider.otherwise('/');

});