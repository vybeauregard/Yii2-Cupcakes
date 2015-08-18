angular.module('CupcakeApp.controllers', [])
    .controller('cupcakesController', function($scope, cupcakeAPIservice) {
    $scope.cupcakesList = [];

    cupcakeAPIservice.getCupcakes().success(function (response) {
        $scope.cupcakesList = response;
    });

    $scope.saveCupcakes = function(){
        cupcakeAPIservice.saveCupcakes($scope.cupcakesList).success(function (response) {
            $scope.cupcakesList = response;
        });
    }

});
