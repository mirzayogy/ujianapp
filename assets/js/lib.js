//OFFLINE ONLY
const API_URL="https://singkron.lldikti11.or.id/api/";
// const API_URL_ALBERDO="https://sibeken.lldikti11.or.id/api/";
const API_URL_ALBERDO="https://localhost/alberdo/web/api/";
// const MAIN_URL="https://sibeken.lldikti11.or.id/";
const MAIN_URL="http://localhost/ujian/";

// function to make form values to json format
$.fn.serializeObject = function(){

    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

// function to set cookie
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

// get or read cookie
function getCookie(cname){
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' '){
            c = c.substring(1);
        }

        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function indoDate(time) {
    var r = time.match(/^\s*([0-9]+)\s*-\s*([0-9]+)\s*-\s*([0-9]+)(.*)$/);
    return r[3]+"-"+r[2]+"-"+r[1]+r[4];
}

// app html
   var app_html=`
       <div class='container'>

           <div class='page-header'>
               <h1 id='page-title'>Read Products</h1>
           </div>

           <!-- this is where the contents will be shown. -->
           <div id='page-content'></div>

       </div>`;

   // inject to 'app' in index.html
   $("#app").html(app_html);


// change page title
function changePageTitle(page_title){

   // change page title
   $('#page-title').text(page_title);

   // change title tag
   document.title=page_title;
}

function patah( str, width, brk, cut ) {

    brk = brk || 'n';
    width = width || 75;
    cut = cut || false;

    if (!str) { return str; }

    var regex = '.{1,' +width+ '}(\s|$)' + (cut ? '|.{' +width+ '}|.+$' : '|\S+?(\s|$)');

    return str.match( RegExp(regex, 'g') ).join( brk );

}

function cekLevel(jwt,level_boleh){
  var boleh = false;
  $.post(API_URL+"pengguna/validate-token.php", JSON.stringify({ jwt:jwt })).done(function(result) {
    return "SUKSES";
  //   if(result.data!=undefined){
  //     if(result.data.level==level_boleh){
  //       boleh = true;
  //     }
  //     return boleh;
  //   }else{
  //     return boleh;
  //   }
  })

  // on error/fail, tell the user he needs to login to show the account page
  .fail(function(result){
    return "GAGAL";
  });

  return "ANU";
}
