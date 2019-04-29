// var app = angular.module("myApp", []);
// app.controller("myCtrl", function($scope , $http) {
//         $scope.greeting = "";
//         $http.get('http://rest-service.guides.spring.io/greeting').
//         then(function(response) {
//             $scope.greeting = response.data;
//         });
//         console.log('Hola senior ' + $scope.greeting);
// });

angular.module('demo', [])
.controller('consultar', function($scope, $http) {
    $http.get('http://localhost/MisProyectos/Prueba/index.php/select').
        then(function(response) {
            $scope.greeting = response.data;
        });
});