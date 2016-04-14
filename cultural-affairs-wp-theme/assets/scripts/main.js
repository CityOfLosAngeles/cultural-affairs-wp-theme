/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
        
        //---- Init controller ----
        var controller = new ScrollMagic.Controller();

        // change behaviour of controller to animate scroll instead of jump
        controller.scrollTo(function (newpos) {
          TweenMax.to(window, 0.7, {scrollTo: {y: newpos}});
        });

        //  bind scroll to anchor links
        $(document).on("click", "a.smooth[href^='#']", function (e) {

          var id = $(this).attr("href");
          if ($(id).length > 0) {
            e.preventDefault();

            // trigger scroll
            controller.scrollTo(id);
          }
        });

        // Mobile menu JS
        $('.toggled-cover').on('click',function(){
            $('.navbar-collapse').collapse('hide');
            $(this).addClass('hide').removeClass('shown');
            $('body').toggleClass('noscroll-body');
        });

        $('.navbar-toggle').on('click',function(){
          $('.toggled-cover').removeClass('hide').addClass('shown');
          $('body').toggleClass('noscroll-body');
        });

        $('.close-btn').on('click',function(){
          $('.toggled-cover').addClass('hide').removeClass('shown');
          $('body').toggleClass('noscroll-body');
        });

        $('.categories-option').on('click', function(){
          $(this).toggleClass('opened');
        });

        // Mobile search toggle JS
        $('.search-toggle').on('click', function(){
          $(this).toggleClass('opened');
        });

        // Drop Down Hovers
        $(document).ready(function() {
            function toggleNavbarMethod() {
                if ($(window).width() > 768) {


                        $('.navbar-nav .menu-item-has-children a').hover(
                            function(e){ 
                              $hoverTrigger = $(this);
                              $subMenu = $hoverTrigger.next('.sub-menu');
                              $subMenu.show(); 
                            }, // over
                            function(e){
                              $subMenu.hide();
                               $($subMenu).hover(
                                  function(e){ 
                                    $(this).show(); 
                                  }, // over
                                  function(e){ 
                                    $(this).hide(); 
                                  }  // out
                              );
                            }  // out
                        );

                }
                else {
                    $('.navbar-nav .menu-item-has-children a .submenu').show();
                }
            }
            toggleNavbarMethod();
            $(window).resize(toggleNavbarMethod);
        });
        
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page

        // Same Height Elements on Homepage
        function resizeHomeElements() {
                var copyHeight = 0;
                    copyHeight = $('.copy-item').outerHeight();
                    columns = $('.below-header-section .item');

                columns.css('height', copyHeight);
              }

        // Events Masonry
        $('.ecs-event .entry-title').each(function() {
          var newDiv = $('<div/>').addClass('event-caption');
          $(this).before(newDiv);
          var next = $(this).next();
          newDiv.append(this).append(next);
        });
        var $grid =  $('.ecs-event-list').masonry({
          // options
          itemSelector: '.ecs-event',
          gutter: 30,
          columnWidth: '.ecs-event'
        });

        // Events Hovered
        $('.entry-title > a').hover(
               function(){ 
                $(this).closest('.ecs-event').addClass('hover');
              },
               function(){ 
                $(this).closest('.ecs-event').removeClass('hover');
              }
        );
        $('.ecs-event > a').hover(
               function(){ 
                $(this).closest('.ecs-event').addClass('hover');
              },
               function(){ 
                $(this).closest('.ecs-event').removeClass('hover');
              }
        );

        // Same Height on load and resize
        $( window ).load(function() {
          if ($(window).width() > 991) {
            resizeHomeElements();
          }else {
            $('.below-header-section .item').css('height', 'auto');
          }
          $grid.masonry( 'layout' );
        });  
        $( window ).resize(function() {
          if ($(window).width() > 991) {
            resizeHomeElements();
          }else {
            $('.below-header-section .item').css('height', 'auto');
          }
          $grid.masonry();
        });


      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about': {
      init: function() {
        // JavaScript to be fired on the about us page
        $('#map-carousel').on('slid.bs.carousel', function () {
          // do something…
          var caption = $('.item.active .carousel-caption').text();
          $('.carousel-caption-bg').text(caption);
        });
      }
    },
    // Single Contact Division
    'single_contact_division': {
      init: function() {
        $('.bio-member').readmore({
          speed: 100,
          collapsedHeight: 115,
          heightMargin: 16,
          moreLink: '<a class="btn btn-sm" href="">More</a>',
          lessLink: '<a class="btn btn-sm" href="">Less</a>',
          embedCSS: false,
          startOpen: false,
        });

      }
    },
    // FAQs
    'faqs': {
      init: function() {
        var hash = window.location.hash.substr(1);

        if (hash && ( hash > 1)) {
          $("#collapse1").collapse();
          $('#collapse' + hash).collapse();
          console.log(hash);
        }

      }
    },
    // Grant and Call Page
    'post_type_archive_grant_and_call': {
      init: function() {

        // Ajax function
        function ajaxLoadGrant( val, page ){
            $.ajax({
                type:"POST",
                url: "/wp-admin/admin-ajax.php",
                cache: false,
                data: {
                    action: 'more_grants',
                    filterVal: val,
                    page: page,
                },
                success: function(data){
                  if ( page === '0' ) {
                    $(".loading-div").hide();
                    $( "#grant-list" ).html( data); 
                  }else{
                    $(".loading-div").hide();
                    $(".more-nav").hide();
                    $( "#grant-list" ).append( data);      
                  }
                },
                error: function(){
                    console.log('error');
                }
            });

            return false;
        }

        // On Load More click
        $(document).on('click', '.load-more-btn', function(){

            $('.loading-div').show();

            setTimeout( ajaxLoadGrant( $(this).attr("data-filter-class"), $( this ).attr("data-page") ), 3000 );
        });
      }
    },
    // Single Grant Page
    'single_grant_and_call': {
      init: function() {
        $(window).load(function() {
          $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails"
          });
        });
      }
    },
    // Single Program Initiative
    'single_program_initiative': {
      init: function() {
        $(window).load(function() {
          $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails"
          });
        });
      }
    },
    // Single Cultural Center
    'single_cultural_center': {
      init: function() {
        $(window).load(function() {
          $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails"
          });
        });
      }
    },
    // Single Artist Projects
    'single_artists_projects': {
      init: function() {
        $(window).load(function() {
          $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails"
          });
        });
      }
    },
    // Cultural Centers
    'post_type_archive_cultural_center': {
      init: function() {
        // JavaScript to be fired on the cultural centers page
        // Ajax function
        function ajaxLoadCenters( val, page, artClasses ){

            $.ajax({
                type:"POST",
                url: "/wp-admin/admin-ajax.php",
                cache: false,
                data: {
                    action: 'more_cultural_centers',
                    filterVal: val,
                    page: page,
                    artClasses : artClasses,
                },
                success: function(data){
                  if ( page === '0' ) {
                    $(".loading-div").hide();
                    $( "#cultural-center-list" ).html( data); 
                  }else{
                    $(".loading-div").hide();
                    $(".more-nav").hide();
                    $( "#cultural-center-list" ).append( data);      
                  }
                },
                error: function(){
                    console.log('error');
                }
            });

            return false;
        }

        // On filter click
        $(document).on('click', '.cultural-center-filter-item', function(){
          var artClasses;

            if($('#art-class-switch').is(":checked")) {
              artClasses = '1';
            }else{
              artClasses = '0';
            }  

            $('.cultural-center-filter-item').removeClass('active');
            $('#art-class-switch').attr( 'data-filter-class', $(this).attr("data-filter-class") );
            $(this).addClass('active');
            $('.loading-div').show();

            setTimeout( ajaxLoadCenters( $(this).attr("data-filter-class"), $(this).attr("data-page"), artClasses ), 3000 );
        });

        // On Load More click
        $(document).on('click', '.load-more-btn', function(){
          var artClasses;

            if($('#art-class-switch').is(":checked")) {
              artClasses = '1';
            }else{
              artClasses = '0';
            }  
            $('.loading-div').show();

            setTimeout( ajaxLoadCenters( $(this).attr("data-filter-class"), $( this ).attr("data-page"), artClasses ), 3000 );
        });

        // Art Classes Switch      
        $('#art-class-switch').change(function() {
          var artClasses;

            if($(this).is(":checked")) {
              artClasses = '1';
              $('#classes-filter .filter-label').addClass('on').html('Art Classes Available (On)');
            }else{
              $('#classes-filter .filter-label').removeClass('on').html('Art Classes Available (Off)');
              artClasses = '0';
            }  
            $('.loading-div').show();

            setTimeout( ajaxLoadCenters( $(this).attr("data-filter-class"), $( this ).attr("data-page"), artClasses ), 3000 );   
        });

      }
    },
    // Artists Projects
    'post_type_archive_artists_projects': {
      init: function() {
        // JavaScript to be fired on the cultural centers page
        // Ajax function
        function ajaxLoadProjects( val, page, artClasses ){

            $.ajax({
                type:"POST",
                url: "/wp-admin/admin-ajax.php",
                cache: false,
                data: {
                    action: 'more_artist_projects',
                    filterVal: val,
                    page: page,
                    artClasses : artClasses,
                },
                success: function(data){
                  if ( page === '0' ) {
                    $(".loading-div").hide();
                    $( "#artist-project-list" ).html( data); 
                  }else{
                    $(".loading-div").hide();
                    $(".more-nav").hide();
                    $( "#artist-project-list" ).append( data);      
                  }
                },
                error: function(){
                    console.log('error');
                }
            });

            return false;
        }

        // On filter click
        $(document).on('click', '.artist-project-filter-item', function(){
          var artClasses;

            if($('#art-class-switch').is(":checked")) {
              artClasses = '1';
            }else{
              artClasses = '0';
            }  

            $('.artist-project-filter-item').removeClass('active');
            $('#art-class-switch').attr( 'data-filter-class', $(this).attr("data-filter-class") );
            $(this).addClass('active');
            $('.loading-div').show();

            setTimeout( ajaxLoadProjects( $(this).attr("data-filter-class"), $(this).attr("data-page"), artClasses ), 3000 );
        });

        // On Load More click
        $(document).on('click', '.load-more-btn', function(){
          var artClasses;

            if($('#art-class-switch').is(":checked")) {
              artClasses = '1';
            }else{
              artClasses = '0';
            }  
            $('.loading-div').show();

            setTimeout( ajaxLoadProjects( $(this).attr("data-filter-class"), $( this ).attr("data-page"), artClasses ), 3000 );
        });

        

      }
    },
    // City Art Collection Page
    'city_art_collection': {
      init: function() {
        $(window).load(function() {
          $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails"
          });
        });
      }
    },
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
