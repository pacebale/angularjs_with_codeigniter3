<! DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Angular JS with Codeigniter 3</title>
        <script src="<?=base_url()?>assets/js/angular.min.js"></script>
        <script src="<?=base_url()?>assets/js/angular-route.min.js"></script>
    </head>
    <body ng-app="app">
        <div ng-controller="MsgCtrl">
            <input type="text" ng-model="search_title" placeholder="Search"/>
            <ul>
                <li ng-repeat="m in msg | filter:search_title | orderBy:'title'">
                   {{ m.title }}

                   <a href="#" ng-click="delete(m.id)">Delete</a>
                   <a href="#" ng-click="edit(m.id)">Edit</a>
                </li>
            </ul>

            <hr>
            Tambah Data
            <input type="text" ng-model="create.title">
            <button type="submit" ng-click="formsubmit()"> Tambah </button>

            <hr>
            Edit Data
            <input type="text" ng-model="editc.title">
            <button type="submit" ng-click="editsubmit(editc.id)"> Simpan </button>
        </div>

    <script>

        var app = angular.module('app', ["ngRoute"]).
        config(["$httpProvider",function($httpProvider)
        {
            $httpProvider.interceptors.push(['$q', function($q) {
            return {
                    request: function(config) {
                        if (config.data && typeof config.data === 'object') {
                            // Check https://gist.github.com/brunoscopelliti/7492579
                            // for a possible way to implement the serialize function.
                            config.data = serialize(config.data);
                        }
                        return config || $q.when(config);
                    }
                };
            }]);

            var serialize = function(obj, prefix) {
                // http://stackoverflow.com/questions/1714786/querystring-encoding-of-a-javascript-object
                var str = [];
                for(var p in obj) {
                    var k = prefix ? prefix + "[" + p + "]" : p, v = obj[p];
                    str.push(typeof v == "object" ? serialize(v, k) : encodeURIComponent(k) + "=" + encodeURIComponent(v));
                }
                return str.join("&");
            }

        }]).
        run(function($http) {
            $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded; charset=UTF-8;";

        });

        app.controller("MsgCtrl", function($scope, $http) {
            $http.get('<?=base_url();?>index.php/msg/index')
                .success(function(data, status, headers, config) {
                    $scope.msg = data;
                })
                .error(function(data, status, headers, config) {
                // log error
                });

            $scope.delete = function($id) {
                $http.get('<?=base_url();?>index.php/msg/delete/' + $id)
                .success(function(data, status, headers, config) {
                    $scope.msg = data;
                });
            };

            $scope.edit = function($id) {
                $http.get('<?=base_url();?>index.php/msg/show/' + $id)
                    .success(function(data, status, headers, config) {
                        $scope.editc = data;
                    });
            };

            $scope.editsubmit = function($id) {
            $http.post('<?=base_url();?>index.php/msg/update/' + $id, { data: $scope.editc })
                .success(function(data, status, headers, config) {
                    $scope.editc.title = '';
                    $scope.msg = data;
                });
            };

            $scope.formsubmit = function() {
            $http.post('<?=base_url();?>index.php/msg/create', { data: $scope.create })
                .success(function(data, status, headers, config) {
                    $scope.create.title = '';
                    $scope.msg = data;
                });
            };
        });

    </script>
 </body>

</html>
