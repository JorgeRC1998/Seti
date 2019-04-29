

angular.module('ppl', [])
    .controller('principal', function() {
        var app = angular.module("ppl", ["ngRoute"]);
        app.config(function($routeProvider) {
        $routeProvider
        .when("/", {
        templateUrl : "index.htm"
        })
        .when("/consultar", {
        templateUrl : "consultar.html"
        })
        .when("/insertar", {
        templateUrl : "insertar.htm"
        })
        .when("/actualizar", {
        templateUrl : "actualizar.htm"
        })
        .when("/eliminar", {
        templateUrl : "eliminar.htm"
        });
    });
});