angular.module('CupcakeApp.services', [])
    .factory('cupcakeAPIservice', function($http) {

    var cupcakeAPI = {};

    cupcakeAPI.getCupcakes = function() {
        return $http({
            method: 'GET',
            url: 'cupcakes-api/index'
        });
    };
    cupcakeAPI.saveCupcakes = function(data) {
        return $http({
            method: 'PUT',
            data: data,
            url: 'cupcakes-api/update'
        });
    };

    return cupcakeAPI;
});
