var app = angular.module('app', []);

app.controller("MainCtrl", ['$scope', function($scope){

  // accordion cells
  this.default_cell =  {
    title: "((post_title))",
    content: "((excerpt | 30)) ((link | more))",
    type: "Regular",
    image: "Full",
    templateHelp: 1,
  };

  this.cells = [];

  this.addCell = function(){
    var copy = {};
    angular.copy(this.default_cell, copy)
    this.cells.push(copy);
  }

  var count = 0;
  while(count<3){
    this.addCell()
    count++;
  }

  this.removeCell = function(index){
    console.log(this.cells);
    this.cells.splice(index, 1);
  }

  this.shiftCellUp = function(index){
    if(index < 1) return;
    var obj = this.cells.splice(index, 1);
    this.cells.splice(index-1, 0, obj[0]);
  }

  this.shiftCellDown = function(index){
    if(index >= this.cells.length) return;
    var obj = this.cells.splice(index, 1);
    this.cells.splice(parseInt(index)+1, 0, obj[0]);
  }

  // responsiveness
  this.resp = {
    flex: [3, 3, 2],
    fixed: [300, 300], // mobile width not permitted
    image_height: [300, 300, 200],
    flex_or_fixed: 'flex'
  }

  // posts
  this.posts = {
    'post_type': ['news'],
        'posts_per_page': '10',
    'query_vars': '',
    'taxonomy': 'category',
    'terms': ['uncategorized']
  }

  // database
  this.database = {
    post_type: {

      'news': {
        'label': 'News',
        'taxonomy': {
          'world': {
            'label': 'World',
            'terms': {
                4: 'Lorem Ipsum',
                12: 'Dolor',
                18: 'Sit Amet',
            }
          },
          'local': {
            'label': 'Local',
            'terms': {
                4: 'Lorem Ipsum',
                12: 'Dolor',
                18: 'Sit Amet',
            }
          }
        }
      },

      'art': {
        'label': 'Art',
        'taxonomy': {
          'world': {
            'label': 'World',
            'terms': {
                4: 'Lorem Ipsum',
                12: 'Dolor',
                18: 'Sit Amet',
            }
          },
          'local': {
            'label': 'Local',
            'terms': {
                4: 'Lorem Ipsum',
                12: 'Dolor',
                18: 'Sit Amet',
            }
          }
        }
      },

      'cooking': {
        'label': 'Cooking',
        'taxonomy': {
          'world': {
            'label': 'World',
            'terms': {
                4: 'Lorem Ipsum',
                12: 'Dolor',
                18: 'Sit Amet',
            }
          },
          'local': {
            'label': 'Local',
            'terms': {
                4: 'Lorem Ipsum',
                12: 'Dolor',
                18: 'Sit Amet',
            }
          }
        }
      }

    }
  }

  this.id_base = "eap_";
  this.id_num = 0;
  this.id = "";

  this.get_id = function(){
    return this.id;
  }

  this.set_id = function(){
    // this.id = this.id_base + (++(parseInt(this.id_num)));
    // this.get_id();
    this.id = 'abc';
  }

  // shortcode
  this.shortcode = function(){
    var _ = this,
        sc_obj = {cells: _.cells, resp: _.resp};
    return '[eap]'+ JSON.stringify(sc_obj) +'[/eap]';
  }



}] );

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
    link: function(scope, element, attrs){

    }
  };
});

app.directive("addcell", function(){
  return {
    restrict: 'E',
    templateUrl: 'templates/add-cell.html',
    scope: {
      'add': '&'
    },
    link: function(scope, element, attrs){

    }
  };
});
