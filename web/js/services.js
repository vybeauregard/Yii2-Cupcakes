angular.module('CupcakeApp.services', []).
  factory('cupcakeAPIservice', function($http) {

    var cupcakeAPI = {};

    cupcakeAPI.getCupcakes = function() {
      return $http({
        method: 'GET',
        url: 'cupcakes-api/index'
      });
    }

    return cupcakeAPI;
  });
