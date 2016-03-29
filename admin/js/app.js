var app = angular.module('app', []);

app.controller("MainCtrl", ['$scope', '$http', function($scope, $http){

  this.debugging = true;

  // outer buttons
  this.starterNotes = false;
  this.unlockPro = false;

  // demo data
  this.importingDemoData = false;
  this.importingDemoDataDone = false;

  this.importDemoData = function(){
    this.importingDemoData = true;
    var _ = this;
    $http({
      method: 'POST',
      url: eap_data.ajax_url,
      params: {
        nonce: eap_data.nonce,
        action: 'eap_import_demo_data',
      }
    }).then(function successCallback(response) {
        _.importingDemoData = false;
        _.importingDemoDataDone = true;
      }, function errorCallback(response) {
        _.importingDemoData = false;
        _.importingDemoDataDone = false;
      }
    );

  }

  // load examples
  this.loadExample = function( code ){
    code = eap_data.examples[ code ];
    // console.log('loaded: ', code);
    // code = JSON.parse( code );
    this.cells = this.clean_cells( code.cells );
    this.resp = code.resp;
    this.query = code.query;
    this.database = angular.merge(this.database, code.database);

  }

  // accordion cells
  this.default_cell =  {
    title: "((post_title | max_length: 20 | append:...))",
    content: "((excerpt | max_length: 135 | append:...))((link | text: know more))",
    type: "Regular",
    image: "Full",
    templateHelp: 1,
  };

  this.cells = [
    {
      title: "((post_title))",
      content: "((excerpt | 30)) ((link | more))",
      type: "Featured Image",
      image: "Full",
      templateHelp: 1,
    },
    {
      title: "((post_title | max_length: 20 | append:...))",
      content: "((excerpt | max_length: 135 | append:...))((link | text: know more))",
      type: "Regular",
      image: "Full",
      templateHelp: 1,
    }
  ];

  this.addCell = function(){
    var copy = {};
    angular.copy(this.default_cell, copy)
    this.cells.push(copy);
  }

  // var count = 0,
  //     total = 1;
  // while(count<total){
  //   this.addCell();
  //   count++;
  // }

  this.removeCell = function(index){
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

  this.cons = function(){
    console.log('working!');
  }

  // responsiveness
  this.resp = {
    flex: [3, 3, 1],
    fixed: [300, 300], // mobile width not permitted
    image_height: [300, 300, 200],
    flex_or_fixed: 'flex'
  }

  // posts
  this.query = {
    'posts_per_page': 10,
    'query_vars': ''
  }

  // trigger setting or unsetting related items in database hierarch
  this.set_post_type = function(post_type_name, no_bounce){
    var _ = this;
    if(this.database.post_type[post_type_name].use){ //checked
      angular.forEach(this.database.post_type[post_type_name].taxonomy, function(taxonomy_obj, taxonomy_name){
        taxonomy_obj.use = true;
        _.set_tax(post_type_name, taxonomy_name)
      })
    }else{ //unchecked
      angular.forEach(this.database.post_type[post_type_name].taxonomy, function(taxonomy_obj, taxonomy_name){
        taxonomy_obj.use = false;
        if(!no_bounce)
          _.set_tax(post_type_name, taxonomy_name)
      })
    }
  }

  this.set_tax = function(post_type_name, taxonomy_name, no_bounce){
    if(this.database.post_type[post_type_name].taxonomy[taxonomy_name].use){ //checked
      this.database.post_type[post_type_name].use = true;
      angular.forEach(this.database.post_type[post_type_name].taxonomy[taxonomy_name].terms, function(term_obj, term_key){
        term_obj.use = true;
      })
    }else{ //unchecked
      // deselect its terms
      angular.forEach(this.database.post_type[post_type_name].taxonomy[taxonomy_name].terms, function(term_obj, term_key){
        term_obj.use = false;
      })
      // deselect its post type if siblings taxonomies are not selected either
      var count = 0;
      angular.forEach(this.database.post_type[post_type_name].taxonomy, function(tax_obj, tax_name){
        if(tax_obj.use)
          count++;
      })
      if(!count){
        this.database.post_type[post_type_name].use = false;
        this.set_post_type(post_type_name, true);
      }
    }
  }

  this.set_term = function(post_type_name, taxonomy_name, term_id, no_bounce){
    if(this.database.post_type[post_type_name].taxonomy[taxonomy_name].terms[term_id].use){ //checked
      this.database.post_type[post_type_name].use = true;
      this.database.post_type[post_type_name].taxonomy[taxonomy_name].use = true;
    }else{
      // deselect its tax if sibling terms are not selected either
      var count = 0;
      angular.forEach(this.database.post_type[post_type_name].taxonomy[taxonomy_name].terms, function(term_obj, term_name){
        if(term_obj.use)
          count++;
      })
      if(!count){
        this.database.post_type[post_type_name].taxonomy[taxonomy_name].use = false;
        // console.log('taxonomy being unset: ', taxonomy_name);
        this.set_tax(post_type_name, taxonomy_name);
      }
    }
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
              4: {'label': 'Lorem Ipsum'},
              6: {'label': 'Dolor Sit'},
              15: {'label': 'Amet Consec'},
            }
          },
          'local': {
            'label': 'Local',
            'terms': {
              4: {'label': 'Lorem Ipsum'},
              6: {'label': 'Dolor Sit'},
              15: {'label': 'Amet Consec'},
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
              4: {'label': 'Lorem Ipsum'},
              6: {'label': 'Dolor Sit'},
              15: {'label': 'Amet Consec'},
            }
          },
          'local': {
            'label': 'Local',
            'terms': {
              4: {'label': 'Lorem Ipsum'},
              6: {'label': 'Dolor Sit'},
              15: {'label': 'Amet Consec'},
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
              4: {'label': 'Lorem Ipsum'},
              6: {'label': 'Dolor Sit'},
              15: {'label': 'Amet Consec'},
            }
          },
          'local': {
            'label': 'Local',
            'terms': {
                4: {'label': 'Lorem Ipsum'},
                6: {'label': 'Dolor Sit'},
                15: {'label': 'Amet Consec'},
            }
          }
        }
      }
    }
  };

  this.database = eap_data.database;

  this.selected_database = false;

  this.generate_selected_database = function(){
    var db = {};
    // iterate over post types
    angular.forEach(this.database.post_type, function(post_type_obj, post_type_name){
      if(post_type_obj.use){
        if(!db.post_type) db.post_type = {};
        db.post_type[post_type_name] = {use: true};

        // iterate over taxonomies
        angular.forEach(post_type_obj.taxonomy, function(taxonomy_obj, taxonomy_name){
          if(taxonomy_obj.use){
            if(!db.post_type[post_type_name].taxonomy) db.post_type[post_type_name].taxonomy = {};
            db.post_type[post_type_name].taxonomy[taxonomy_name] = {use: true};

            // iterate over terms
            angular.forEach(taxonomy_obj.terms, function(term_obj, term_id){
              if(term_obj.use){
                if(!db.post_type[post_type_name].taxonomy[taxonomy_name].terms) db.post_type[post_type_name].taxonomy[taxonomy_name].terms = {};
                db.post_type[post_type_name].taxonomy[taxonomy_name].terms[term_id] = {use: true};
              }
            })

          }
        })

      }
    })

    // console.log(db);
    this.selected_database = db;
    return db;
  }

  this.cons = function(){
    console.log('cons response');
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

  // removes the $$hashKey keys and decodes HTML entities
  this.clean_cells = function(original){
    var dup = angular.copy(original);
    angular.forEach(dup, function(obj, key){
      delete obj["$$hashKey"];

      obj['title'] = jQuery( '<textarea />' ).html( obj['title'] ).text( );
      obj['content'] = jQuery( '<textarea />' ).html( obj['content'] ).text( );

    })
    return dup;
  }

  // shortcode
  this.generate_shortcode = function(){
    var sc_obj = JSON.stringify({cells: this.clean_cells(this.cells), resp: this.resp, query: this.query, database: this.generate_selected_database()});

    var encodedStr = sc_obj.replace(/[\u00A0-\u9999<>\&]/gim, function(i) {
       return '&#'+i.charCodeAt(0)+';';
    });

    return '[eap]'+ encodedStr +'[/eap]';
  }
  this.shortcode = this.generate_shortcode();

  this.shortcode_changed = function(string){
    if( ! this.debugging ) return;

    string = string.substring(5);
    string = string.substring(0, string.length - 6);

    var sc_obj = JSON.parse(string);
    this.cells = this.clean_cells(sc_obj.cells);
    this.resp = sc_obj.resp;
    this.query = sc_obj.query;
    this.database = angular.merge(this.database, sc_obj.database);
  }

  this.shortcode_warning = function(){
    return ! this.selected_database['post_type'];
  }

}] );
