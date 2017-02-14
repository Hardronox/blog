angular.module('main').controller('main', ($scope, $http, $log, $location, $timeout) => {
	$scope.blogs = [];
	$scope.totalItems = 0;

	$timeout( () => {
		if ($location.search().page) {
			$scope.currentPage = $location.search().page;
		}
		else {
			$scope.currentPage = 0;
		}
		$scope.loadData();
	});

	$scope.itemsPerPage = 7;
	$scope.loadData = (category, changeCategory) => {

		$scope.category = category;
		$scope.pageForSize = $scope.currentPage - 1;
		if ($scope.pageForSize == -1) $scope.currentPage = 1;

		if (category) {
			$http.post("http://127.0.0.1:9200/myblogs/_search",
				{
					"from": $scope.itemsPerPage * ($scope.currentPage - 1), "size": $scope.itemsPerPage,
					"query": {
						"match": {
							"category": category
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
			$('a.category').removeClass('category');

			$('a:contains(' + category + ')').addClass('category');

			if (changeCategory) {
				$scope.currentPage = 1;
				$location.search('page', 1);
			}
		}
		else {
			$http.post("http://127.0.0.1:9200/myblogs/_search",
				{
					"from": $scope.itemsPerPage * ($scope.currentPage - 1), "size": $scope.itemsPerPage,

					"sort": {
						"id": {
							"order": "desc"
						}
					}
				}).success( (response) => {
					$scope.blogs = response.hits.hits;
					$scope.totalItems = response.hits.total;
				});

			$http.post("http://127.0.0.1:9200/myblogs/_search?sort=views:desc",
				{
					"from": 0, "size": 10
				}).success( (response) => {
					$scope.populars = response.hits.hits;
				});

		}

	};

	$scope.pageChanged = () => {
		$location.search('page', $scope.currentPage);
		$scope.loadData($scope.category);

		( ($) => {
			$(document).ready( () => {
				$('html, body').animate({
					'scrollTop': $('#top').offset().top
				}, 1000);
			});
		})(jQuery);
	};
});
