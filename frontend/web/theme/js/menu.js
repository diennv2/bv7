 $('.openMenu,.closeMenu,.over').on('click',function(){
        $('.menuRight ul ul').slideUp(300);
        $('.menuRight .sub > i').removeClass('rotate');
        $('.menuRightMain,.over,#wrapper').toggleClass('open');

    });

    $('.menuRight .sub > i').on('click', function(e){

        e.preventDefault();
        $cssmnu=$(this).next('ul').css('display');
        if($cssmnu=='none'){
        $('.menuRight ul ul').slideUp(300);
        $(this).next('ul').stop().slideDown(300);
        $(this).addClass('rotate');
        }else{
        $(this).next('ul').stop().slideUp(300);  
         $(this).removeClass('rotate');
        }
    });
 