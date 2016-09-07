var pics = [0,0,0,0,0];
var piccount;

$(function() {
  var typ = '';
  var prevtyp;
	$('.postsubmit').on('click',function(e) {
		e.preventDefault();
		typ = $('#college').val();
		if (typ !== prevtyp) {
		$('#steptwo').remove();
		
		var forme = '<div id="steptwo"><br>';
		var nstep = true;
		switch(typ) {
			case 'textbook':
				forme += '<span class="lookie">* </span><label for="booktitle">Title: </label> \
						<input type="text" size="25" id="booktitle" name="booktitle"><br> \
						<label for="edition">Edition(optional):</label> \
						<input type="text" size="5" id="edition" name="edition"><br> \
						<span class="lookie">* </span><label for="author">Author(s):</label> \
						<input type="text" size="25" id="author" name="author"><br> \
						<label for="publisher">Publisher(optional):</label> \
						<input type="text" size="25" id="publisher" name="publisher"><br> \
						<span class="lookie">* </span><label for="bookprice">Price: $</label> \
						<input type="number" size="5" id="bookprice" name="bookprice"><br>';
				break;
			case 'apartment':

				forme += '<span class="lookie">* </span><label for="address">Street Address:</label> \
				    <input type="text" size="25" id="address" name="address" onFocus="initAutocomplete()"><br> \
						<label for="apt">Apartment(optional):</label> \
						<input type="text" size="5" id="apt" name="apt"><br> \
						<span class="lookie">* </span><label for="city">City:</label> \
						<input type="text" size="25" id="city" name="city"><br> \
						<span class="lookie">* </span><label for="state">State:</label> \
						<input type="text" size="25" id="state" name="state"><br> \
						<span class="lookie">* </span><label for="zip">Zip Code:</label> \
						<input type="text" size="5" id="zip" name="zip"><br> \
						<span class="lookie">* </span><label for="rent">Monthly Rent: $</label> \
						<input type="number" size="10" id="rent" name="rent"><br> \
						<span class="lookie">* </span><label for="available">Availability:</label> \
						<input type="date" id="available" name="available"> \
						<label for="endavailable">To</label> \
						<input type="date" id="endavailable" name="endavailable"><br> \
						<span class="lookie">* </span><label for="bedroom">Bedrooms:</label> \
						<input type="number" size="5" id="bedroom" name="bedroom"> \
						<span class="lookie">* </span><label for="bathroom">Bathrooms:</label> \
						<input type="number" size="5" id="bathroom" name="bathroom"><br> \
						<input type="text" id="lat" class="hid" name="lat"><input type="text" id="lng" name="lng" class="hid">';
				break;
			case 'service':
				forme += '<span class="lookie">* </span><label for="servicename">Service Provided:</label> \
				              <input type="text" size="25" id="servicename" name="servicename" placeholder=" Tutoring,Dog-Walking,etc."><br> \
				              <span class="lookie">* </span><label for="serviceprice">Price:</label> \
				              <input type="text" size="25" id="serviceprice" name="serviceprice" placeholder=" $100,$10/hr,etc."><br>';
				break;
			case 'misc':
				forme += '<span class="lookie">* </span><label for="miscname">Name of Listing:</label> \
				              <input type="text" size="25" id="miscname" name="miscname"><br> \
				              <label for="category">What the hell is it?</label> \
				              <select name="category" id="category"> \
				                      <option value="Appliance">Appliance</option> \
				                      <option value="Furniture">Furniture</option> \
				                      <option value="Sporting Goods">Sporting Goods</option> \
				                      <option value="Electronics">Electronics</option> \
				                      <option value="Transportation">Transportation</option> \
				                      <option value="Other">Other</option> \
				              </select><br> \
				              <span class="lookie">* </span><label for="miscprice">Price: $</label> \
				              <input type="number" size="5" id="miscprice" name="miscprice"><br>';
				break;
			default:
				alert("You ain't selling dick!");
				nstep = false;
		}
		
    var describe = '<br><p><span class="lookie">* </span>Description:</p> \
                            <textarea id="description" name="description" rows="10" cols="50"></textarea><br> \
                            <table id="pictures"><tr id="pic1"><td class="piccell"> \
                            <label for="picture1">Add Pictures: </label></td><td> \
                            <input type="file" class="picture" id="picture1" name="picture1"></td></tr></table> \
                            <br><p><span class="lookie">* </span>Contact Information (must enter at least one of the two): </p> \
                            <label for="phone">Phone Number: </label> \
                            <input type="tel" id="phone" name="phone"><br> \
                            <label for="mail">E-mail Address: </label> \
                            <input type="email" id="mail" name="mail"><br> \
                            <input type="submit" name="postit" value="Post Item"></div> \
    </form>';
    forme += describe;
    if (nstep === true) {
      $('#itemtype').append(forme);
      $('#steptwo').slideDown(400);
      }
      prevtyp = typ;
		}
  });

  $(document).on('change','.picture',function() {
    var num = parseInt($(this).attr('id').replace('picture',''));
    if (pics[num-1] === 0) {
      if ($(this).val() !== '') {
        if (num < 5) {
          pics[num-1] = 1;
          var newpic = '<tr id="pic' + (num+1) + '"><td class="piccell"></td><td><input type="file" class="picture" id="picture' + (num + 1) + '" name="picture' + (num+1) + '"></td></tr>';
          $('#pictures').append(newpic);
        }
      }
    }
    
  });

  
});