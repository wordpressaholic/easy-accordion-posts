app.directive("addCell", function(){
  return {
    restrict: 'E',
    templateUrl: eap_data.templates['add-cell'],
    scope: {
      'add': '&'
    },
    // link: function(scope, element, attrs){
    //
    // }
  };
});
