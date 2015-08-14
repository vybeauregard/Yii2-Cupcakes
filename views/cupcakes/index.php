<body ng-app="CupcakeApp" ng-controller="driversController">
  <table class="table table-bordered table-collapse table-striped">
    <thead>
      <tr>
          <th></th>
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
        <td>{{$index + 1}}</td>
        <td>{{cupcake.name}}</td>
        <td>{{cupcake.description}}</td>
        <td>{{cupcake.cake_flavor_1}}</td>
        <td>{{cupcake.cake_flavor_2}}</td>
        <td>{{cupcake.cake_color}}</td>
        <td>{{cupcake.icing_flavor}}</td>
        <td>{{cupcake.icing_color}}</td>
        <td>{{cupcake.fondant}}</td>
        <td>{{cupcake.calories}}</td>
      </tr>
    </tbody>
  </table>
</body>
