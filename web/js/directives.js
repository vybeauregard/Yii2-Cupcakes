angular.module('CupcakeApp.directives', [])
    .directive('cupcakeId', function() {
        return {
            restrict: 'CE',
            replace: 'true',
            template: '<td>{{cupcake.id}}</td>'
        }
    }).directive('cupcakeName', function() {
        return {
            restrict: 'CE',
            replace: 'false',
            template: '{{cupcake.name}}'
        }
    }).directive('cupcakeDescription', function() {
        return {
            restrict: 'CE',
            replace: 'true',
            template: '<td>{{cupcake.description}}</td>'
        }
    }).directive('cupcakeCakeFlavor1', function() {
        return {
            restrict: 'CE',
            replace: 'true',
            template: '<td>{{cupcake.cake_flavor_1}}</td>'
        }
    }).directive('cupcakeCakeFlavor2', function() {
        return {
            restrict: 'CE',
            replace: 'true',
            template: '<td>{{cupcake.cake_flavor_2}}</td>'
        }
    }).directive('cupcakeCakeColor', function() {
        return {
            restrict: 'CE',
            replace: 'true',
            template: '<td>{{cupcake.cake_color}}</td>'
        }
    }).directive('cupcakeIcingFlavor', function() {
        return {
            restrict: 'CE',
            replace: 'true',
            template: '<td>{{cupcake.icing_flavor}}</td>'
        }
    }).directive('cupcakeIcingColor', function() {
        return {
            restrict: 'CE',
            replace: 'true',
            template: '<td>{{cupcake.icing_color}}</td>'
        }
    }).directive('cupcakeFondant', function() {
        return {
            restrict: 'CE',
            replace: 'true',
            template: '<td>{{cupcake.fondant}}</td>'
        }
    }).directive('cupcakeCalories', function() {
        return {
            restrict: 'CE',
            replace: 'true',
            template: '<td>{{cupcake.calories}}</td>'
        }
    });
