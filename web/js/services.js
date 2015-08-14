angular.module('CupcakeApp.services', []).
  factory('cupcakeAPIservice', function($http) {

    var cupcakeAPI = {};

    cupcakeAPI.getCupcakes = function() {
      return $http({
        method: 'JSONP',
        url: 'http://ergast.com/api/f1/2013/driverStandings.json?callback=JSON_CALLBACK'
      });
    }

    return cupcakeAPI;
  });
