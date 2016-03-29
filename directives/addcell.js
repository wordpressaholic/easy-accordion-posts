app.directive("addcell", function(){
  return {
    restrict: 'E',
    templateUrl: 'templates/add-cell.html',
    scope: {
      'add': '&'
    },
    // link: function(scope, element, attrs){
    //
    // }
  };
});
