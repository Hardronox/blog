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

  $scope.itemsPerPage = 7;
  $scope.loadData = function(category, changeCategory){

    $scope.category=category;
    $scope.pageForSize =$scope.currentPage -1;
    if ($scope.pageForSize== -1) $scope.currentPage=1;

    if (category)
    {
      $http.post("http://127.0.0.1:9200/myblogs/_search",
        {
          "from" : $scope.itemsPerPage*($scope.currentPage -1) , "size" : $scope.itemsPerPage,
          "query" : {
            "match" : {
              "category" : category
            }
          }
        }).success(function(response){
          $scope.blogs = response.hits.hits;
          $scope.totalItems = response.hits.total;
        });
      $('a.category').removeClass('category');

      $('a:contains('+category+')').addClass('category');

      if(changeCategory)
      {
        $scope.currentPage=1;
        $location.search('page', 1);
      }
    }
    else
    {
      $http.post("http://127.0.0.1:9200/myblogs/_search",
        {
          "from" : $scope.itemsPerPage*($scope.currentPage -1) , "size" : $scope.itemsPerPage,

          "sort": {
              "id": {
                "order": "desc"
              }
          }
        }).success(function(response){
          $scope.blogs = response.hits.hits;
          $scope.totalItems = response.hits.total;
        });

      $http.post("http://127.0.0.1:9200/myblogs/_search?sort=views:desc",
        {
          "from" : 0 , "size" : 10
        }).success(function(response){
          $scope.populars = response.hits.hits;
        });

    }

  };

  $scope.pageChanged = function() {
    $location.search('page', $scope.currentPage);
    $scope.loadData($scope.category);
  };

});
