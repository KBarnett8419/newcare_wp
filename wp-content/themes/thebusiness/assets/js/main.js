//scroll down
(function ($) {

    $(document).ready(function () {

        // NICE SCROLL 
        $('body').niceScroll({
            cursorcolor: '#2196F3',
            cursoropacitymin: 0.4,
            cursorborder: 'none',
            scrollspeed: 80,
            cursorborderradius: '0',
            cursorwidth: '8px'
        });

        // WOW JS
        new WOW().init();

        // DOWN ARROW
        $("#down-arrow").scrollDown();

        // smooth scroll top
        $('#gotop').each(function(){
            $(this).click(function(e){
                e.preventDefault();
                $('html,body').animate({ scrollTop: 0 }, 1000);
                return false; 
            });
        }); 

        //sticky nav    
          var  mn = $("#masthead");
            mns = "main-nav-scrolled";
            hdr = $('.header-accessories').height();

        $(window).scroll(function() {
          if( $(this).scrollTop() > hdr ) {
            mn.addClass(mns);
          } else {
            mn.removeClass(mns);
          }
        });
        
        //slidenav
        $("#tbNavToggle").click(function(){
          $("#site-navigation").css("width", "250px");
          $("#page").css("marginRight", "250px");
        });

        //close
        $(".closebtn").click(function(){
          $("#site-navigation").css("width", "0");
          $("#page").css("marginRight", "0");
        });

    });
                     
})(jQuery);
