/**
 * Created by diole on 09/01/16.
 */



$(function() {

    "use strict";

    var window_width = $(window).width();

    /*Preloader*/
    $(window).load(function() {
        setTimeout(function() {
            $('body').addClass('loaded');
        }, 100);
    });


    // Materialize Dropdown
    $('.dropdown-button').dropdown({
        inDuration: 300,
        outDuration: 125,
        constrain_width: true, // Does not change width of dropdown to that of the activator
        hover: false, // Activate on click
        alignment: 'left', // Aligns dropdown to left or right edge (works with constrain_width)
        gutter: 0, // Spacing from edge
        belowOrigin: true // Displays dropdown below the button
    });


    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });


    // Materialize scrollSpy
    $('.scrollspy').scrollSpy();

    // Materialize tooltip
    $('.tooltipped').tooltip({
        delay: 50
    });

    // Materialize sideNav

    //Main Left Sidebar Menu
    $('.sidebar-collapse').sideNav({
        edge: 'left', // Choose the horizontal origin
    });

    // FULL SCREEN MENU (Layout 02)
    $('.menu-sidebar-collapse').sideNav({
        menuWidth: 240,
        edge: 'left', // Choose the horizontal origin
        //defaultOpen:true // Set if default menu open is true
    });

    // HORIZONTAL MENU (Layout 03)
    $('.dropdown-menu').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrain_width: false, // Does not change width of dropdown to that of the activator
        hover: true, // Activate on hover
        gutter: 0, // Spacing from edge
        belowOrigin: true // Displays dropdown below the button
    });


    //Main Left Sidebar Chat
    $('.chat-collapse').sideNav({
        menuWidth: 300,
        edge: 'right',
    });
    $('.chat-close-collapse').click(function() {
        $('.chat-collapse').sideNav('hide');
    });
    $('.chat-collapsible').collapsible({
        accordion: false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });

    // Pikadate datepicker
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });

    // Perfect Scrollbar
    $('select').not('.disabled').material_select();
    var leftnav = $(".page-topbar").height();
    var leftnavHeight = window.innerHeight - leftnav;
    $('.leftside-navigation').height(leftnavHeight).perfectScrollbar({
        suppressScrollX: true
    });
    var righttnav = $("#chat-out").height();
    $('.rightside-navigation').height(righttnav).perfectScrollbar({
        suppressScrollX: true
    });


    // Fullscreen
    function toggleFullScreen() {
        if ((document.fullScreenElement && document.fullScreenElement !== null) ||
            (!document.mozFullScreen && !document.webkitIsFullScreen)) {
            if (document.documentElement.requestFullScreen) {
                document.documentElement.requestFullScreen();
            }
            else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            }
            else if (document.documentElement.webkitRequestFullScreen) {
                document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            }
        }
        else {
            if (document.cancelFullScreen) {
                document.cancelFullScreen();
            }
            else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            }
            else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            }
        }
    }

    $('.toggle-fullscreen').click(function() {
        toggleFullScreen();
    });


    // Floating-Fixed table of contents (Materialize pushpin)
    if ($('nav').length) {
        $('.toc-wrapper').pushpin({
            top: $('nav').height()
        });
    }
    else if ($('#index-banner').length) {
        $('.toc-wrapper').pushpin({
            top: $('#index-banner').height()
        });
    }
    else {
        $('.toc-wrapper').pushpin({
            top: 0
        });
    }

    // Toggle Flow Text
    var toggleFlowTextButton = $('#flow-toggle')
    toggleFlowTextButton.click(function() {
        $('#flow-text-demo').children('p').each(function() {
            $(this).toggleClass('flow-text');
        })
    });


    //Toggle Containers on page
    var toggleContainersButton = $('#container-toggle-button');
    toggleContainersButton.click(function() {
        $('body .browser-window .container, .had-container').each(function() {
            $(this).toggleClass('had-container');
            $(this).toggleClass('container');
            if ($(this).hasClass('container')) {
                toggleContainersButton.text("Turn off Containers");
            }
            else {
                toggleContainersButton.text("Turn on Containers");
            }
        });
    });

    // Detect touch screen and enable scrollbar if necessary
    function is_touch_device() {
        try {
            document.createEvent("TouchEvent");
            return true;
        }
        catch (e) {
            return false;
        }
    }
    if (is_touch_device()) {
        $('#nav-mobile').css({
            overflow: 'auto'
        })
    }

    //LINE CHART WITH AREA IN SIDEBAR

    $('#data-table').DataTable({
        "language": {
            "zeroRecords": "No hay datos para mostrar",
            "info": "Mostrando _PAGE_ pagina de _PAGES_",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": "Buscar",
            "paginate": {
                "first":      "Primero",
                "last":       "Ultimo",
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        }
    });

    $(".load").on("click", function(){
        $('body').removeClass('loaded');
    })

    if($(".toats").length>0){
        var $toastContent = $('.toats').attr("message");
        Materialize.toast($toastContent, 5000);
    }

    $('.modal-trigger').leanModal();

    $(".ajaxify").on("click", function(e){
        $('.preloader-wrapper').addClass('active');
        var url = $(this).attr("url");
        $("#main-wrapper").load(url,function() {
            $('.preloader-wrapper').removeClass('active');
        });

    })

}); // end of document ready
