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

app.config(function ($stateProvider, $urlRouterProvider, $urlMatcherFactoryProvider, $locationProvider, $httpProvider) {

    $locationProvider.html5Mode(true);

    $urlMatcherFactoryProvider.strictMode(false);

    $stateProvider.state('home', {
        url: '/',
        controller: 'MainCtrl',
        templateUrl: decLocalized.views + 'home.html'
    }).state('submit-eat', {
        url: '/submit-eat',
        controller: 'SubmitEatCtrl',
        templateUrl: decLocalized.views + 'submitDeal.html'
    }).state('eat', {
        url: '/:slug',
        controller: 'EatCtrl',
        templateUrl: decLocalized.views + 'eat.html'
    });

    //$urlRouterProvider.otherwise('/');

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

});