//scroll down
jQuery.fn.scrollDown = function () {
    this.click( function() {
        
        var $this = jQuery(this),
            target = $this.attr('data-target'),
            animationDuration = $this.attr('data-animation-duration');
             
        jQuery('html, body').stop().animate({
            scrollTop: jQuery(target).offset().top
        }, 1000 );
        
    } );
}

