angular.module('main').controller('main', ($scope, $http, $log, $location, $timeout) => {
	$scope.blogs = [];
	$scope.totalItems = 0;
	$scope.itemsPerPage = 7;

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

	//loading articles from elastic
	$scope.loadData = (category, changeCategory) => {

		$scope.category = category;
		$scope.pageForSize = $scope.currentPage - 1;

		if ($scope.pageForSize == -1)
			$scope.currentPage = 1;

		// on-change article category
		if (category) {
			$http.post("http://127.0.0.1:9200/myblogs/_search",
				{
					"from": $scope.itemsPerPage * ($scope.currentPage - 1), "size": $scope.itemsPerPage,
					"query": {
						"bool" : {
							"must" : [
								{ "match": { "status": "Published" } },
								{ "match": { "category": category } }
							]
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
		} else {
			//default load
			$http.post("http://127.0.0.1:9200/myblogs/_search",
				{
					"from": $scope.itemsPerPage * ($scope.currentPage - 1), "size": $scope.itemsPerPage,
					"query": {
						"match" : {
							"status" : "Published"
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

			//right column(popular)
			$http.post("http://127.0.0.1:9200/myblogs/_search",
				{
					"from": 0, "size": 10,
					"query": {
						"bool": {
							"should":
								{
									"match": {
										"status": "Published"
									}
								}
						}
					},
					"sort": {
						"views": {
							"order": "desc"
						}
					}
				}).success( (response) => {
					$scope.populars = response.hits.hits;

				});
		}
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

angular.module('main').filter('microDate', function () {
	return function (item) {
		return item.substr(0,19);
	};
});