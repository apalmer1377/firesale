var myacc;
var edacc = '';
var prevnum;
var prevsel;
var sor=[];
var map;
var googMap;
var markers = [];
var marker;
var piccount;
var picframe;
var shownpic = 1;
var updatequery;

var mapswap = '<table id="mapswap">\
		  <tr>\
		    <th id="gotomap">\
		      <span>MAP</span>\
		    </th>\
		    <th class="mapswapclick" id="gotopics">\
		      <span>PICTURES</span>\
		    </th>\
		  </tr>\
		</table>';

var testitout = '<div id="testitout"> \
		  <div class="picmove" id="moveleft"><p>&lt;</p></div> \
		  <div class="picmove" id="nomove"></div>\
		  <div class="picmove" id="moveright"><p>&gt;</p></div>\
		</div>';
		
var checksave = '<div id="modal"> \
  <div id="modal-content">\
  <div id="mod-con">\
  <div id="modtop"></div>\
  <div id="modmid"></div>\
  <div id="modbot"></div></div</div></div>';
		
var checkdel = '<div id="modal"> \
  <div id="modal-content"> \
  <div id="mod-con"> \
  <div id="modtop"><span>DELETE POST</span></div> \
  <div id="modmid"><div><p>Are you sure you want to delete this post?</p></div></div> \
  <div id="modbot"><button type="button" class="yesdel">Yes, get rid of it</button><button type="button" id="nodel">No, I wanna keep it</button></div></div></div>\
  </div>';

var checkexit = '<div id="modal"> \
	    <div id="modal-content"> \
	      <div id="mod-con"> \
	        <div id="modtop"><span>DELETE MY ACCOUNT</span></div> \
	        <div id="modmid"><div><p>Are you sure you want to delete your account?</p></div></div> \
	        <div id="modbot"><button type="button" id="yesleave">Yes, get me out of here</button><button type="button" id="noleave">No, I changed my mind</button></div> \
	      </div> \
	     </div> \
	   </div>';
	   
var checkedit = '<div id="modal"> \
	    <div id="modal-content"> \
	      <div id="mod-con"> \
	        <div id="modtop"><span>CONFIRM YOUR IDENTITY</span></div> \
	        <div id="modmid"><br><p>To make changes, please enter your password below.</p><br> \
	        <table><tr id="checkuserrow"><td class="checkit"><span>E-mail Address: </span></td><td class="checkin"><span>' + $('#meemail').text() + '</span></td></tr> \
	        <tr id="checkpassrow"><td class="checkit"><label for="checkpass">Password: </label></td><td class="checkin"><input type="password" name="checkpass" id="checkpass"></td></tr></table> \
	        </div> \
	        <div id="modbot"><button type="submit" id="yesedit">Continue</button><button type="button" id="noedit">Eh, never mind</button></div> \
	      </div> \
	     </div> \
	   </div>';


function expand(n) {
    
    var num = n;
    window.scrollTo(0,$('#sres'+num).offset().top);
    //document.getElementById('locinput').value = '#sres'+num;
    if ($('#testform').attr('id')) {
      $('#testform').remove();
    }
    $('#sres'+prevnum).remove();
    $('#picframe').remove();
    $('#mapswap').remove();
    $('.edit span').text('EDIT POST');
    $('.deletepost span').text('DELETE POST');
    
    if (prevnum >= 0) {
    if (prevnum == 1) {
      $('#searchcontent').prepend(prevsel);
    } else {
      $('#editpics'+(prevnum-1)).after(prevsel);
    }}
    
    if (num != prevnum) {

      prevsel = $('#sres'+num).clone();
    //if (sor[num-1].address) {
      if (num > 1) { $('#filler').css('min-height',$('#sres'+num).offset().top-379); 
          $('#googmap').css('border-top','solid 1px #eeeeee');
        }
        else { $('#filler').css('min-height',$('#sres'+num).offset().top-378);
              $('#googmap').css('border-top','none'); }
    /*} else {
        $('#filler').css('min-height','0');
    }*/
    if (sor[num-1].author) {
        if (sor[num-1]['edition'] !== '') {
          var ed = 'Edition: ' + sor[num-1]['edition'];
        } else {
          var ed = '';
        }
        
        if (sor[num-1]['publisher'] !== '') {
          var pu = 'Publisher: ' + sor[num-1]['publisher'];
        } else {
          var pu = '';
        }
        
        if (sor[num-1]['phone'] !== '') {
          var ph = 'Phone: ' + sor[num-1]['phone'];
        } else {
          var ph = '';
        }
        
        if (sor[num-1]['email'] !== '') {
          var em = 'Email: ' + sor[num-1]['email'];
        } else {
          var em = '';
        }
        
        deets = '<table class="sres ares" id="sres' + num + '"> \
        <tr class="titleslot"><td colspan="6" class="nameslot"><span>' + sor[num-1]['name'] + '</span></td><td class="priceslot"><span>$'+ sor[num-1]['price'] + '</span></td></tr> \
        <tr class="miscslot"><td colspan="4" class="wcard"><span>By ' + sor[num-1]['author'] + '</span></td> \
        <td colspan="3" class="contslot"><span>' + sor[num-1]['college_posted'] + '</span></td></tr> \
        <tr class="miscslot"><td colspan="4" class="wcard"><span>' + pu + '</span></td><td colspan="3" class="contslot"><span>' + ph + '</span></td></tr> \
        <tr class="miscslot"><td colspan="4" class="wcard"><span>' + ed + '</span></td><td colspan="3" class="contslot"><span>' + em + '</span></td></tr> \
        <tr class="miscslot"><td colspan="2" class="nameslot"><span>Description:</span></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td></tr> \
        <tr class="lastslot"><td colspan="7" class="lslot"><p>' + sor[num-1]['description'] + '</p></td></tr></table>';

        
    } else if (sor[num-1].address) {
        map.setCenter(markers[num-1].getPosition());
        
        if (sor[num-1]['phone'] !== '') {
          var ph = 'Phone: ' + sor[num-1]['phone'];
        } else {
          var ph = '';
        }
        
        if (sor[num-1]['email'] !== '') {
          var em = 'Email: ' + sor[num-1]['email'];
        } else {
          var em = '';
        }
        deets = '<table class="sres ares" id="sres' + num + '"> \
        <tr class="titleslot"><td colspan="5" class="nameslot"><span>' + sor[num-1]['address'] + ' ' + sor[num-1]['apt'] + '</span></td><td colspan="2" class="priceslot"><span>$'+ sor[num-1]['rent'] + '/month</span></td></tr> \
        <tr class="miscslot"><td class="wcard"><span>Beds: ' + sor[num-1]['beds'] + '</span></td><td class="wcard"><span>Baths: ' + sor[num-1]['baths'] + '</span></td>\
        <td colspan="2" class="wcard"></td><td colspan="3" class="contslot"><span>' + sor[num-1]['city'] + ', ' + sor[num-1]['state'] + ' ' + sor[num-1]['zip'] + '</span></td></tr> \
        <tr class="miscslot"><td colspan="4" class="wcard"><span>Availability: ' + sor[num-1]['start_date'].replace(/-/g,'/') + ' - ' + sor[num-1]['end_date'].replace(/-/g,'/') + '</span></td><td colspan="3" class="contslot"><span>' + ph + '</span></td></tr> \
        <tr class="miscslot"><td colspan="4" class="wcard"></td><td colspan="3" class="contslot"><span>' + em + '</span></td></tr> \
        <tr class="miscslot"><td colspan="2" class="nameslot"><span>Description:</span></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td></tr> \
        <tr class="lastslot"><td colspan="7" class="lslot"><p>' + sor[num-1]['description'] + '</p></td></tr></table>';
    } else if (sor[num-1].type) {
        if (sor[num-1]['phone'] !== '') {
          var ph = 'Phone: ' + sor[num-1]['phone'];
        } else {
          var ph = '';
        }
        
        if (sor[num-1]['email'] !== '') {
          var em = 'Email: ' + sor[num-1]['email'];
        } else {
          var em = '';
        }
        deets = '<table class="sres ares" id="sres' + num + '"> \
        <tr class="titleslot"><td colspan="5" class="nameslot"><span>' + sor[num-1]['name'] + '</span></td><td colspan="2" class="priceslot"><span>$'+ sor[num-1]['price'] + '</span></td></tr> \
        <tr class="miscslot"><td colspan="4" class="wcard"><span>' + sor[num-1]['type'] + '</span></td><td colspan="3" class="contslot"><span>' + sor[num-1]['college_posted'] + '</span></td></tr> \
        <tr class="miscslot"><td colspan="4" class="wcard"></td><td colspan="3" class="contslot"><span>' + ph + '</span></td></tr> \
        <tr class="miscslot"><td colspan="4" class="wcard"></td><td colspan="3" class="contslot"><span>' + em + '</span></td></tr> \
        <tr class="miscslot"><td colspan="2" class="nameslot"><span>Description:</span></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td></tr> \
        <tr class="lastslot"><td colspan="7" class="lslot"><p>' + sor[num-1]['description'] + '</p></td></tr></table>';
      
    } else {
        if (sor[num-1]['phone'] !== '') {
          var ph = 'Phone: ' + sor[num-1]['phone'];
        } else {
          var ph = '';
        }
        
        if (sor[num-1]['email'] !== '') {
          var em = 'Email: ' + sor[num-1]['email'];
        } else {
          var em = '';
        }
        deets = '<table class="sres ares" id="sres' + num + '"> \
        <tr class="titleslot"><td colspan="5" class="nameslot"><span>' + sor[num-1]['name'] + '</span></td><td colspan="2" class="priceslot"><span>'+ sor[num-1]['price'] + '</span></td></tr> \
        <tr class="miscslot"><td colspan="4" class="wcard"></td><td colspan="3" class="contslot"><span>' + sor[num-1]['college'] + '</span></td></tr> \
        <tr class="miscslot"><td colspan="4" class="wcard"></td><td colspan="3" class="contslot"><span>' + ph + '</span></td></tr> \
        <tr class="miscslot"><td colspan="4" class="wcard"></td><td colspan="3" class="contslot"><span>' + em + '</span></td></tr> \
        <tr class="miscslot"><td colspan="2" class="nameslot"><span>Description:</span></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td></tr> \
        <tr class="lastslot"><td colspan="7" class="lslot"><p>' + sor[num-1]['description'] + '</p></td></tr></table>';
    }
    //var end = '<div class="edit"><span>EDIT POST</span></div><div class="deletepost"><span>DELETE POST</span></div>';
    
    //deets += end;
    $('#sres'+num).after(deets);
    $('#sres'+num).remove();
    prevnum = num;
      
    piccount=0;
    shownpic=1;
      picframe = '<div id="picframe">';
      for (var pici=0;pici < 5;pici++) {

          if (sor[num-1]['pic' + (pici+1)]) {
            var picsp = sor[num-1]['pic' + (pici+1)].split("/");
            if (picsp[4] !== '') {
            picframe += '<img id="pict' + (pici+1) + '" src="' + sor[num-1]['pic' + (pici+1)] + '">'; 
            piccount += 1;
            }
          }
      }
      
      if (piccount > 1) {
        picframe += testitout;
      }
      
      picframe += '</div>';

      $('#fillcont').append(picframe);
      $('#testitout').css('top',-1*(300*piccount));
      $('#picframe').css('top','0px');
      if (sor[num-1].address) {
        $('#fillcont').append(mapswap);/*
        $('#picframe').css('top',-1*(300*piccount));
        $('#mapswap').css('top',-1*(300*piccount));*/
      }
      /*else {
        if (piccount > 0) {
          $('#fillcont').append(picframe);
          $('#picframe').css('z-index','-1');
          $('#fillcont').append(mapswap);*/
          if (1==1) {
            $('#picframe').css('top','-301px');
          } else {
            $('#picframe').css('top','-302px');
          }/*
          $('#testitout').css('top',-1*(300*piccount));
          //$('#mapswap').css('top',-1*(300*piccount));
        }
      }*/
      
         /*  
      if (num > 1) { $('#filler').css('min-height',$('#sres'+num).position().top-1);
        $('#googmap').css('border-top','solid 1px #eeeeee');
        $('#picframe').css('border-top','solid 1px #eeeeee');
      }
      else { $('#filler').css('min-height',$('#sres'+num).position().top);
        $('#googmap').css('border-top','none');
        $('#picframe').css('border-top','none');
      }  */
      
      
    if (!sor[num-1].address) {
      //$('#content').append(picframe);
    }
    
          window.scrollTo(0,$('#sres'+n).offset().top);
      window.location.hash = '#sres'+num;
    
    } else {
      $('#filler').css('min-height','0px');
      $('#googmap').css('border-top','none');
      //window.scrollTo(0,0);
      if (sor[num-1].address) {
        if ($('#googmap').position().top + 160 > $('#sres'+(markers.length)).position().top ) {
          $('#filler').css('min-height',($('#sres'+(markers.length)).offset().top - 161));
        }
      }
      

      prevnum = 0;
    }
  }
  
 function addexpand(marker,k) {
  marker.addListener('click',function() {
    //map.setCenter(marker.getPosition());
    expand(k);
    
  });
} 
  
function initMarkers() {
      if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
      googMap = document.getElementById('googmap');
      map = new google.maps.Map(googMap, {
      center: {lat: position.coords.latitude,lng: position.coords.longitude
      }, zoom: 12
      
      });
      });
    setTimeout(function() {  
    for (var k=0;k<sor.length;k++) {
        if (sor[k]['address']) {
       markers[k] = new google.maps.Marker({
	    position: {
	    lat: parseFloat(sor[k]['lat']),
	    lng: parseFloat(sor[k]['lng'])
	    },
	    map: map,
	    });
	    addexpand(markers[k],(k+1));
      }
      }
    },5000);
  }
  
    
}

$(function() {
  window.location.hash='';

  var getdates = new XMLHttpRequest();
  getdates.onreadystatechange = function() {
  if (getdates.readyState==4 && getdates.status==200) {
      respon = JSON.parse(getdates.responseText);
      sor = respon.sort(function(a,b) {
        var da = a.posted_on.split(/[- :]/);
        var db = b.posted_on.split(/[- :]/);
        var datea = new Date(da[0],da[1]-1,da[2],da[3],da[4],da[5]);
        var dateb = new Date(db[0],db[1]-1,db[2],db[3],db[4],db[5]);
        return (dateb - datea);
      });
      for (var i=0;i <sor.length;i++) {
        if (sor[i]['pic1']) {
            var picf = '<img class="minipic" src="' + sor[i].pic1 + '">';
        } else {
            var picf = '';
        }
        if (sor[i].author) {
          firstrow = '<table class="sres ares" id="sres' + (i+1) + '"><tr class="titleslot"><td rowspan="3" class="picslot">' + picf + '</td><td class="blank"></td><td colspan="5" class="nameslot"><span>' + (i+1) + '. ' + sor[i]['name'] + '</span></td><td class="priceslot"><span>$' + sor[i]['price'] + '</span></td></tr>';
	        secondrow = '<tr class="miscslot"><td class="blank"></td><td colspan="3" class="wcard"><span>Author:  ' + sor[i]['author'] + '</span></td><td colspan="3" class="contslot"><span>' + sor[i]['college_posted'] + '</span></td></tr>';
	        thirdrow = '<tr class="miscslot"><td class="blank"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td colspan="2" class="contslot"></td></tr>';
	        fourthrow = '<tr class="descripslot"><td></td><td class="blank"></td><td colspan="6" class="dslot"><p>Description: ' + sor[i]['description'] + '</p></td></tr></table>';
	        tab = firstrow + secondrow + thirdrow + fourthrow;
	        //$('#searchcontent').append(tab);
        } else if (sor[i].address) {

          firstrow = '<table class="sres ares" id="sres' + (i+1) + '"><tr class="titleslot"><td rowspan="3" class="picslot">' + picf + '</td><td class="blank"></td><td colspan="4" class="nameslot"><span>' + (i+1) + '. ' + sor[i]['address'] + ' ' + sor[i]['apt'] + '</span></td><td colspan="2" class="priceslot"><span>$' + sor[i]['rent'] + '/month</span></td></tr>';
	        secondrow = '<tr class="miscslot"><td class="blank"></td><td class="wcard"><span>Beds: ' + sor[i]['beds'] + '</span></td><td class="wcard"><span>Baths: ' + sor[i]['baths'] + '</span></td><td class="wcard"></td><td colspan="3" class="contslot"><span>' + sor[i]['city'] + ', ' + sor[i]['state'] + '</span></td></tr>';
	        thirdrow = '<tr class="miscslot"><td class="blank"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td colspan="2" class="contslot"></td></tr>';
	        fourthrow = '<tr class="descripslot"><td></td><td class="blank"></td><td colspan="6" class="dslot"><p>Description: ' + sor[i]['description'] + '</p></td></tr></table>';
	        tab = firstrow + secondrow + thirdrow + fourthrow;
	        //$('#searchcontent').append(tab);
        } else if (sor[i].type) {
          firstrow = '<table class="sres ares" id="sres' + (i+1) + '"><tr class="titleslot"><td rowspan="3" class="picslot">' + picf + '</td><td class="blank"></td><td colspan="5" class="nameslot"><span>' + (i+1) + '. ' + sor[i]['name'] + '</span></td><td class="priceslot"><span>$' + sor[i]['price'] + '</span></td></tr>';
	        secondrow = '<tr class="miscslot"><td class="blank"></td><td colspan="3" class="wcard"><span>' + sor[i]['type'] + '</span></td><td colspan="3" class="contslot"><span>' + sor[i]['college_posted'] + '</span></td></tr>';
	        thirdrow = '<tr class="miscslot"><td class="blank"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td colspan="2" class="contslot"></td></tr>';
	        fourthrow = '<tr class="descripslot"><td></td><td class="blank"></td><td colspan="6" class="dslot"><p>Description: ' + sor[i]['description'] + '</p></td></tr></table>';
	        tab = firstrow + secondrow + thirdrow + fourthrow;
	        //$('#searchcontent').append(tab);
        } else {
          firstrow = '<table class="sres ares" id="sres' + (i+1) + '"><tr class="titleslot"><td rowspan="3" class="picslot">' + picf + '</td><td class="blank"></td><td colspan="4" class="nameslot"><span>' + (i+1) + '. ' + sor[i]['name'] + '</span></td><td  colspan="2" class="priceslot"><span>' + sor[i]['price'] + '</span></td></tr>';
	        secondrow = '<tr class="miscslot"><td class="blank"></td><td colspan="3" class="wcard"><span></span></td><td colspan="3" class="contslot"><span>' + sor[i]['college_posted'] + '</span></td></tr>';
	        thirdrow = '<tr class="miscslot"><td class="blank"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td colspan="2" class="contslot"></td></tr>';
	        fourthrow = '<tr class="descripslot"><td></td><td class="blank"></td><td colspan="6" class="dslot"><p>Description: ' + sor[i]['description'] + '</p></td></tr></table>';
	        tab = firstrow + secondrow + thirdrow + fourthrow;
	        //$('#searchcontent').append(tab);
        }
        
        var end = '<div class="edit" id="edit' + (i+1) + '"><span>EDIT POST</span></div><div class="deletepost" id ="deletepost' + (i+1) + '"><span>DELETE POST</span></div><div class="editpics" id="editpics' + (i+1) + '"></div>';
        tab += end;
        $('#searchcontent').append(tab);
      }

    }
    
    
    
  };
  getdates.open('GET','../php/getposted.php',true);
  getdates.send();
  
  $(document).on('click','.editpost',function () {
    window.location.href = 'tryout.php';
  });
  
  $(document).on('click','.sres',function() {
      expand(parseInt($(this).attr('id').replace('sres','')));
  });
  
  
  
  $('#newcollege,#ncolor').on('change',function() {
    $('#newcolor').css('background-color',$(this).val());
  });
  
  $('#chpr').on('click',function() {
    $('body').prepend(checkedit);
    /*
    $('#chdet').css('display','initial');
    $('#acdet').css('display','none');*/
  });
  
  $(document).on('click','#noedit',function () {
    $('#modal').remove();
  });
  
  $(document).on('keydown','#checkpass',function(e) {
    if (e.keyCode==13) {
      $('.chkrow').remove();
    var chedit = new XMLHttpRequest();
    var chpas = document.getElementById('checkpass').value;
    chedit.onreadystatechange = function() {
      if (chedit.readyState==4 && chedit.status==200) {
        var chrep = JSON.parse(chedit.responseText);
        if (chrep['pass']==1) {
          $('#modal').remove();
          $('#chdet').css('display','initial');
          $('#acdet').css('display','none');
        } else { 
          var addin = '<tr class="chkrow"><td colspan="2"><span class="must">&nbsp;&nbsp;&nbsp;&nbsp;*Password doesn\'t match</span></td></tr>';
          $('#checkpassrow').after(addin);
        }
      }      
    }
    chedit.open('GET','../php/checkuser.php?pass=' + chpas,true);
    chedit.send();
    }
  });
  
  $(document).on('click','#yesedit',function() {
    $('.chkrow').remove();
    var chedit = new XMLHttpRequest();
    var chpas = document.getElementById('checkpass').value;
    chedit.onreadystatechange = function() {
      if (chedit.readyState==4 && chedit.status==200) {
        var chrep = JSON.parse(chedit.responseText);
        if (chrep['pass']==1) {
          $('#modal').remove();
          $('#chdet').css('display','initial');
          $('#acdet').css('display','none');
        } else { 
          var addin = '<tr class="chkrow"><td colspan="2"><span class="must">&nbsp;&nbsp;&nbsp;&nbsp;*Password doesn\'t match</span></td></tr>';
          $('#checkpassrow').after(addin);
        }
      }      
    }
    chedit.open('GET','../php/checkuser.php?pass=' + chpas,true);
    chedit.send();
    
  });
  
  $(document).on('click','#canpr',function () {
    $('#chdet').css('display','none');
    $('#acdet').css('display','initial');
  })
  
  $('#savpr span').on('click',function() {
    var npass = document.getElementById('newpass').value.trim();
    if (npass !== '') {
      if (npass.length >= 8) {
        if (npass == document.getElementById('confpass').value) {
          $('#changeaccount').submit();
        } else {
          var err = '<tr id="ldet2"><td class="passdet" colspan="2"><span class="must">&nbsp;&nbsp;&nbsp;&nbsp;*Passwords don\'t match</span></td></tr>';
          $('#ldet2').remove();
          $('#fdetl').after(err);
        }
      } else {
        var err = '<tr id="ldet2"><td class="passdet" colspan="2"><span class="must">&nbsp;&nbsp;&nbsp;&nbsp;*Must be at least 8 characters long</span></td></tr>';
        $('#ldet2').remove();
        $('#fdetf').after(err);
      }
    } else {    
      $('#changeaccount').submit();
    }
  });
  
  
  $(document).on('click','#delpr',function() {
    
    $('body').prepend(checkexit);
  });
  
  $(document).on('click','#yesleave',function() {
    var del = new XMLHttpRequest();
    del.open('POST','../php/deleteaccount.php',true);
    del.send();
    window.location.href = 'tryout.php';
  });
  
  $(document).on('click','#noleave',function() {
    $('#modal').remove();
  });
  
  $(document).on('click','.deletepost span',function() {
    var delnum = parseInt($(this).parent().attr('id').replace('deletepost',''));
    if ($(this).text()=='DELETE POST') {
      $('body').prepend(checkdel);
      $('.yesdel').attr('id','yesdel'+delnum);
    } else {
      $('#filler').css('min-height','0px');
      $('#googmap').css('border-top','none');
      $('#picframe,#mapswap').remove();
	    $('#testform').before(prevsel);
	    $('#testform').remove();
	    $('#edit'+delnum+' span').text('EDIT POST');
	    $('#deletepost'+delnum+' span').text('DELETE POST');
	    prevnum = 0;
    }
  });
  
  $(document).on('click','.yesdel',function() {
    var yesdelnum = parseInt($(this).attr('id').replace('yesdel',''));
    
    var pdel = new XMLHttpRequest();
    if (sor[yesdelnum-1]['author']) {
      var pdeltype = 'textbooks';
    } else if (sor[yesdelnum-1]['address']) {
      var pdeltype = 'sublets';
    } else if (sor[yesdelnum-1]['type']) {
      var pdeltype = 'misc';
    } else {
      var pdeltype = 'services';
    }
    pdelid = sor[yesdelnum-1]['ID'];
    
    pdel.open('GET','../php/deletepost.php?d='+pdeltype+'&id='+pdelid);
    pdel.send();
    window.location.href = 'myaccount.php';
  });
  
  $(document).on('click','#nodel',function() {
    $('#modal').remove();
  });
  
  $(document).on('mouseover','#picframe',function() {
	  $('#testitout').css('display','inherit');  
	  //$('#testitout').fadeIn(100);
	});
	
	$(document).on('mouseout','#testitout',function() {
	  $('#testitout').css('display','none');
	  //$('#testitout').fadeOut(100);
	})
	
	$(document).on('click','#mapswap th',function() {
	  if ($(this).attr('id')=='gotomap') {
	    $('#gotomap').attr('class','mapswapclick');
	    $('#gotopics').attr('class','');
	    $('#picframe').css('z-index','-10');
	  } else {
	    $('#gotomap').attr('class','');
	    $('#gotopics').attr('class','mapswapclick');
	    $('#picframe').css('z-index','0');
	  }
	})
	
	$(document).on('click','#moveleft',function() {
	  $('#pict'+shownpic).css('z-index','0');
	  if (shownpic > 1) {
	    $('#pict'+(shownpic-1)).css('z-index','100');
	    shownpic -= 1;
	  } else {
	    $('#pict' + (piccount)).css('z-index','100');
	    shownpic = piccount;
	  }
	});
	
	$(document).on('click','#moveright',function() {
	  $('#pict'+shownpic).css('z-index','0');
	  if (shownpic < piccount) {
	    $('#pict'+(shownpic+1)).css('z-index','100');
	    shownpic += 1;
	  } else {
	    $('#pict1').css('z-index','100');
	    shownpic = 1;
	  }
	});
	
	$(document).on('click','.edit span',function() {
	  var editnum = parseInt($(this).parent().attr('id').replace('edit',''));
	  if ($(this).text() == 'EDIT POST') {
	    $('#picframe').remove();
	    $('#mapswap').remove();
	    $('.edit span').text('EDIT POST');
	    $('.deletepost span').text('DELETE POST');
	    $('#testform').remove();
	  if (prevnum!==editnum) {
	    $('#sres'+prevnum).remove();
	  if (prevnum >= 0) {
	  
	  if (prevnum == 1) {
      $('#searchcontent').prepend(prevsel);
    } else {
      $('#editpics'+(prevnum-1)).after(prevsel);
    }
	  }
	  prevsel = $('#sres'+editnum).clone();
	  }
	  $('#sres'+editnum).remove();
	  if (prevnum > 1) {
	    
	  }
	  $('#edit'+editnum + ' span').text('SAVE');
	  $('#deletepost' + editnum + ' span').text('CANCEL');
	  
	  if (sor[editnum-1].author) {
	    var editblock = '<div id="testform"><form><input type="text" id="postid" name="postid" value="' + sor[editnum-1].ID + '" display="none">\
		<table class="tres"><tr class="titleslot">\
		<td colspan="2" class="tedit"><input type="text" id="testtitle" name="testtitle" placeholder=" Title" value="' + sor[editnum-1].name + '"></td>\
		<td class="lil"><span>$</span></td>\
		<td class="peditl"><input type="text" id="testpr" name="testpr" placeholder="$" value="' + sor[editnum-1].price + '"></td>\
		</tr>\
		<tr class="miscslot">\
		  <td colspan="1" class="wedit"><input type="text" id="testauth" name="testauth" placeholder=" Author" value="' + sor[editnum-1].author + '"></td>\
		  <td colspan="3" class="ledit"><span>' + sor[editnum-1].college_posted + '</span></td>\
		</tr>\
		<tr class="miscslot">\
		  <td colspan="1" class="wedit"><input type="text" id="testpub" name="testpub" placeholder=" Publisher" value="' + sor[editnum-1].publisher + '"></td>\
		  <td colspan="3" class="ledit"><input type="tel" id="testtel" name="testtel" placeholder=" Phone Number" value="' + sor[editnum-1].phone + '"></td>\
		</tr>\
		<tr class="miscslot">\
		  <td colspan="1" class="wedit"><input type="text" id="tested" name="tested" placeholder=" Edition" value="' + sor[editnum-1].edition + '"></td>\
		  <td colspan="3" class="ledit"><input type="email" id="testem" name="testem" placeholder=" Email Address" value="' + sor[editnum-1].email + '"></td>\
		</tr>\
		<tr class="miscslot">\
		  <td colspan="4"><span>Description:</span></td>\
		</tr>\
		<tr class="lastslot">\
		  <td colspan="4" class="lslot"><textarea name="testde" id="testde">' + sor[editnum-1]['description'] + '</textarea>\
		</tr>\
		</table>\
		</form></div>';
	  } else if (sor[editnum-1].address) {
	    var editblock = '<div id="testform"><form><input type="text" id="postid" name="postid" value="' + sor[editnum-1].ID + '" display="none">\
	    <input type="text" id="testlat" name="testlat"><input type="text" id="testlng" name="testlng">\
		<table class="tres"><tr class="titleslot">\
		<td colspan="3" class="adit"><input type="text" onFocus="initAutocomplete()" id="testadd" name="testadd" placeholder=" Address" value="' + sor[editnum-1].address + '"></td>\
		<td class="pedit"><input type="text" id="testapt" name="testapt" placeholder=" Apt" value="' + sor[editnum-1].apt + '"></td>\
		<td class="lil"><span>$</span></td>\
		<td class="peditl"><input type="text" id="testpr" name="testpr" placeholder="$" value="' + sor[editnum-1].rent + '"></td>\
		</tr><tr class="miscslot">\
		<td class="pedit"><input type="text" id="testbed" name="testbed" placeholder=" Beds" value="' + sor[editnum-1].beds + '"></td>\
		<td class="pedit"><input type="text" id="testbath" name="testbath" placeholder=" Baths" value="' + sor[editnum-1].baths + '"></td>\
		<td class="cedit"><input type="text" id="testcit" name="testcit" placeholder=" City" value="' + sor[editnum-1].city + '"></td>\
		<td class="pedit"><input type="text" id="testst" name="testst" placeholder=" State" value="' + sor[editnum-1].state + '"></td>\
		<td colspan="2" class="pedit"><input type="text" id="testz" name="testz" placeholder=" Zip" value="' + sor[editnum-1].zip + '"></td>\
		</tr>\
		<tr class="miscslot">\
		  <td><label for="teststart">Start Date:</label></td>\
	    <td colspan="2"><input type="date" id="teststart" name="teststart" value="' + sor[editnum-1].start_date + '"></td>\
		  <td colspan="3" class="ledit"><input type="tel" id="testtel" name="testtel" placeholder=" Phone Number" value="' + sor[editnum-1].phone + '"></td>\
		</tr>\
		<tr class="miscslot">\
		  <td><label for="testend">End Date:</label></td>\
		  <td colspan="2"><input type="date" id="testend" name="testend" value="' + sor[editnum-1].end_date + '"></td>\
		  <td colspan="3" class="ledit"><input type="email" id="testem" name="testem" placeholder=" Email Address" value="' + sor[editnum-1].email + '"></td>\
		</tr>\
		<tr class="miscslot">\
		  <td colspan="6"><span>Description:</span></td>\
		<tr>\
		<tr class="lastslot">\
		  <td colspan="6" class="lslot"><textarea name="testde" id="testde">' + sor[editnum-1]['description'] + '</textarea>\
		</tr>\
		</table></form></div>';
	  } else if (sor[editnum-1].type) {
	    var editblock = '<div id="testform"><form><input type="text" id="postid" name="postid" value="' + sor[editnum-1].ID + '" display="none">\
		<table class="tres"><tr class="titleslot">\
		<td colspan="2" class="tedit"><input type="text" id="testnam" name="testnam" placeholder=" Name" value="' + sor[editnum-1].name + '"></td>\
		<td class="lil"><span>$</span></td>\
		<td colspan="1" class="peditl"><input type="text" id="testpr" name="testpr" placeholder="$" value="' + sor[editnum-1].price + '"></td>\
		</tr>\
		<tr class="miscslot">\
		<td colspan="1" class="wedit"><select id="testtyp" name="testtyp" value="' + sor[editnum-1].type + '"> \
		<option value="Appliance">Appliance</option> \
				                      <option value="Furniture">Furniture</option> \
				                      <option value="Sporting Goods">Sporting Goods</option> \
				                      <option value="Electronics">Electronics</option> \
				                      <option value="Transportation">Transportation</option> \
				                      <option value="Other">Other</option> \
		</select></td>\
		<td colspan="3" class="ledit"><span>' + sor[editnum-1].college_posted + '</span></td>\
		</tr>\
		<tr class="miscslot">\
		<td rowspan="2" class="wedit"></td>\
		<td colspan="3" class="ledit"><input type="tel" id="testtel" name="testtel" placeholder=" Phone Number" value="' + sor[editnum-1].phone + '"></td>\
    </tr>\
    <tr class="miscslot">\
    <td colspan="3" class="ledit"><input type="email" id="testem" name="testem" placeholder=" Email Address" value="' + sor[editnum-1].email + '"></td>\
    </tr>\
    <tr class="miscslot">\
		  <td colspan="6"><span>Description:</span></td>\
		<tr>\
		<tr class="lastslot">\
		  <td colspan="6" class="lslot"><textarea name="testde" id="testde">' + sor[editnum-1]['description'] + '</textarea>\
		</tr>\
    </table></form></div>';
	  } else {
	    var editblock = '<div id="testform"><form><input type="text" id="postid" name="postid" value="' + sor[editnum-1].ID + '" display="none">\
		<table class="tres"><tr class="titleslot">\
		<td colspan="2" class="tedit"><input type="text" id="testserv" name="testserv" placeholder=" Service" value="' + sor[editnum-1].name + '"></td>\
		<td colspan="1" class="pedit"><input type="text" id="testpr" name="testpr" placeholder=" Price" value="' + sor[editnum-1].price + '"></td>\
		</tr>\
		<tr class="miscslot">\
		<td colspan="1" rowspan="3" class="wedit"></td>\
		<td colspan="2" class="ledit"><span>' + sor[editnum-1].college_posted + '</span></td>\
		</tr>\
		<tr class="miscslot">\
		<td colspan="2" class="ledit"><input type="tel" id="testtel" name="testtel" placeholder=" Phone Number" value="' + sor[editnum-1].phone + '"></td>\
    </tr>\
    <tr class="miscslot">\
    <td colspan="2" class="ledit"><input type="email" id="testem" name="testem" placeholder=" Email Address" value="' + sor[editnum-1].email + '"></td>\
    </tr>\
    <tr class="miscslot">\
		  <td colspan="3"><span>Description:</span></td>\
		<tr>\
		<tr class="lastslot">\
		  <td colspan="3" class="lslot"><textarea name="testde" id="testde">' + sor[editnum-1]['description'] + '</textarea>\
		</tr>\
    </table></form></div>';
	  }
	  $('#edit'+editnum).before(editblock);
	  prevnum = editnum;
	  
	  piccount=0;
    shownpic=1;
      picframe = '<div id="picframe">';
      for (var pici=0;pici < 5;pici++) {

          if (sor[editnum-1]['pic' + (pici+1)]) {
            var picsp = sor[editnum-1]['pic' + (pici+1)].split("/");
            if (picsp[4] !== '') {
            picframe += '<img id="pict' + (pici+1) + '" src="' + sor[editnum-1]['pic' + (pici+1)] + '">'; 
            piccount += 1;
            }
          }
      }
      
      if (piccount > 1) {
        picframe += testitout;
      }
      
      picframe += '</div>';

      $('#fillcont').append(picframe);
      $('#testitout').css('top',-1*(300*piccount));
      $('#picframe').css('top','0px');
      if (sor[editnum-1].address) {
        $('#fillcont').append(mapswap);
      }
          if (1==1) {
            $('#picframe').css('top','-301px');
          } else {
            $('#picframe').css('top','-302px');
          }
          
      if (editnum > 1) { $('#filler').css('min-height',$('#testform').offset().top-379); 
          $('#googmap').css('border-top','solid 1px #eeeeee');
        }
        else { $('#filler').css('min-height',$('#testform').offset().top-378);
              $('#googmap').css('border-top','none'); }
	  
	              window.scrollTo(0,$('#testform').offset().top);
	  } else {
	    $('body').prepend(checksave);
	    updatequery = '';
	    var checkworks = true;
	    var goodprice = true;
	    var succtop = '<span>SAVE CHANGES</span>';
	    var failtop = '<span>INVALID CHANGES</span>';
	    var failmid;
	    var succmid = '<div><p>Save changes to post?</p></span>';
	    var succbot = '<button type="button" class="yessave">Yes, I\'m finished here</button><button type="button" class="nosave">No, I\'m not done yet</button>';
	    var failbot = '<button type="button" class="okey">Okay</button>';
	    var csem = $('#testem').val().trim();
	      var cstel = $('#testtel').val().trim();
	      var csde = $('#testde').val().trim();
	    if (sor[editnum-1].author) {
	      var csti = $('#testtitle').val().trim();
	      var csau = $('#testauth').val().trim();
	      var cspr = $('#testpr').val().trim();
	      var cspub = $('#testpub').val().trim();
	      var csed = $('#tested').val().trim();
	      if (csti!=='' && csau!=='' && cspr!=='' && (cstel!=='' || csem !=='') && csde!=='') {
	        checkworks = true;
	        if (!(isNaN(cspr))) {
	          goodprice=true;
	        } else {
	          goodprice=false;
	          failmid = '<div><p>You must enter a number as the price.</p></div>';
	        }
	        
	      } else {
	        checkworks = false;
	        failmid = '<div><p>The following fields are required: Title, Author, Price, Description, and either Phone Number or Email Address.</p></div>';
	      }
	      
	    } else if (sor[editnum-1].address) {
	      var csad = $('#testadd').val().trim();
	      var csapt = $('#testapt').val().trim();
	      var cscit = $('#testcity').val().trim();
	      var cszip = $('#testz').val().trim();
	      var csstat = $('#testst').val().trim();
	      var csre = $('#testpr').val().trim();
	      var csstart = $('#teststart').val().trim();
	      var csend = $('#testend').val().trim();
	      var csbe = $('#testbed').val().trim();
	      var csba = $('#testbath').val().trim();
	      if (csad!=='' && cscit!=='' && cszip!=='' && csstat!=='' && csre!=='' && csbe!=='' && csba!=='' && csde!=='' && (cstel!=='' || csem!=='')) {
	        checkworks = true;
	        if (!(isNaN(csre) || isNaN(csbe) || isNaN(csba))) {
	          goodprice=true;
	        } else {
	          goodprice=false;
	          failmid = '<div><p>You must enter a number for the rent, number of beds, and number of baths.</p></div>';
	        }
	      } else {
	        checkworks = false;
	        failmid = '<div><p>The following fields are required: Address, Rent, City, Zip, State, Start Date, End Date, Beds, Baths, Description, and either Phone Number or Email Address</p></div>';
	      }
	      
	    } else if (sor[editnum-1].type) {
	      var csnam = $('#testnam').val().trim();
	      var cspr = $('#testpr').val().trim();
	      var cstyp = $('#testtyp').val().trim();
	      if (csnam!=='' && cspr!=='' && csde!=='' && (csem!=='' || cstel!=='')) {
	        checkworks = true;
	        if (!(isNaN(cspr))) {
	          goodprice=true;
	        } else {
	          goodprice=false;
	          failmid = '<div><p>You must enter a number for the price.</p></div>';
	        }
	      } else {
	        checkworks = false;
	        failmid = '<div><p>The following filed are required: Name, Price, Description, and either Phone Number or Email Address</p></div>';
	      }
	      
	    } else {
	      var csserv = $('#testserv').val().trim();
	      var cspr = $('#testpr').val().trim();
	      if (csserv!=='' && cspr!=='' && csde!=='' && (csem!=='' || cstel!=='')) {
	        checkworks = true;
	        goodprice= true;
	      } else {
	        checkworks = false;
	        failmid = '<div><p>The following filed are required: Name, Price, Description, and either Phone Number or Email Address</p></div>';
	      }
	      
	      
	    }
	    
	    
	      if (checkworks===true && goodprice===true) {
	          $('#modtop').html(succtop);
	          $('#modmid').html(succmid);
	          $('#modbot').html(succbot);
	      } else {
	        $('#modtop').html(failtop);
	        $('#modmid').html(failmid);
	        $('#modbot').html(failbot);
	      }
	    
	  }
	  
	});
	
	$(document).on('click','.yessave',function() {
	  var updateform = $('#testform form').serialize();
	  var updateq = new XMLHttpRequest();
	  updateq.open('POST','../php/updatepost.php');
	  updateq.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
	  updateq.send(updateform);
	  window.location.href = 'myaccount.php';
	});
	
	$(document).on('click','.nosave,.okey',function() {
	  $('#modal').remove();
	})
  
});