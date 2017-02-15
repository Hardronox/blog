angular.module('main').config( ($locationProvider, $stateProvider) => {

	$locationProvider.html5Mode({
		enabled: true,
		requireBase: false
	});

});
