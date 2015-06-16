/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var app = angular.module('mainApp', []);
app.controller('MainController', function ($scope, $http, $log) {
    $scope.List = [];
    $scope.submit = function () {
        $scope.List.push($scope.item);
        $scope.item = "";
    };
    $scope.ListOptions = ["Fruit", "Vegetables", "Default"];
    $scope.getList = function (type) {
        $http({
            url: "list.php",
            method: "GET",
            params: {'Type': type} //, 'filter' : {'Year': '2014'}
        }).success(function (data) {
            $scope.List = data;
        }).error(function (data) {
            console.log(data);
        });
    };
});
//MenuController
app.controller('MenuController', function ($scope, $http, $log) {
    $scope.menus = [{"Name": "Home", "Url": "home.html"}, {"Name": "About Us", "Url": "about.html"}, {"Name": "Contact Us", "Url": "contact.html"}];

});
app.directive('shoppinglist', function () {
    return {
        restrict: 'E',
        scope: {model: '=', name: '@', suffix: '@'},
        controller: function ($scope) {
            $scope.activate = function (option, $event) {
                $scope.model = option;
                if ($event.stopPropagation) {
                    $event.stopPropagation();
                }
                if ($event.preventDefault) {
                    $event.preventDefault();
                }
                $event.cancelBubble = true;
                $event.returnValue = false;
            };
            $scope.isActive = function (option) {
                return option === $scope.model;
            };

        },
        template: "<div class='col-sm-2'><label class='col-sm-2 control-label'>{{name}}</label></div> " +
                " <div class='col-sm-10'> " +
                "   <ul class='list-group'> " +
                "     <li class='list-group-item list-group-item-{{suffix}}' ng-repeat='l in model track by $index'>{{l}}</li> " +
                "   </ul> " +
                " </div>"
    };
});
