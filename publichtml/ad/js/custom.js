
// Login popup handle
$('.login-button').click(function(){
    $('#register').attr('data-redirect', $(this).attr('data-redirect'))

    if($(this).attr('data-close')){
      $('#register').attr('data-close', $(this).attr('data-close'))
    }else{
      $('#register').attr('data-close', null)
    }

    if($(this).attr('data-callback')){
      $('#register').attr('data-callback', $(this).attr('data-callback'))
    }else{
      $('#register').attr('data-callback', null)
    }


  })
