"use strict";



function headerDropdown () {
  if ($(".dropdown-menu li").length) {
    $(".dropdown-menu li").on('click', function(){
      $(this).parents(".dropdown").find('.btn-dropdown').html($(this).text() + ' <i class="fa fa-angle-down"></i>');
      $(this).parents(".dropdown").find('.btn-dropdown').val($(this).data('value'));
    });  
  };
}

function preloadFunction () {
  if ($('#loader').length) {
    $('#loader').fadeOut(); // will first fade out the loading animation
    $('#loader-wrapper').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
    $('body').delay(350).css({'overflow':'visible'});
  };
}

function menuScroll () {
  if ($('.menu_fixed.main_menu').length) {
    var sticky = $('.menu_fixed.main_menu'),
        scroll = $(window).scrollTop();

    if (scroll >= 190) sticky.addClass('fixed');
    else sticky.removeClass('fixed');
    
  };
}

function submitForm () {
  if ($(".dropdown-menu li").length) {
    $(".dropdown-menu li").on('click', function(){
      $(this).parents(".dropdown").find('.btn').html($(this).text() + ' <i class="fa fa-angle-down"></i>');
      $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
    });
  };
}

function thmMainSlider () {
  if ($("#main_slider").length) {
   $("#main_slider").revolution({
      sliderType:"standard",
      sliderLayout:"auto",
      loops:false,
      delay:6000,
      navigation: {
          arrows:{enable:true},
          bullets:{enable:true,
                  direction:"horizontal",
                  h_align:"center",
                  v_align:"bottom",
                  hide_onmobile:true,
                  hide_delay:200,
                  hide_onleave:false,
                  v_offset:45,
                  h_offset:-1,
                  space:20 }        
      },      
      responsiveLevels:[2020,1183,975,751,484],
            gridwidth:[1170,970,750,500,450],
            gridheight:[650,650,650,500,400],
            shadow:0,
            spinner:"off",
            autoHeight:"off",
            disableProgressBar:"on",
            hideThumbsOnMobile:"off",
            hideSliderAtLimit:0,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            debugMode:false,
            fallbacks: {
              simplifyAll:"off",
              disableFocusListener:false,
            }
    }); 
  }
 
}


function CounterNumberChanger () {
  var timer = $('.timer');
  if(timer.length) {
    timer.appear(function () {
      timer.countTo();
    })
  }
}


function owlCarousel () {
  if ($("#owl-demo").length) {
    var owl = $("#owl-demo");
   
    owl.owlCarousel({
        items : 4, 
        itemsDesktop : [992,3],
        itemsDesktopSmall : [768,2], 
        itemsTablet: [450,1], 
        itemsMobile : false,// itemsMobile disabled - inherit from itemsTablet option
        pagination : false,
        autoPlay:3000
    });
   
    // Custom Navigation Events
    $(".next").click(function(){
      owl.trigger('owl.next');
    })
    $(".prev").click(function(){
      owl.trigger('owl.prev');
    })

  };
}

function owlCarouselFooter () {
  if ($("#owl-demo2").length) {
    var owl = $("#owl-demo2");
   
    owl.owlCarousel({
        items : 5, 
        itemsDesktop : [992,4],
        itemsDesktopSmall : [768,2], 
        itemsTablet: [450,1], 
        itemsMobile : false,// itemsMobile disabled - inherit from itemsTablet option
        pagination : false,
        autoPlay:3000
    });

  };
}

function thmAccrodion () {
  if ($('#accordion > .panel').length) {
    $('#accordion > .panel').on('show.bs.collapse', function (e) {
          var heading = $(this).find('.panel-heading');
          heading.addClass("active-panel");
          
    });
    
    $('#accordion > .panel').on('hidden.bs.collapse', function (e) {
        var heading = $(this).find('.panel-heading');
          heading.removeClass("active-panel");
          //setProgressBar(heading.get(0).id);
    });

  };


}


function priceRanger () {

  if ($('.price-ranger').length) {
    $( '.price-ranger #slider-range' ).slider({
      range: true,
      min: 0,
      max: 700,
      values: [ 11, 500 ],
      slide: function( event, ui ) {
        $( '.price-ranger .ranger-min-max-block .min' ).val( '$' + ui.values[ 0 ] );
        $( '.price-ranger .ranger-min-max-block .max' ).val( '$' + ui.values[ 1 ] );
      }
    });
      $( '.price-ranger .ranger-min-max-block .min' ).val( '$' + $( '.price-ranger #slider-range' ).slider( 'values', 0 ) );
    $( '.price-ranger .ranger-min-max-block .max' ).val( '$' + $( '.price-ranger #slider-range' ).slider( 'values', 1 ) );        
  };
}



function swithcerMenu () {
  if ($('.switch_menu').length) {

    $('.switch_btn button').on('click', function(){
      $('.switch_menu').toggle(300)
    });

    $("#myonoffswitch").on('click', function(){
        $(".main_menu").toggleClass("menu_fixed");
        $(".main_menu").removeClass("fixed");
    });

    $("#boxed").on('click', function(){
      $(".layout_changer").addClass("home_boxed");
    });
    $("#full_width").on('click', function(){
      $(".layout_changer").removeClass("home_boxed");
    });
    $(".bg1").on('click', function(){
      $(".home_boxed").addClass("bg1");
      $(".home_boxed").removeClass("bg2 bg3 bg4");
    });
    $(".bg2").on('click', function(){
      $(".home_boxed").addClass("bg2");
      $(".home_boxed").removeClass("bg1 bg3 bg4");
    });
    $(".bg3").on('click', function(){
      $(".home_boxed").addClass("bg3");
      $(".home_boxed").removeClass("bg2 bg1 bg4");
    });
    $(".bg4").on('click', function(){
      $(".home_boxed").addClass("bg4");
      $(".home_boxed").removeClass("bg2 bg3 bg1");
    });

    $('#styleOptions').styleSwitcher({
        hasPreview: true,
        fullPath: 'css/custom/',
         cookie: {
          expires: 30,
          isManagingLoad: true
      }
    });

  };
}


function topSearch () {
  if ($('#search').length) {
    $('#button').click(function(){
      $('#search').fadeToggle(100);
    });
    $('#button').on('click', function(e) {
      $(this).toggleClass("search_click"); //you can list several class names 
      e.preventDefault();
    });

    $('.main_menu nav ul li.dropdown_menu').append(function () {
      return '<i class="fa fa-bars"></i>';
    });
    $('.main_menu nav ul li.dropdown_menu .fa').on('click', function () {
      $(this).parent('li').children('ul').slideToggle();
    });    
  };
}


function contactMap() {
  if ($('#contact-google-map').length) {
      var settingsItemsMap = {
        zoom: 12,
        center: new google.maps.LatLng(40.758896, -73.985130),
        zoomControlOptions: {
          style: google.maps.ZoomControlStyle.LARGE
        },
        scrollwheel: false,
        styles:[
            { featureType: "water", stylers: [ { color: "#1a8bb3"} ] },
            { featureType: "road", stylers: [ { color: "#f2f2f2" } ] }
        ],
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById('contact-google-map'), settingsItemsMap );
    var image = 'images/home/map-icon.png';
    var myMarker = new google.maps.Marker({
        position: new google.maps.LatLng(40.758896, -73.985130),
        draggable: true,
        icon: image
    });

    map.setCenter(myMarker.position);
    myMarker.setMap(map);
    // Google map 
  };
}



function mixitUpList () {
  if ($('#mixitup_list').length) {
     $('#mixitup_list').mixItUp(); // mix it up    
  };
}


function fancyPopUp () {
   if ($('.fancybox').length) {
     $(".fancybox").fancybox({
        wrapCSS    : 'fancybox-custom',
        closeClick : true,

        openEffect : 'none',

        helpers : {
          title : {
            type : 'inside'
          },
          overlay : {
            css : {
              'background' : 'rgba(0,0,0,0.75)'
            }
          }
        }
      });
  };
}

function selectDropdown () {
  if($(".selectmenu").length) {
    $( ".selectmenu" ).selectmenu();
  };
}


//Contact Form Validation
function contactFormValidation () {
  if($('.cf-validation').length){
    $('.cf-validation').validate({ // initialize the plugin
      rules: {
        fname: {
          required: true
        },
        email: {
          required: true,
          email: true
        },
        phone: {
          required: true
        },
        message: {
          required: true
        },
        subject: {
          required: true
        }
      },
      submitHandler: function (form) { 
        // sending value with ajax request
        var form = $(form);
        $.post(form.attr('action'), form.serialize(), function (response) {
          form.parent('div').append(response);
          form.find('input[type="text"]').val('');
          form.find('input[type="email"]').val('');
          form.find('textarea').val('');
        });
        return false;
      }
    });
  }
}


jQuery(document).on('ready', function () {
  (function ($) {
    thmMainSlider();
    headerDropdown();
    submitForm();
    CounterNumberChanger();
    owlCarousel();
    owlCarouselFooter();
    thmAccrodion();
    priceRanger();
    swithcerMenu();
    topSearch ();
    contactMap();
    mixitUpList();
    fancyPopUp();
    contactFormValidation();
    selectDropdown();
  })(jQuery);
});

jQuery(window).on('load', function () {
  (function ($) {
    preloadFunction();
  })(jQuery);
});

jQuery(window).on('scroll', function () {
  (function ($) {
    menuScroll();
  })(jQuery);
});



