'use strict';

function Router(routes) {
  try {
    if (!routes) {
      throw 'error: routes param is mandatory';
    }
    this.constructor(routes);
    this.init();
  } catch (e) {
    console.error(e);
  }
}

Router.prototype = {
  routes: undefined,
  rootElem: undefined,
  liActive: undefined,
  constructor: function (routes){
    this.routes = routes;
    this.rootElem = document.getElementById('app');
  },
  init: function(){
    var r = this.routes;
    (function(scope,r) {
      window.addEventListener('hashchange',function(e){
        scope.hasChanged(scope,r);
      })
    })(this,r);
    this.hasChanged(this,r);
  },
  hasChanged: function(scope,r){
    if(window.location.hash.length>0){
      for (var i = 0, length = r.length; i < length; i++) {
        var route = r[i];
        if(route.isActiveRoute(window.location.hash.substr(1))){
          scope.goToRoute(route.htmlName);
        }
      }
    }else{
      for (var i = 0, length = r.length; i < length; i++) {
        var route = r[i];
        if(route.default){
          scope.goToRoute(route.htmlName);
        }
      }
    }
  },
  goToRoute: function (htmlName){
    (function(scope){
      var url = 'views/'+htmlName,xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function(){
        if(this.readyState === 4 && this.status === 200){
          scope.rootElem.innerHTML = this.responseText;

          $('.datepicker').bootstrapMaterialDatePicker({
            format: 'dddd DD MMMM YYYY',
            clearButton: true,
            weekStart: 1,
            time: false
          });


          $('.js-basic-example').DataTable();
          $('.js-exportable').DataTable();
          $('li > a').click(function() {
            $('li').removeClass();
            $(this).parent().addClass('active');
          });
          $('#form_validation').validate({
            rules: {
              'checkbox': {
                required: true
              },
              'gender': {
                required: true
              }
            },
            highlight: function (input) {
              $(input).parents('.form-line').addClass('error');
            },
            unhighlight: function (input) {
              $(input).parents('.form-line').removeClass('error');
            },
            errorPlacement: function (error, element) {
              $(element).parents('.form-group').append(error);
            }
          });

          //Advanced Form Validation
          $('#form_advanced_validation').validate({
            rules: {
              'date': {
                customdate: true
              },
              'creditcard': {
                creditcard: true
              }
            },
            highlight: function (input) {
              $(input).parents('.form-line').addClass('error');
            },
            unhighlight: function (input) {
              $(input).parents('.form-line').removeClass('error');
            },
            errorPlacement: function (error, element) {
              $(element).parents('.form-group').append(error);
            }
          });

          //Custom Validations ===============================================================================
          //Date
          $.validator.addMethod('customdate', function (value, element) {
            return value.match(/^\d\d\d\d?-\d\d?-\d\d$/);
          },
          'Please enter a date in the format YYYY-MM-DD.'
        );

        //Credit card
        $.validator.addMethod('creditcard', function (value, element) {
          return value.match(/^\d\d\d\d?-\d\d\d\d?-\d\d\d\d?-\d\d\d\d$/);
        },
        'Please enter a credit card in the format XXXX-XXXX-XXXX-XXXX.'
      );

      
      //==================================================================================================

    }
  };
  xhttp.open('GET', url, true);
  xhttp.send();
})(this);
}
};
