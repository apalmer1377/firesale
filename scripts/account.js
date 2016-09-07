$(function() {
  $('#leftnav h1').on('click',function(){
    window.location.href = '../markup/tryout.php';
  });
  
  var account_clicked = false;
	
	$('#account').on('click',function(){
	  if (account_clicked === false) {
	    
		$('#testrow').css('right',($(window).width() - ($('#account').offset().left + $('#account').outerWidth())));
		$('#testrow').css('top',($('#rightnav').outerHeight()));
		$('#testrow').slideDown(300);
		setTimeout(function () {
		  account_clicked = true;
		},300);
	  }
	});
	
	$(document).on('click',function(e) {
	  if (e.target.classList[0] != 'accountblock' && e.target.classList[0] != 'welcomeblock' && account_clicked === true) {
	  $('#testrow').slideUp(300);
	  setTimeout(function() {
	    account_clicked = false;
	  },300);
	  }
	});
	
	$(window).on('resize', function(e) {
	  $('#testrow').css('display','none');
	  account_clicked = false;
	});
	
	$(document).on('click','#postit',function(){
	  window.location.href = 'postitem.php';
	});
	
	$(document).on('click','#maccount',function(){
	  window.location.href = 'myaccount.php';
	});
	
	$(document).on('click','#logout',function(){
	  window.location.href = '?logout=true';
	});
	
});