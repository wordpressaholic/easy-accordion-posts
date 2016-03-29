app.directive("cell", function(){
  return {
    restrict: 'E',
    templateUrl: 'templates/cell.html',
    scope: {
      'obj': '=',
      'shiftUp': '&',
      'shiftDown': '&',
      'remove': '&',
      'index': '@',
    },
    // link: function(scope, element, attrs){
    //
    // }
  };
});
