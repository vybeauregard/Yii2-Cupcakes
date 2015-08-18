<body ng-app="CupcakeApp" ng-controller="cupcakesController">
  <table class="table table-bordered table-collapse table-striped">
    <thead>
      <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Description</th>
          <th>Cake Flavor 1</th>
          <th>Cake Flavor 2</th>
          <th>Cake Color</th>
          <th>Icing Flavor</th>
          <th>Icing Color</th>
          <th>Fondant?</th>
          <th>Calories</th>
      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="cupcake in cupcakesList">
        <td>{{cupcake.id}}</td>
        <td><input class="form-control" ng-model="cupcake.name" /></td>
        <td><textarea class="form-control" ng-model="cupcake.description"></textarea></td>
        <td><input class="form-control" ng-model="cupcake.cake_flavor_1"></td>
        <td><input class="form-control" ng-model="cupcake.cake_flavor_2"></td>
        <td><input class="form-control" ng-model="cupcake.cake_color"></td>
        <td><input class="form-control" ng-model="cupcake.icing_flavor"></td>
        <td><input class="form-control" ng-model="cupcake.icing_color"></td>
        <td><input class="form-control" ng-model="cupcake.fondant"></td>
        <td><input type="number" class="form-control" ng-model="cupcake.calories"></td>
      </tr>
    </tbody>
  </table>
  <input class="btn btn-success" type="button" value="Hello" ng-click="saveCupcakes()" />
</body>
