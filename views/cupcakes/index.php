<body ng-app="CupcakeApp" ng-controller="driversController">
  <table class="table table-bordered table-collapse table-striped">
    <thead>
      <tr><th colspan="5">Drivers Championship Standings</th></tr>
    </thead>
    <tbody>
      <tr ng-repeat="cupcake in cupcakesList">
        <td>{{$index + 1}}</td>
        <td>{{cupcake.Driver.nationality}}</td>
        <td>
          {{cupcake.Driver.givenName}}&nbsp;{{cupcake.Driver.familyName}}
        </td>
        <td>{{cupcake.Constructors[0].name}}</td>
        <td>{{cupcake.points}}</td>
      </tr>
    </tbody>
  </table>
</body>
