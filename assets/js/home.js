var App = angular.module('App', []);

App.directive('listUsers', function(){
  return {
    restrict: 'A',
    templateUrl: 'users/index.json.php',
    controller: function($scope){
      $scope.obj_users = 
    }
  };
});
