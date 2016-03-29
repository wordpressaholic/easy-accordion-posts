app.directive("cell", function(){
  return {
    restrict: 'E',
    templateUrl: eap_data.templates['cell'],
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
