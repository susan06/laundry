/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var CURRENT_URL = window.location.href.split('?')[0],
    $BODY = $('body'),
    $MENU_TOGGLE = $('#menu_toggle'),
    $SIDEBAR_MENU = $('#sidebar-menu'),
    $SIDEBAR_FOOTER = $('.sidebar-footer'),
    $LEFT_COL = $('.left_col'),
    $RIGHT_COL = $('.right_col'),
    $NAV_MENU = $('.nav_menu'),
    $FOOTER = $('footer');

// datatable-responsive
$(document).ready(function() {
    $('#datatable-responsive').DataTable({
      "searching": false,
      "paging": false,
      "bInfo": false,
    });
});
// Sidebar

// Sidebar
$(document).ready(function() {
    // TODO: This is some kind of easy fix, maybe we can improve this
    var setContentHeight = function () {
        // reset height
        $RIGHT_COL.css('min-height', $(window).height());

        var bodyHeight = $BODY.outerHeight(),
            footerHeight = $BODY.hasClass('footer_fixed') ? 0 : $FOOTER.height(),
            leftColHeight = $LEFT_COL.eq(1).height() + $SIDEBAR_FOOTER.height(),
            contentHeight = bodyHeight < leftColHeight ? leftColHeight : bodyHeight;

        // normalize content
        contentHeight -= $NAV_MENU.height() + footerHeight;

        $RIGHT_COL.css('min-height', contentHeight);
    };

    $SIDEBAR_MENU.find('a').on('click', function(ev) {
        var $li = $(this).parent();

        if ($li.is('.active')) {
            $li.removeClass('active active-sm');
            $('ul:first', $li).slideUp(function() {
                setContentHeight();
            });
        } else {
            // prevent closing menu if we are on child menu
            if (!$li.parent().is('.child_menu')) {
                $SIDEBAR_MENU.find('li').removeClass('active active-sm');
                $SIDEBAR_MENU.find('li ul').slideUp();
            }
            
            $li.addClass('active');

            $('ul:first', $li).slideDown(function() {
                setContentHeight();
            });
        }
    });

    // toggle small or large menu
    $MENU_TOGGLE.on('click', function() {
        if ($BODY.hasClass('nav-md')) {
            $SIDEBAR_MENU.find('li.active ul').hide();
            $SIDEBAR_MENU.find('li.active').addClass('active-sm').removeClass('active');
        } else {
            $SIDEBAR_MENU.find('li.active-sm ul').show();
            $SIDEBAR_MENU.find('li.active-sm').addClass('active').removeClass('active-sm');
        }

        $BODY.toggleClass('nav-md nav-sm');

        setContentHeight();
    });

    // check active menu
    $SIDEBAR_MENU.find('a[href="' + CURRENT_URL + '"]').parent('li').addClass('current-page');

    $SIDEBAR_MENU.find('a').filter(function () {
        return this.href == CURRENT_URL;
    }).parent('li').addClass('current-page').parents('ul').slideDown(function() {
        setContentHeight();
    }).parent().addClass('active');

    // recompute content when resizing
    $(window).smartresize(function(){  
        setContentHeight();
    });

    setContentHeight();

    // fixed sidebar
    if ($.fn.mCustomScrollbar) {
        $('.menu_fixed').mCustomScrollbar({
            autoHideScrollbar: true,
            theme: 'minimal',
            mouseWheel:{ preventDefault: true }
        });
    }
});
// /Sidebar

// Panel toolbox
$(document).ready(function() {
    $('.collapse-link').on('click', function() {
        var $BOX_PANEL = $(this).closest('.x_panel'),
            $ICON = $(this).find('i'),
            $BOX_CONTENT = $BOX_PANEL.find('.x_content');
        
        // fix for some div with hardcoded fix class
        if ($BOX_PANEL.attr('style')) {
            $BOX_CONTENT.slideToggle(200, function(){
                $BOX_PANEL.removeAttr('style');
            });
        } else {
            $BOX_CONTENT.slideToggle(200); 
            $BOX_PANEL.css('height', 'auto');  
        }

        $ICON.toggleClass('fa-chevron-up fa-chevron-down');
    });

    $('.close-link').click(function () {
        var $BOX_PANEL = $(this).closest('.x_panel');

        $BOX_PANEL.remove();
    });
});
// /Panel toolbox

// Tooltip
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
});
// /Tooltip

// Switchery
$(document).ready(function() {
    if ($(".js-switch")[0]) {
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        elems.forEach(function (html) {
            var switchery = new Switchery(html, {
                color: '#26B99A'
            });
        });
    }
});
// /Switchery

// iCheck
$(document).ready(function() {
    if ($("input.flat")[0]) {
        $(document).ready(function () {
            $('input.flat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });
    }
});
// /iCheck

// Accordion
$(document).ready(function() {
    $(".expand").on("click", function () {
        $(this).next().slideToggle(200);
        $expand = $(this).find(">:first-child");

        if ($expand.text() == "+") {
            $expand.text("-");
        } else {
            $expand.text("+");
        }
    });
});


(function($,sr){
    // debouncing function from John Hann
    // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
    var debounce = function (func, threshold, execAsap) {
      var timeout;

        return function debounced () {
            var obj = this, args = arguments;
            function delayed () {
                if (!execAsap)
                    func.apply(obj, args);
                timeout = null; 
            }

            if (timeout)
                clearTimeout(timeout);
            else if (execAsap)
                func.apply(obj, args);

            timeout = setTimeout(delayed, threshold || 100); 
        };
    };

    // smartresize 
    jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');

/**
 * script general
 * 
 */

$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

//delete register
$(document).on('click', '.btn-delete', function () {

        var $this = $(this);
        var row = $this.closest('tr');
        $this.attr({'disabled': 'disabled'});
        swal({   
            title: $this.data('confirm-title'),   
            text: $this.data('confirm-text'),   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: $this.data('confirm-delete'),   
            closeOnConfirm: true },
            function(isConfirm){   
                if (isConfirm) {  
                    $.ajax({
                        type: 'POST',
                        url: $this.data('href'),
                        dataType: 'json',
                        data: { 'id': $this.data('id') },
                        success: function (request) {                           
                            if(request.success) {  
                                snackbar_event(request.message, 'deleted');
                            } else {
                                row.addClass('danger');
                                snackbar_event(request.message, 'error');
                            }
                        },
                        error: function () {
                            snackbar_event(request.message, 'error');
                            row.addClass('danger');
                        }
                    });     
            } 
        });
});

//open  create or edit modal
$(document).on('click', '.edit-modal', function () {
    var $this = $(this);
    $.ajax({
        url: $this.data('href'),
        type:'GET',
        success: function(response) {
            if(response.success){
                $('#myModalLabel').html($this.attr('title'));
                $('#content-modal').html(response.view);
                $('#general-modal').modal('show');
            } else {
                notify('error', response.message);
            }
           
        }
    });
});

//save or update form modal
$(document).on('click', '.btn-submit', function (e) {
    var form = $('#form-modal'); 
    e.preventDefault();
    $.ajax({
        url: form.attr('action'),
        type: $('#form-modal input[name="_method"]').val(),
        data: form.serialize(),
        dataType: 'json',
        success: function(response) {
            if(response.success){
                $('#general-modal').modal('hide');
                notify('success', response.message);
                getPages(CURRENT_URL);
            } else {
                notify('error', response.message);
            }
           
        }
    });
});

// search register all
$(document).on('click', '.search', function () {
    var term = $('#search').val();
    var $this = $(this);
    if(term){
        $.ajax({
            url: CURRENT_URL,
            type:"GET",
            data:{ search: term },
            dataType: 'json',
            success: function(response) {
                if(response.success){
                    $('#content-table').html(response.view);
                } else {
                    notify('error', response.message);
                }
            },
            error: function (status) {
                console.log(status);
            }
        });
    } else {
        //
    }
});

$(document).ready(function() {
    $(document).on('click', '.pagination a', function (e) {
        getPages($(this).attr('href'));
        e.preventDefault();
    });
});

function getPages(page) {
    $.ajax({
        url: page,
        type:"GET",
        dataType: 'json',
        success: function(response) {
            if(response.success){
                $('#content-table').html(response.view);
                CURRENT_URL = page;
            }
        },
        error: function (status) {
            console.log(status);
        }
    });
}

function notify(type, message){
    new PNotify({
      text: message,
      type: type,
      hide: true,
      styling: 'bootstrap3'
    });
}
// /script general