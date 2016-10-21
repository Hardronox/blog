angular.module('main').controller('main', function ($scope,$http)
{
    $http.get("/api/todos").success(function(response){
        $scope.blogs = response;
        $scope.sorted= _.sortBy(response, function(i) { return i.views; });
        console.log($scope.sorted);
      });
});


//$scope.events = [];
//$scope.totalItems = 0;
////
//$timeout(function()
//{
//  if($location.search().page)
//  {
//    $scope.currentPage = $location.search().page;
//  }
//  else
//  {
//    $scope.currentPage = 0;
//  }
//  $scope.loadData(undefined,undefined,"*",$scope.city_id);
//});
//
//$scope.city_id=undefined;
//$scope.sort = function(sortBy)
//{
//
//  if ($scope.type==='desc')
//  {
//    $scope.type='asc';
//  }
//  else
//  {
//    $scope.type='desc';
//  }
//  $scope.sortBy=sortBy;
//  $scope.loadData($scope.sortBy,$scope.type, $scope.tags ,$scope.city_id);
//};
//
//$scope.maxSize = 10;
//$scope.itemsPerPage = 10;
//$scope.loadData = function(sortBy, type, tags, city_id){
//
//  sortBy= sortBy || 'id';
//  type = type || 'desc';
//  $scope.tags="*";
//
//
//  $scope.pageForSize =$scope.currentPage -1;
//  if ($scope.pageForSize== -1) $scope.currentPage=1;
//
//
//  if (city_id !== undefined || $location.search().city_id !== undefined)
//  {
//    $scope.city_id=city_id  ? city_id : $location.search().city_id;
//    $http.post("http://127.0.0.1:9200/event-elastics/_search?q=city_id:"+$scope.city_id+"&sort="+sortBy+":"+type, //q=tags:"+$scope.tags+"&
//      {
//        "from" : $scope.maxSize*($scope.currentPage -1) , "size" : $scope.maxSize,
//
//      }).success(function(response){
//        $location.search('city_id', city_id);
//        $scope.events = response.hits.hits;
//        $scope.totalItems = response.hits.total-$scope.itemsPerPage;
//      });
//  }
//  else
//  {
//    $http.post("http://127.0.0.1:9200/event-elastics/_search?sort="+sortBy+":"+type, //q=tags:"+$scope.tags+"&
//      {
//        "from" : $scope.maxSize*($scope.currentPage -1) , "size" : $scope.maxSize,
//
//      }).success(function(response){
//        $scope.count=response.hits.total;
//        $scope.events = response.hits.hits;
//        $scope.totalItems = response.hits.total-$scope.itemsPerPage;
//      });
//  }
//
//};
//
//$scope.pageChanged = function() {
//  $location.search('page', $scope.currentPage);
//  $location.search('city_id', $scope.city_id);
//  $scope.loadData($scope.sortBy, $scope.type, $scope.tags, $scope.city_id);
//};