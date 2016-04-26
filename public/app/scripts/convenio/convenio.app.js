(function (angular) {
  'use strict';
  var module = 'scripts/convenio/';

  angular.module('publicApp.convenioApp', [])
    .config(function ($routeProvider) {
      $routeProvider
        .when('/convenios', {
          templateUrl: module + 'views/home.html',
          controller: 'ConvenioController',
          controllerAs: 'convenioCtrl'
        })
    });

})(angular);
