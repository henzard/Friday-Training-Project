/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var app = angular.module('mainApp', ['datatables']);
app.controller('MainController', function ($scope, $http, $log) {
    $scope.List = [];
    $scope.submit = function () {
        $scope.List.push($scope.item);
        $scope.item = "";
    };
    $scope.ListOptions = ["Fruit", "Vegetables", "Default"];
    $scope.create = function () {

    };
    $scope.read = function (isle) {
        $http({
            url: "list.php",
            method: "GET",
            params: {'action': 'Read', 'table': 'Items', 'where': {'Isle': isle}} //, 'filter' : {'Year': '2014'}
        }).success(function (data) {
            $scope.List = data;
        }).error(function (data) {
            console.log(data);
        });
    };
    $scope.update = function () {

    };
    $scope.delete = function () {

    };
    //https://l-lin.github.io/angular-datatables/#/withPromise
});
//MenuController
app.controller('MenuController', function ($scope, $http, $log) {
    $scope.menus = [{"Name": "Home", "Url": "home.html"}, {"Name": "About Us", "Url": "about.html"}, {"Name": "Contact Us", "Url": "contact.html"}];

});
