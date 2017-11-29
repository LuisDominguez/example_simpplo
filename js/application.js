
var Sinpplo = angular.module('SinpploApp', ['ngMaterial']);

Sinpplo.directive('errSrc', function() {
  return {
    link: function(scope, element, attrs) {

      var watcher = scope.$watch(function() {
          return attrs['ngSrc'];
        }, function (value) {
          if (!value) {
            element.attr('src', attrs.errSrc);
          }
      });

      element.bind('error', function() {
        element.attr('src', attrs.errSrc);
      });

      //unsubscribe on success
      element.bind('load', watcher);

    }
  }
});

Sinpplo.controller('Index', ['$scope','$http','$mdToast', function($scope,$http,$mdToast) {
  $scope.isLoading = true
  $scope.items_ads = []
  // $scope.request_url = ""
  $scope.request_url = "http://www.avisosdeocasion.com/vehiculos-usados-y-nuevos.aspx?n=autos-chevrolet-usados-y-nuevos-nuevo-leon&PlazaBusqueda=2&Plaza=2&pagina=3&idvehiculo=1&Marcas=11"

  $scope.getData = function(){
    $scope.isLoading = true
    url = "get_data.php" + "?url=" + window.btoa($scope.request_url);
    $http.get(url).success(function(response){
      $scope.items_ads = response
      $scope.isLoading = false
    })
  }

  $scope.insertData = function(){
    $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
    $scope.isLoading = true

    $http({
      url: "db/inserData.php",
      method: "POST",
      data: {'items_ads': $scope.items_ads},
      headers: {'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'}
    }).then(function(response){
      $mdToast.show(
        $mdToast.simple()
           .textContent(response['data']['message'])
         .position("top left" )
         .hideDelay(5000)
       );
       $scope.isLoading = false
       $scope.items_ads = []
       $scope.request_url = ""

    },function () {
      $scope.isLoading = false
      $mdToast.show(
        $mdToast.simple()
           .textContent("error al realizar la llamada")
         .position("top left" )
         .hideDelay(5000)
       );
    });
  }

  $scope.goToScript = function () {
    url = "get_data.php" + "?url=" + window.btoa($scope.request_url);
    window.open(url);

  }

}]);
