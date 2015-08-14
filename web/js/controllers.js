angular.module('CupcakeApp.controllers', []).
  controller('driversController', function($scope, cupcakeAPIservice) {
    $scope.cupcakesList = [];

    cupcakeAPIservice.getCupcakes().success(function (response) {
        //Dig into the response to get the relevant data
        console.log(response);
        $scope.cupcakesList = response;
    });
  });
