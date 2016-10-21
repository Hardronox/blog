var main = angular.module('main', ['ui.router'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

