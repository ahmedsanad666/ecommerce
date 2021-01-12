$(function () {
    


    $('[placeholder]').focus(function () {
        
        $(this).attr('data-text', $(this).attr('placeholder'));

        $(this).attr('placeholder', '');


        
    }).blur(function () {
        $(this).attr('placeholder', $(this).attr('data-text'));
    });


    // creat validation with js to show that input is required

    
    $('input').each(function () {
    
        if ($(this).attr('required') === 'required') {
            
            $(this).after('<span class="asterisk"> * </span>');
        }
    });





    // show password
     let pass =$('.password');


    $('.show_pass').hover(function () {
        
        pass.attr('type', 'text');
    }, function () {
            
            pass.attr('type', 'password');
    })


    // fonfirmation button 

    $('.confirm').click(function(){

        return confirm('Are U Sure ??'); 
    })
});
