angular.module('main').controller('main', function ($scope,$http, $log, $location, $timeout)
{
  $scope.blogs = [];
  $scope.totalItems = 0;

  $timeout(function()
  {
    if($location.search().page)
    {
      $scope.currentPage = $location.search().page;
    }
    else
    {
      $scope.currentPage = 0;
    }
    $scope.loadData();
  });

  $scope.maxSize = 5;
  $scope.itemsPerPage = 5;
  $scope.loadData = function(category){

    $scope.category=category;
    $scope.pageForSize =$scope.currentPage -1;
    if ($scope.pageForSize== -1) $scope.currentPage=1;

    if (category)
    {
      $http.post("http://127.0.0.1:9200/myblogs/_search",
        {
          "from" : $scope.maxSize*($scope.currentPage -1) , "size" : $scope.maxSize,
          "query" : {
            "match" : {
              "category" : category
            }
          }
        }).success(function(response){
          $scope.blogs = response.hits.hits;
          $scope.sorted = response.hits.hits;
          $scope.totalItems = response.hits.total;
        });
    }
    else
    {
      $http.post("http://127.0.0.1:9200/myblogs/_search",
        {
          "from" : $scope.maxSize*($scope.currentPage -1) , "size" : $scope.maxSize
        }).success(function(response){
          $scope.blogs = response.hits.hits;
          $scope.sorted = response.hits.hits;
          $scope.totalItems = response.hits.total;
        });
    }

  };

  $scope.pageChanged = function() {
    $location.search('page', $scope.currentPage);
    $scope.loadData($scope.category);
  };

});
