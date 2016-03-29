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
    console.log(index);
    if(index < 1) return;
    var obj = this.cells.splice(index, 1);
    this.cells.splice(index-1, 0, obj[0]);
  }

  this.shiftCellDown = function(index){
    console.log(index);
    if(index >= this.cells.length) return;
    var obj = this.cells.splice(index, 1);
    this.cells.splice(parseInt(index)+1, 0, obj[0]);
  }

  this.cons = function(){
    console.log('working!');
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
    'post_type': {
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

  this.cons = function(){
    console.log('digested');
  }

  // need to generate unique ids for html elements
  var html_id_base = "eap_id_",
      html_id_num = 0,
      html_id = "";
  this.html_id = 1;
  this.get_html_id = function(){
    return 'html_id';
//    return html_id;
  }

  this.set_html_id = function(){
    html_id_num = parseInt(html_id_num) + 1;
    html_id = html_id_base + html_id_num;
    return html_id;
    // return html_id;
  }

  // shortcode
  this.shortcode = function(){
    var _ = this,
        sc_obj = {cells: _.cells, resp: _.resp};
    return '[eap]'+ JSON.stringify(sc_obj) +'[/eap]';
  }

}] );
