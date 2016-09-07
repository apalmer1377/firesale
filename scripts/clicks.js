/*var option = 'NOTHING';

$(function() {

  $(document).on('click','.unclicknav, .clicknav',function(e) {
    var f = e.target;
    if (e.target.className == 'unclicknav') {
      $('.clicknav').attr('class','unclicknav');
      $(e.target).attr('class','clicknav');
      option = $(e.target).text();
    } else {
      $(e.target).attr('class','unclicknav');
      option = 'NOTHING';
    }
    $('#optional p').remove();
    $('#optional').append('<p>You have selected ' + option + '</p>');
    $('input[name="searchinput"]').attr('placeholder',' Search for' + option.toLowerCase());
  });

});
*/