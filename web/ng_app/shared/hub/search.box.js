app.directive('searchBox',function() {
    var directive = {};
    directive.restrict = 'E';
    directive.templateUrl =  paths.shared + '/hub/search.box.html';

    directive.controller = function($scope, $http, $timeout, $log, $element) {
        
        $scope.placeholder = 'type here...';
        $scope.searchPhrase = '';
        $scope.results = [];
        $scope.$log = $log;
        $scope.opened = false;
        $scope.focusIndex = null;

        /**
         * [focusSearch description]
         * @return {[type]} [description]
         */
        $scope.focusSearch = function() {
            $($element).find('input.main-search').focus();
        }

        /**
         * [closeResults description]
         * @param  {[type]} reset [description]
         * @return {[type]}       [description]
         */
        $scope.closeResults = function(reset) {
            $scope.opened = false;
            if (reset) {
                $scope.results = [];
                $scope.searchPhrase = '';
                $scope.focusSearch();
            }
        };

        $scope.$watch('results',function(newV,oldV) {
            if (newV.length === 0) {
                $scope.opened = false;
                $scope.focusIndex = null;
            } else {
                $scope.opened = true;
            }
        });

        /**
         * [navigate description]
         * @param  {[type]} e [description]
         * @return {[type]}   [description]
         */
        $scope.navigate = function(e) {
            var key = e.which || e.keyCode || e.charCode;

            /*
             * Array of permitted keys
             * 38 - up
             * 40 - down
             * 13 - enter
             */
            var keyException = [38,40,13];

            if ($.inArray(key, keyException) !== -1) {
                e.preventDefault();

                switch(key) {
                    case 38:
                        $scope.focusIndex = ($scope.focusIndex <= 1) ? $scope.results.length : $scope.focusIndex-1;
                        break;
                    case 40:
                        $scope.focusIndex = ($scope.focusIndex >= $scope.results.length) ? 1 : $scope.focusIndex+1;
                        break;
                }
            }
        }

        /**
         * [search description]
         * @param  {[type]} e [description]
         * @return {[type]}   [description]
         */
        $scope.search = function(e) {
            var key = e.which || e.keyCode || e.charCode;
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);

            /*
             * Array of permitted keys  
             * 8 - backspace
             * 46 - delete
             */
            var keyException = [8,46];
            
            /*
             * Alphanumerical keypress validation
             */
            var regex = new RegExp("^[a-zA-Z0-9]+$");

            
            /* Reset results */
            if ($scope.searchPhrase.length < 3 && $scope.results.length !== 0) $scope.results = [];
            
            /*
             * Search only if phrase is alphanumerical and longer than 2 chars.
             * Makes an exception for del,backspace
             */

            if ((regex.test(str) || $.inArray(key, keyException) !== -1) && $scope.searchPhrase.length >= 3) {
                
                $http.get(url.api+'/elastic?p='+$scope.searchPhrase).then(function(result) {
                    $scope.results = result.data;
                });
            }
        };

        // Init
        $scope.focusSearch();
    };

    return directive;
});