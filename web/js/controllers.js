angular.module('CupcakeApp.controllers', []).
  controller('driversController', function($scope, cupcakeAPIservice) {
    $scope.nameFilter = null;
    $scope.cupcakesList = [];

    cupcakeAPIservice.getCupcakes().success(function (response) {
        //Dig into the responde to get the relevant data
        $scope.cupcakesList = response.MRData.StandingsTable.StandingsLists[0].DriverStandings;
    });
  });
