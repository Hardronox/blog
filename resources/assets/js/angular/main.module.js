angular.module('main', ['ui.router', 'ui.bootstrap'], ($interpolateProvider) => {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});
