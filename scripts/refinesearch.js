var autocomplete;
var markercount;
var lat;
var lng;
var first = false; 
var googMap;
var map;
var here,there;
var sr,ar;
var markers = [];
var addclicks = [];
var deets;
var prevsel;
var piccount;
var pichover = false;
var mapswap = '<table id="mapswap">\
		  <tr>\
		    <th class="mapswapclick" id="gotomap">\
		      <span>MAP</span>\
		    </th>\
		    <th id="gotopics">\
		      <span>PICTURES</span>\
		    </th>\
		  </tr>\
		</table>';
var shownpic = 1;
var nopewords = ['a','an','the','of','and'];
var prevnum = -1;
var testitout = '<div id="testitout"> \
		  <div class="picmove" id="moveleft"><p>&lt;</p></div> \
		  <div class="picmove" id="nomove"></div>\
		  <div class="picmove" id="moveright"><p>&gt;</p></div>\
		</div>';
var option = 'BOOKS';
var searchinp = 'FUCK YOU';
var picframe ='<div id="picframe">';
var googmap = '<div id = "googmap"></div>';
var firstrow,secondrow,thirdrow,fourthrow,tab;
var defaultbar = '<table id="search"><tr><td><form id="shadow"> \
                  <input type="text" class="searcher" name="searchinput" id="searchinput" placeholder=" Search" size="30"> \
                  <span> Near: </span> \
							     <input type="text" name="locinput" placeholder=" Address / City / Zip Code" size="25"> \
							<input type="submit" value="Search" id="homesearch"> \
						</form> \
					</td> \
					<th id="refine"> ADVANCED<br> SEARCH </th> \
				</tr> \
			</table>	';

var apartbar = '<table id="search"><tr><td><form id="shadow"> \
                <input type="text" name="locinput" id="locinput" placeholder=" Address / City / Zip Code" onFocus="initAutocomplete()" size="50"> \
                <input type="text" id="loclat" class="hid"><input type="text" id="loclng" class="hid"> \
                <input type="submit" value="Search" id="homesearch"> \
                </form></td><th id="refine"> ADVANCED<br> SEARCH </th></tr></table>';

function expand(n) {
    
    var num = n;
    //window.scrollTo(0,$('#sres'+n).offset().top);
    //document.getElementById('locinput').value = '#sres'+num;
    $('#sres'+prevnum).remove();
    $('#picframe').remove();
    $('#mapswap').remove();
    
    if (prevnum >= 0) {
    if (prevnum == 1) {
      $('#searchcontent').prepend(prevsel);
    } else {
      $('#sres'+(prevnum-1)).after(prevsel);
    }}
    
    if (num != prevnum) {

      prevsel = $('#sres'+num).clone();

      
    switch(option.trim()) {
      case 'BOOKS':
        if (sr[num-1]['Edition'] !== '') {
          var ed = 'Edition: ' + sr[num-1]['Edition'];
        } else {
          var ed = '';
        }
        
        if (sr[num-1]['Publisher'] !== '') {
          var pu = 'Publisher: ' + sr[num-1]['Publisher'];
        } else {
          var pu = '';
        }
        
        if (sr[num-1]['Phone'] !== '') {
          var ph = 'Phone: ' + sr[num-1]['Phone'];
        } else {
          var ph = '';
        }
        
        if (sr[num-1]['Email'] !== '') {
          var em = 'Email: ' + sr[num-1]['Email'];
        } else {
          var em = '';
        }
        
        deets = '<table class="sres" id="sres' + num + '"> \
        <tr class="titleslot"><td colspan="6" class="nameslot"><span>' + sr[num-1]['Title'] + '</span></td><td class="priceslot"><span>$'+ sr[num-1]['Price'] + '</span></td></tr> \
        <tr class="miscslot"><td colspan="4" class="wcard"><span>By ' + sr[num-1]['Author'] + '</span></td> \
        <td colspan="3" class="contslot"><span>' + sr[num-1]['College'] + '</span></td></tr> \
        <tr class="miscslot"><td colspan="4" class="wcard"><span>' + pu + '</span></td><td colspan="3" class="contslot"><span>' + ph + '</span></td></tr> \
        <tr class="miscslot"><td colspan="4" class="wcard"><span>' + ed + '</span></td><td colspan="3" class="contslot"><span>' + em + '</span></td></tr> \
        <tr class="miscslot"><td colspan="2" class="nameslot"><span>Description:</span></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td></tr> \
        <tr class="lastslot"><td colspan="7" class="lslot"><p>' + sr[num-1]['Description'] + '</p></td></tr></table>';

        
        break;
      case 'APARTMENTS':
        map.setCenter(markers[num-1].getPosition());
        if (ar[num-1]['Phone'] !== '') {
          var ph = 'Phone: ' + ar[num-1]['Phone'];
        } else {
          var ph = '';
        }
        
        if (ar[num-1]['Email'] !== '') {
          var em = 'Email: ' + ar[num-1]['Email'];
        } else {
          var em = '';
        }
        deets = '<table class="sres" id="sres' + num + '"> \
        <tr class="titleslot"><td colspan="5" class="nameslot"><span>' + ar[num-1]['Address'] + ' ' + ar[num-1]['Apt'] + '</span></td><td colspan="2" class="priceslot"><span>$'+ ar[num-1]['Rent'] + '/month</span></td></tr> \
        <tr class="miscslot"><td class="wcard"><span>Beds: ' + ar[num-1]['Beds'] + '</span></td><td class="wcard"><span>Baths: ' + ar[num-1]['Baths'] + '</span></td>\
        <td colspan="2" class="wcard"></td><td colspan="3" class="contslot"><span>' + ar[num-1]['City'] + ', ' + ar[num-1]['State'] + ' ' + ar[num-1]['Zip'] + '</span></td></tr> \
        <tr class="miscslot"><td colspan="4" class="wcard"><span>Availability: ' + ar[num-1]['Start'].replace(/-/g,'/') + ' - ' + ar[num-1]['End'].replace(/-/g,'/') + '</span></td><td colspan="3" class="contslot"><span>' + ph + '</span></td></tr> \
        <tr class="miscslot"><td colspan="4" class="wcard"></td><td colspan="3" class="contslot"><span>' + em + '</span></td></tr> \
        <tr class="miscslot"><td colspan="2" class="nameslot"><span>Description:</span></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td></tr> \
        <tr class="lastslot"><td colspan="7" class="lslot"><p>' + ar[num-1]['Description'] + '</p></td></tr></table>';
        break;
        
      case 'SERVICES':
        if (sr[num-1]['Phone'] !== '') {
          var ph = 'Phone: ' + sr[num-1]['Phone'];
        } else {
          var ph = '';
        }
        
        if (sr[num-1]['Email'] !== '') {
          var em = 'Email: ' + sr[num-1]['Email'];
        } else {
          var em = '';
        }
        deets = '<table class="sres" id="sres' + num + '"> \
        <tr class="titleslot"><td colspan="5" class="nameslot"><span>' + sr[num-1]['Service'] + '</span></td><td colspan="2" class="priceslot"><span>'+ sr[num-1]['Price'] + '</span></td></tr> \
        <tr class="miscslot"><td colspan="4" class="wcard"></td><td colspan="3" class="contslot"><span>' + sr[num-1]['College'] + '</span></td></tr> \
        <tr class="miscslot"><td colspan="4" class="wcard"></td><td colspan="3" class="contslot"><span>' + ph + '</span></td></tr> \
        <tr class="miscslot"><td colspan="4" class="wcard"></td><td colspan="3" class="contslot"><span>' + em + '</span></td></tr> \
        <tr class="miscslot"><td colspan="2" class="nameslot"><span>Description:</span></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td></tr> \
        <tr class="lastslot"><td colspan="7" class="lslot"><p>' + sr[num-1]['Description'] + '</p></td></tr></table>';
        break;
      case 'MISCELLANEOUS':
        if (sr[num-1]['Phone'] !== '') {
          var ph = 'Phone: ' + sr[num-1]['Phone'];
        } else {
          var ph = '';
        }
        
        if (sr[num-1]['Email'] !== '') {
          var em = 'Email: ' + sr[num-1]['Email'];
        } else {
          var em = '';
        }
        deets = '<table class="sres" id="sres' + num + '"> \
        <tr class="titleslot"><td colspan="5" class="nameslot"><span>' + sr[num-1]['Name'] + '</span></td><td colspan="2" class="priceslot"><span>$'+ sr[num-1]['Price'] + '</span></td></tr> \
        <tr class="miscslot"><td colspan="4" class="wcard"><span>' + sr[num-1]['Type'] + '</span></td><td colspan="3" class="contslot"><span>' + sr[num-1]['College'] + '</span></td></tr> \
        <tr class="miscslot"><td colspan="4" class="wcard"></td><td colspan="3" class="contslot"><span>' + ph + '</span></td></tr> \
        <tr class="miscslot"><td colspan="4" class="wcard"></td><td colspan="3" class="contslot"><span>' + em + '</span></td></tr> \
        <tr class="miscslot"><td colspan="2" class="nameslot"><span>Description:</span></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td></tr> \
        <tr class="lastslot"><td colspan="7" class="lslot"><p>' + sr[num-1]['Description'] + '</p></td></tr></table>';
        break;
      default:
        break;
      
    } 
    $('#sres'+num).after(deets);
    $('#sres'+num).remove();
    prevnum = num;
      
      piccount=0;
      picframe = '<div id="picframe">';
      for (var pici=0;pici < 5;pici++) {
        if (option.trim() != 'APARTMENTS') {
          if (sr[num-1]['Pic' + (pici+1)] !== '') {
            picframe += '<img id="pict' + (pici+1) + '" src="' + sr[num-1]['Pic' + (pici+1)] + '">'; 
            piccount += 1;
          }
        } else {
          if (ar[num-1]['Pic' + (pici+1)] !== '') {
            picframe += '<img id="pict' + (pici+1) + '" src="' + ar[num-1]['Pic' + (pici+1)] + '">'; 
            piccount += 1;
          }
        }
      }
      
      if (piccount > 1) {
        picframe += testitout;
      }
      
      picframe += '</div>';
      if (option.trim() != 'APARTMENTS') {
      $('#fillcont').append(picframe);
      $('#testitout').css('top',-1*(300*piccount));
      $('#picframe').css('top','0px');
      } else {
        if (piccount > 0) {
          $('#fillcont').append(picframe);
          $('#picframe').css('z-index','-1');
          $('#fillcont').append(mapswap);
          if (num==1) {
            $('#picframe').css('top','-301px');
          } else {
            $('#picframe').css('top','-302px');
          }
          $('#testitout').css('top',-1*(300*piccount));
          //$('#mapswap').css('top',-1*(300*piccount));
        }
      }
      
           
      if (num > 1) { $('#filler').css('min-height',$('#sres'+num).position().top-1);
        $('#googmap').css('border-top','solid 1px #eeeeee');
        $('#picframe').css('border-top','solid 1px #eeeeee');
      }
      else { $('#filler').css('min-height',$('#sres'+num).position().top);
        $('#googmap').css('border-top','none');
        $('#picframe').css('border-top','none');
      } 
      
      window.scrollTo(0,$('#sres'+n).offset().top);
      window.location.hash = '#sres'+num;      
      
    } else {
      //$('#filler').css('min-height','0px');
      //window.scrollTo(0,0);
      $('#picframe').remove();
      shownpic=1;
      if (option.trim() == 'APARTMENTS') {
        if ($('#googmap').position().top + 160 > $('#sres'+(markers.length)).position().top ) {
          $('#filler').css('min-height',($('#sres'+(markers.length)).position().top - 161));
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

function initAutocomplete() {
  var inp = /** @type {!HTMLInputElement} */(document.getElementById('locinput'));
  autocomplete = new google.maps.places.Autocomplete(inp);
  autocomplete.setTypes(['geocode']);
  google.maps.event.addListener(autocomplete,'place_changed',getpos);
  
  if (first === false) {

    first = true;
    if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      here = position.coords.latitude;
      there = position.coords.longitude;
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    
      map.setCenter({lat: position.coords.latitude,lng: position.coords.longitude});
    
    });
    }
    
    
  }
}

function getpos() {
    var searchplace = autocomplete.getPlace();
    var searchaddr = searchplace.formatted_address;
    var geodude = new google.maps.Geocoder();
    geodude.geocode({'address':searchaddr},function(results,status) {
    if (status == google.maps.GeocoderStatus.OK) {
      var aress = results[0].geometry.location.toUrlValue();
      var apos = aress.split(',');
      lat = apos[0];
      lng = apos[1];
          document.getElementById('loclat').value = lat;
    document.getElementById('loclng').value = lng;
    }

    });
    
  
}

function searchScore(search,res) {
  var score = 0;
  var first = true;
  for (var s in search) {
    var se = s.replace("2","");
    var sstr = search[se].toLowerCase();
    sstr = sstr.trim();
    sstr = sstr.replace(/,/g,'');
    sstr = sstr.replace(/-/g,' ');
    if (sstr !== '') {
    var rstr = res[se].toLowerCase();
    rstr = rstr.trim();
    rstr = rstr.replace(/,/g,'');
    rstr = rstr.replace(/-/g,' ');
    if (first === true) {
      first = false;
      if (sstr == rstr) {
        score += 100000;
        continue;
      }
    } else {
      if (sstr == rstr) {
        score += 1000;
        continue;
      }
    }
    var ssplit = sstr.split(" ");
    var snope = [];
      for (nopeword in nopewords) {
        while(true) {
          if(!(ssplit.indexOf(nopeword)==-1)) {
            ssplit[ssplit.indexOf(nopeword)] = '';
            if (snope.indexOf(nopeword)==-1) {
              snope.push(nopeword);
            }
          } else {
            break;
          }
        }
      }
    for (var v=0;v<ssplit.length;v++) {
      if (ssplit[v] === '') {
        continue;
      } else {
        while(!(rstr.search(ssplit[v])==-1)) {
          score += 100;
          var reg = new RegExp(ssplit[v]);
          rstr = rstr.replace(reg,'');
        }
      }
    }
    for (var z=0;z<snope.length;z++) {
      while(!(rstr.search(snope[z])==-1)) {
        score += 10;
        var reg2 = new RegExp(snope[z]);
        rstr = rstr.replace(reg2,'');
      }
    }
    
  }
  }
  return score;
}

$(function () {
  defaultbar = $('#search').clone();
	var clicked = false;
	var opt;
	window.location.hash = '';
	
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
	
	$(document).on('click','.unclicknav',function(e) {
	    opt = '<table id="refinewrapper"><tr><th><form id="searchrefine">';
	    $('#filler').css('min-height','0px');

      $('.clicknav').attr('class','unclicknav');
      $(e.target).attr('class','clicknav');
      $('#search,#googmap,.sres,#picframe,#mapswap').remove();
      $('#test').css('display','none');
      clicked = false;
      option = $(e.target).text();
      prevnum = -1;
    if (String($(e.target).text()).trim() == 'APARTMENTS') {
      $('#searchwrapper').prepend(apartbar);
      $('#fillcont').prepend(googmap);
      if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
      googMap = document.getElementById('googmap');
      if (!here) {
        here = 40;
        there = -75;
      }
      map = new google.maps.Map(googMap, {
        
      
      center: {lat: here,lng: there
      }, zoom: 12
      
      });
      });
      }
      
    } else {
      $('#searchwrapper').prepend(defaultbar);
    }
    option = String(option);
    switch(option.trim()) {
      case 'BOOKS':
        
        opt += '<table>\
				    <tr>\
				      <td class="labelwrap">\
				        <label for="wauth">Author: </label>\
				      </td>\
				      <td>\
				        <input type="text" name="wauth" id="wauth">\
				      </td>\
				      <td class="labelwrap">\
				        <label for="wpub">Publisher: </label>\
				      </td>\
				      <td>\
				        <input type="text" name="wpub" id="wpub">\
				      </td>\
				    </tr>\
				    <tr class="fdet7">\
				    </tr>\
				  </table>';
        break;
      case 'APARTMENTS':
        
        
        opt += '<table><tr><td class="labelwrap">\
					<label for="radius">Search Radius: </label></td><td>\
	        				<select id="radius" name="radius">\
	        				  <option value="1">1 mile</option>\
	        				  <option value="2.5">2.5 miles</option>\
	        				  <option value="5" selected="true">5 miles</option>\
	        				  <option value="10">10 miles</option>\
	        				  <option value="25">25 miles</option>\
	        			  </select>\
					</td><td class="labelwrap">\
					  <label for="wminrent">Min Rent: </label></td><td>\
					    <select name="wminrent" id="wminrent">\
					      <option value="default">--Select one--</option>\
					    </select></td></tr>\
					<tr><td class="labelwrap">\
					<label for="wbed">Beds: </label></td><td>\
					<select id="wbed" name="wbed">\
					  <option value="default">--Select one--</option>\
					  <option value="1">1 bed</option>\
					  <option value="2">2 beds</option>\
					  <option value="3">3 beds</option>\
					  <option value="4">4 beds</option>\
					  <option value="5">5+ beds</option>\
				  </select>\
					</td><td class="labelwrap">\
					  <label for="wmaxrent">Max Rent: </label></td><td>\
					  <select name="wmaxrent" id="wmaxrent">\
					    <option value="default">--Select one--</option>\
					  </select>\
					</td></tr>\
					<tr><td class="labelwrap"><label for="wbath">Baths: </label></td><td>\
					<select id="wbath" name="wbath">\
					  <option value="default">--Select one--</option>\
					  <option value="1">1 bath</option>\
					  <option value="2">2 baths</option>\
					  <option value="3">3 baths</option>\
					  <option value="4">4 baths</option>\
					  <option value="5">5+ baths</option>\
				  </select>\
					</td><td class="labelwrap">\
					  <label for="wbegin">Available From: </label></td><td>\
					  <input type="date" id="wbegin" name="wbegin">\
					</td></tr>\
					<tr><td class="labelwrap"><label for="wsortw">Sort by: </label></td><td>\
					<select id="wsortw" name="wsortw">\
					  <option value="bydist">Distance</option>\
					  <option value="sizematch">Room Match</option>\
					  <option value="avmatch">Availability Match</option>\
				  </select>\
					</td><td class="labelwrap"><label for="wdend">Available Till: </label></td><td>\
					<input type="date" id="wdend" name="wdend">\
					</td>\
					</tr>\
					<tr class="fdet7">\
					</tr>\
					</table>';
        
        break;
      case 'SERVICES':
        
        opt += '<table> \
				    <tr> \
				      <td class="altlabelwrap"> \
				        <label for="wsse">Secondary Search: </label> \
				      </td>\
				      <td>\
				        <input type="text" size="25" id="wsse" name="wsse">\
				      </td>\
				    </tr>\
				    <td class="fdet7">\
				    </td>\
				  </table>';
        
        break;
      case 'MISCELLANEOUS':
        
        opt += '<table> \
				    <tr> \
				      <td class="altlabelwrap"> \
				        <label for="wsse">Secondary Search: </label> \
				      </td>\
				      <td>\
				        <input type="text" size="25" id="wsse" name="wsse">\
				      </td>\
				      <td class="labelwrap">\
				        <label for="wcat">Category: </label>\
				      </td>\
				      <td>\
				        <select name="wcat" id="wcat">\
				          <option value="sportinggoods">Sporting Goods</option>\
				          <option value="appliance">Appliances</option>\
				          <option value="furniture">Furniture</option>\
				        </select>\
				      </td>\
				    </tr>\
				    <td class="fdet7">\
				    </td>\
				  </table>';
        
        break;
      default:
        opt = '';
        break;
    }
    opt += '</th></tr></table></form>';
    $('#refinewrapper').remove();
    $('#test').prepend(opt);
    

    if (option.trim() != 'NOTHING') {
      $('input[name="searchinput"]').attr('placeholder',' Search for ' + option.trim().toLowerCase());
    } else {
      $('input[name="searchinput"]').attr('placeholder',' Search');
    }
    
  });

	$(document).on('click','#refine', function() {
		if(clicked===false) {
			$('#test').slideDown(300);
			setTimeout(function() {
				clicked = true;
			} , 300);
		} else {
			$('#test').slideUp(300);
			setTimeout(function() {
				clicked = false;
			} , 300);
		}
	});
	
	$('#searchrefine').on('submit',function(e){
	  e.preventDefault();
	});
	
	$(document).on('submit','#shadow', function(e) {
	  e.preventDefault();
	  $('#filler').css('min-height','0px');
	  $('#picframe').remove();
	  prevnum = -1;
	  if (option.trim() != 'APARTMENTS') {
	  searchinp = $('#searchinput').val().trim();
	  colinp = $('#colinput').val().trim();
	  if (searchinp !== '') {
	  $('.sorry').remove();
	  $('.sres').remove();
	  var req = new XMLHttpRequest();
	  req.onreadystatechange = function() {
	    if (req.readyState == 4 && req.status == 200) {

	      sr = JSON.parse(req.responseText);
	      sr = sr.sort(function(a,b) {
	        switch(option.trim()) {
	          case 'BOOKS':
	            var sear={Title:$('#searchinput').val().trim(),
	              Author:$('#wauth').val().trim(),
	              Publisher:$('#wpub').val().trim()
	            };
	            break;
	          case 'SERVICES':
	            var sear={Service:$('#searchinput').val().trim(),
	              Service2:$('#wsse').val().trim()
	            };
	            break;
	          case 'MISCELLANEOUS':
	            var sear={Name:$('#searchinput').val().trim(),
	              Name2:$('#wsse').val().trim(),
	              Type:$('#wcat').val().trim()
	            };
	            break;
	          default:
	            break;
	        }
	        return(searchScore(sear,b) - searchScore(sear,a));
	      });
	      if (sr.length > 0) {
	      switch(option.trim()) {
	      case 'BOOKS':
	        
	      for (var i=0; i < sr.length; i++) {
	        if (sr[i].Pic1 == '') {
	          var picf = '';
	        } else {
	          var picf = '<img class="minipic" src="' + sr[i].Pic1 + '">';
	        }
	        firstrow = '<table class="sres" id="sres' + (i+1) + '"><tr class="titleslot"><td rowspan="3" class="picslot">' + picf + '</td><td class="blank"></td><td colspan="5" class="nameslot"><span>' + (i+1) + '. ' + sr[i]['Title'] + '</span></td><td class="priceslot"><span>$' + sr[i]['Price'] + '</span></td></tr>';
	        secondrow = '<tr class="miscslot"><td class="blank"></td><td colspan="3" class="wcard"><span>Author:  ' + sr[i]['Author'] + '</span></td><td colspan="3" class="contslot"><span>' + sr[i]['College'] + '</span></td></tr>';
	        thirdrow = '<tr class="miscslot"><td class="blank"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td colspan="2" class="contslot"></td></tr>';
	        fourthrow = '<tr class="descripslot"><td></td><td class="blank"></td><td colspan="6" class="dslot"><p>Description: ' + sr[i]['Description'] + '</p></td></tr></table>';
	        tab = firstrow + secondrow + thirdrow + fourthrow;
	        $('#searchcontent').append(tab);
	      }
	      break;
	      
	      case 'SERVICES':
	      for (var j=0; j < sr.length; j++) {
	        if (sr[j].Pic1 == '') {
	          var picf = '';
	        } else {
	          var picf = '<img class="minipic" src="' + sr[j].Pic1 + '">';
	        }
	        
	        firstrow = '<table class="sres" id="sres' + (j+1) + '"><tr class="titleslot"><td rowspan="3" class="picslot">' + picf + '</td><td class="blank"></td><td colspan="4" class="nameslot"><span>' + (j+1) + '. ' + sr[j]['Service'] + '</span></td><td  colspan="2" class="priceslot"><span>' + sr[j]['Price'] + '</span></td></tr>';
	        secondrow = '<tr class="miscslot"><td class="blank"></td><td colspan="3" class="wcard"><span></span></td><td colspan="3" class="contslot"><span>' + sr[j]['College'] + '</span></td></tr>';
	        thirdrow = '<tr class="miscslot"><td class="blank"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td colspan="2" class="contslot"></td></tr>';
	        fourthrow = '<tr class="descripslot"><td></td><td class="blank"></td><td colspan="6" class="dslot"><p>Description: ' + sr[j]['Description'] + '</p></td></tr></table>';
	        tab = firstrow + secondrow + thirdrow + fourthrow;
	        $('#searchcontent').append(tab);
	      }
	      break;
	      
	      case 'MISCELLANEOUS':
	      for (var k=0; k < sr.length; k++) {
	        if (sr[k].Pic1 == '') {
	          var picf = '';
	        } else {
	          var picf = '<img class="minipic" src="' + sr[k].Pic1 + '">';
	        }
	        firstrow = '<table class="sres" id="sres' + (k+1) + '"><tr class="titleslot"><td rowspan="3" class="picslot">' + picf + '</td><td class="blank"></td><td colspan="5" class="nameslot"><span>' + (k+1) + '. ' + sr[k]['Name'] + '</span></td><td class="priceslot"><span>$' + sr[k]['Price'] + '</span></td></tr>';
	        secondrow = '<tr class="miscslot"><td class="blank"></td><td colspan="3" class="wcard"><span>' + sr[k]['Type'] + '</span></td><td colspan="3" class="contslot"><span>' + sr[k]['College'] + '</span></td></tr>';
	        thirdrow = '<tr class="miscslot"><td class="blank"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td colspan="2" class="contslot"></td></tr>';
	        fourthrow = '<tr class="descripslot"><td></td><td class="blank"></td><td colspan="6" class="dslot"><p>Description: ' + sr[k]['Description'] + '</p></td></tr></table>';
	        tab = firstrow + secondrow + thirdrow + fourthrow;
	        $('#searchcontent').append(tab);
	      }
	      break;
	      
	      default:
	      break;
	      
	      }
	      } else {
	        var sorry = '<span class="sorry">Sorry, no results.</span>';
	        $('#content').prepend(sorry);
	      }
	      }
	    };

	    req.open('GET','../php/basesearch.php?type=' + option.trim().toLowerCase() + '&searchinput='+searchinp + '&college='+colinp,true);
	    req.send();
	  }
	  } else {
	    //setMapOnAll(null);
	    $('#filler').css('min-height','0');
	    for (var y=0;y<markers.length;y++) {
	      markers[y].setMap(null);
	    }
	    markers = [];
	    var locinp = $('#loclat').val().trim();
	    if (locinp !== '') {
	      map.setCenter({lat: parseFloat(document.getElementById('loclat').value),lng: parseFloat(document.getElementById('loclng').value)});
	      $('.sorry').remove();
	      $('.sres').remove();

	      var aptreq = new XMLHttpRequest();
	      aptreq.onreadystatechange = function() {
	        if (aptreq.readyState == 4 && aptreq.status == 200) {
	          ar = JSON.parse(aptreq.responseText);
	          if (ar.length > 0) {
	            for (var z=0;z < ar.length;z++) {
	              if (ar[z].Pic1 == '') {
	                var picf = '';
	              } else {
	                var picf = '<img class="minipic" src="' + ar[z].Pic1 + '">';
	              }
	              firstrow = '<table class="sres" id="sres' + (z+1) + '"><tr class="titleslot"><td rowspan="3" class="picslot">' + picf + '</td><td class="blank"></td><td colspan="4" class="nameslot"><span>' + (z+1) + '. ' + ar[z]['Address'] + ' ' + ar[z]['Apt'] + '</span></td><td colspan="2" class="priceslot"><span>$' + ar[z]['Rent'] + '/month</span></td></tr>';
	              secondrow = '<tr class="miscslot"><td class="blank"></td><td class="wcard"><span>Beds: ' + ar[z]['Beds'] + '</span></td><td class="wcard"><span>Baths: ' + ar[z]['Baths'] + '</span></td><td class="wcard"></td><td colspan="3" class="contslot"><span>' + ar[z]['City'] + ', ' + ar[z]['State'] + '</span></td></tr>';
	              thirdrow = '<tr class="miscslot"><td class="blank"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td class="wcard"></td><td colspan="2" class="contslot"></td></tr>';
	              fourthrow = '<tr class="descripslot"><td></td><td class="blank"></td><td colspan="6" class="dslot"><p>Description: ' + ar[z]['Description'] + '</p></td></tr></table>';
	              tab = firstrow + secondrow + thirdrow + fourthrow;
	              $('#searchcontent').append(tab);
	              markers[z] = new google.maps.Marker({
	                position: {
	                  lat: parseFloat(ar[z]['Lat']),
	                  lng: parseFloat(ar[z]['Lng'])
	                },
	                map: map,
	                label: String(z+1)
	              });
	              addexpand(markers[z],(z+1));
	            }
	          } else {
	            var sorry = '<span class="sorry">Sorry, no results.</span>';
	            $('#content').prepend(sorry);
	          }
	        }
	      };
	      
	      aptreq.open('GET','../php/apartsearch.php?lat='+ document.getElementById('loclat').value + '&lng=' + document.getElementById('loclng').value + '&beds=' + document.getElementById('wbed').value + '&baths=' + document.getElementById('wbath').value + '&start_date=' + document.getElementById('wbegin').value + '&end_date=' + document.getElementById('wdend').value + '&sort=' + document.getElementById('wsortw').value + '&radius=' + document.getElementById('radius').value + '&minrent=' + document.getElementById('wminrent').value + '&maxrent=' + document.getElementById('wmaxrent').value,true);
	      aptreq.send();
	    }
	  }
	});
  $(document).on('click','.sres', function() {expand(parseInt($(this).attr('id').replace('sres',''))) });

});




