angular.module('main').controller('search', ($scope, $http, $log, $location, $timeout) => {
	$scope.blogs = [];
	$scope.totalItems = 0;
	$scope.itemsPerPage = 7;
	$scope.textToSearch=$location.search().q;

	//on page load
	$timeout( () => {
		if ($location.search().page) {
			$scope.currentPage = $location.search().page;
		}
		else {
			$scope.currentPage = 0;
		}
		$scope.loadData();
	});

	//loading search results from elastic
	$scope.loadData = () => {

		$scope.pageForSize = $scope.currentPage - 1;

		if ($scope.pageForSize == -1)
			$scope.currentPage = 1;

			$http.post("http://127.0.0.1:9200/myblogs/_search",
				{
					"from": $scope.itemsPerPage * ($scope.currentPage - 1), "size": $scope.itemsPerPage,
					"query": {
						"multi_match": {
							"query":  $scope.textToSearch,
							"fields": [ "title", "description", "text" ]
						}
					},
					"sort": {
						"id": {
							"order": "desc"
						}
					}
				}).success( (response) => {
					$scope.blogs = response.hits.hits;
					$scope.totalItems = response.hits.total;
				});



	};

	$scope.pageChanged = () => {
		$location.search('page', $scope.currentPage);
		$scope.loadData($scope.category);
		//scroll to top after click on paginate
		( ($) => {
			$(document).ready( () => {
				$('html, body').animate({
					'scrollTop': $('#top').offset().top
				}, 1000);
			});
		})($);
	};
});
