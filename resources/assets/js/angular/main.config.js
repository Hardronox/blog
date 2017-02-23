angular.module('main').config( ($locationProvider) => {

	$locationProvider.html5Mode({
		enabled: true,
		requireBase: false
	});
});
