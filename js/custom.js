jQuery.noConflict();
jQuery(document).ready(function( $ ){


// Mobile Menu
// -------------------

  $('.toggle-menu').click(function(){
    if($('.search-icon').hasClass('search-clicked')){
          $('#searchform').slideToggle();
          $('.search-icon').toggleClass('search-clicked');
          
        };
        $(this).toggleClass('menu-clicked');
        $('#menu-main-navigation').slideToggle();
  });

// Toggle Search
// -------------------

  $('.search-icon').click(function(){
        if($('.toggle-menu').hasClass('menu-clicked')){
          $('#menu-main-navigation').slideToggle();
          $('.toggle-menu').toggleClass('menu-clicked');
        };
        $(this).toggleClass('search-clicked');
        $('#searchform').slideToggle();
  });


// Country Selector
// -------------------

  $('li a.cool_menu_first').click(function(){
        $('ul.showMenu').toggle();
        return false;
	});

  
//--------------------------------------------------
// Execute FitVids on youtube and vimeo

if(jQuery().fitVids && $('iframe[src*="vimeo.com"],iframe[src*="youtube.com"],iframe[src*="google.com/maps"]')) {
  $('iframe[src*="vimeo.com"],iframe[src*="youtube.com"],iframe[src*="google.com/maps"]').each(function() {
    $(this).wrap('<div class="fluid-video"></div>');
    $('.fluid-video').fitVids();
  });
}


//--------------------------------------------------
// Homepage Carousels

if( $('.calling-info').length ) {
  var slider = $('.calling-info').bxSlider({
      pager: true,
      controls: false,
  });

    enquire.register("screen and (min-width: 500px) and (max-width: 760px)", {
      match : function() {

        slider.reloadSlider({
          infiniteLoop: false,
          slideWidth: 307,
          minSlides: 2,
          maxSlides: 2,
          slideMargin: 10,
          adaptiveHeight: true,
          pager: false,
          controls: false
        });
            
      },  
      unmatch : function() {

        slider.reloadSlider({
            infiniteLoop: true,
            slideWidth: 307,
            minSlides: 1,
            maxSlides: 1,
            adaptiveHeight: true,
            pager: true,
            controls: false,
            auto: true
        });
      }
  }, true);

}

  if( $('.steps-slider').length ) {
    $('.steps-slider').bxSlider({
      infiniteLoop: true,
      hideControlOnEnd: false,
      adaptiveHeight: true,
      pagerCustom: '#bx-pager'
  	});
  }

//--------------------------------------------------
// Tooltip

	$('.tooltip').mouseover(function(e){
		var tooltip_text = $(this).attr('alt');
		$('.tooltip_text').append(tooltip_text);
		$('#tooltip_container').css('display','block');
		
		}).mousemove(function(e){
			$('#tooltip_container').css('left', (e.pageX+80)+'px');
			$('#tooltip_container').css('top', (e.pageY-10)+'px');
			
		}).mouseout(function(e){
			$('#tooltip_container').css('display','none');
			$('.tooltip_text').text('');
			
		});

// If logged in and Wp Admin Bar shows then add additional top padding to the body
if($('#wpadminbar').length){
 $('body').css('padding-top','32px');	
}



// RSS Feeds - Hide empty p tags and the break tags

	$('.rss-box-1 > p:empty').hide();
	$('#travelSummary br').hide();


  //Randomise Home Page Popular Countries
(function($){
 
    $.fn.shuffle = function() {
 
        var allElems = this.get(),
            getRandom = function(max) {
                return Math.floor(Math.random() * max);
            },
            shuffled = $.map(allElems, function(){
                var random = getRandom(allElems.length),
                    randEl = $(allElems[random]).clone(true)[0];
                allElems.splice(random, 1);
                return randEl;
           });
 
        this.each(function(i){
            $(this).replaceWith($(shuffled[i]));
        });
 
        return $(shuffled);
 
    };
 
})($);
$('ul.randomise_list li').shuffle().slice(3).hide();	



//Script for User Voice
  var uvOptions = {};
  (function() {
    var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
    uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/zIDnJRWafVwOxdRureBaw.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);
  })();


// Scroll to script

$('a.scrollToTop, a.toTop').click(function(){
$('html, body').animate({scrollTop:0}, 'slow');
 
 	return false;
});


 // RateFinder
$('.ratefindertool').click(function(){
	$('.bg_fade_ratefinder').fadeIn();							  
	
  });
$('.close_form').click(function(){
	$('.bg_fade_ratefinder').fadeOut();							  
 });


//  Country Alphabet

$('#country-alphabet-nav a').click(function(){
		$('#country-alphabet-nav a').removeClass();
		$(this).addClass('activeCountry');
	});


// Wuffo Form 
var m7x3w7;(function(d, t) {
var s = d.createElement(t), options = {
'userName':'hedge', 
'formHash':'m7x3w7', 
'autoResize':true,
'height':'855',
'async':true,
'header':'show'};
s.src = ('https:' == d.location.protocol ? 'https://' : 'http://') + 'wufoo.com/scripts/embed/form.js';
s.onload = s.onreadystatechange = function() {
var rs = this.readyState; if (rs) if (rs != 'complete') if (rs != 'loaded') return;
try { m7x3w7 = new WufooForm();m7x3w7.initialize(options);m7x3w7.display(); } catch (e) {}};
var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, 'script');



}); // End document Ready
