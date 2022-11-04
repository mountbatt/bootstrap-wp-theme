var theme_dir = directory_uri.stylesheet_directory_uri+'/';

jQuery(document).ready(function($) {
   	
   if(!window.getComputedStyle(document.body).mixBlendMode) {
	  $('body').addClass("no-mix-blend-mode no-blend-mode");
	  console.log('no-mix-blend-mode');
	}
	
	if(!window.getComputedStyle(document.body).backgroundBlendMode) {
	  $('body').addClass("no-background-blend-mode no-blend-mode");
	  console.log('no-background-blend-mode');
	}


   /// Scroll to anchor on page load
   
   function scrollToAnchor(hash) {
       var target = $(hash),
           headerHeight = $('#header').outerHeight() + 55; // Get fixed header height
   
       target = target.length ? target : $('[name=' + hash.slice(1) +']');
   
       if (target.length)
       {
           $('html,body').animate({
               scrollTop: target.offset().top - headerHeight
           }, 100);
           $('*').removeClass('anchored');
           target.addClass('anchored');
           return false;
       }
   }
   
   if(window.location.hash) {
       scrollToAnchor(window.location.hash);
   }
   
   
   $("a[href*=\\#]:not([href=\\#])").click(function()
   {
      if (!$(this).hasClass("collapsible")) {
          if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
              || location.hostname == this.hostname)
          {
              scrollToAnchor(this.hash);
          }
       }
   });
   
   // WOW
   /*
   wow = new WOW(
    {
    boxClass:     'wow',  
    animateClass: 'animate__animated', 
    offset:       200, 
    mobile:       true,   
    live:         true    
   }
   )
   wow.init();
   */
   
   // Ligthbpx
   /*
   var lightbox = new SimpleLightbox('.gallery a', { 
      scrollZoom: false,
      disableRightClick: true,
      showCounter: false,
      navText: ['«','»'],
      overlayOpacity: 0.85,
    });
   */
   
   // LOADER ANIMATION      
   // $('#loader-wrapper').fadeOut();
   

});