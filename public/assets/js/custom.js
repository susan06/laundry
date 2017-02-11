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

var options_table = {
    retrieve: true,
    "searching": false,
    "paging": false,
    "bInfo": false,
    "language": {
      "emptyTable": lang.no_data_table
    }
};

var table = $('#datatable-responsive').DataTable(options_table); 

$(function() {
    $('#side-menu').metisMenu();
});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }
});

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

/**
 * script general
 * 
 */

$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

//delete register
$(document).on('click', '.btn-delete', function () {
    $('[data-toggle="tooltip"]').tooltip('hide');
    var $this = $(this);
    $this.tooltip('hide');
    //var row = $this.closest('tr');
    swal({   
        title: $this.attr('title'),   
        text: $this.data('confirm-text'),   
        type: "warning",   
        showCancelButton: true,   
        cancelButtonText: lang.cancel,
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: $this.data('confirm-delete'),   
        closeOnConfirm: true },
        function(isConfirm){   
            if (isConfirm) {
                showLoading(); 
                $.ajax({
                    type: 'DELETE',
                    url: $this.data('href'),
                    dataType: 'json',
                    data: { 'id': $this.data('id') },
                    success: function (response) { 
                        hideLoading();                          
                        if(response.success) {  
                            notify('success', response.message);
                            getPages(CURRENT_URL);
                            //row.remove();
                        } else {
                            notify('error', response.message);
                        }
                    },
                    error: function (status) {
                        hideLoading();
                        notify('error', status.statusText);
                    }
                });     
        } 
    });
});

var current_model = null;
var current_title = null;
//open create show or edit in modal or content
$(document).on('click', '.create-edit-show', function () {
    showLoading();
    $('[data-toggle="tooltip"]').tooltip('hide');
    var $this = $(this);
    var title = $this.attr("title");
    current_model = $this.data('model');
    $.ajax({
        url: $this.data('href'),
        type:'GET',
        success: function(response) {
            hideLoading();
            if(response.success){
                if(current_model == 'modal') {
                    $('#modal-title').text(title);
                    $('#content-modal').html(response.view);
                    $('#general-modal').modal('show');
                } else {
                    $('.top_search').hide();
                    $('.btn-create').hide();
                    current_title = $('#content-title').text();
                    $('#content-title').text(title);
                    $('#content-table').html(response.view);
                }
            } else {
                notify('error', response.message);
            }
        },
        error: function (status) {
            hideLoading();
            notify('error', status.statusText);
        }
    });
});
//save or update form modal
$(document).on('click', '.btn-submit', function (e) {
    e.preventDefault();
    showLoading();
    var form = $('#form-modal'); 
    var type = $('#form-modal input[name="_method"]').val();
    if(typeof type == "undefined") {
        type = form.attr('method');
    }
    $.ajax({
        url: form.attr('action'),
        type: type,
        data: form.serialize(),
        dataType: 'json',
        success: function(response) {
            hideLoading();
            if(response.success){
                if(current_model == 'modal') {
                    $('#general-modal').modal('hide');
                } else {
                    if(current_model == 'content' && !response.url_return) {
                        if(response.url_next){
                            $('#content-title').text(response.title_next);
                            getPages(response.url_next);
                        } else {
                            $('#content-title').text(current_title);
                            $('.btn-create').show();
                            $('.top_search').show();
                        }
                    } else {
                        if(response.url_return) {
                            window.location.href = response.url_return;
                            showLoading();
                        }
                    } 
                }
                notify('success', response.message);
                form.get(0).reset();
                getPages(CURRENT_URL);
            } else {
                if(response.validator) {
                  var message = '';
                  $.each(response.message, function(key, value) {
                    message += value+' ';
                  });
                  notify('error', message);
                } else {
                  notify('error', response.message);
                }
            }
           
        },
        error: function (status) {
            hideLoading();
            notify('error', status.statusText);
        }
    });
});
//save suggestion form modal
$(document).on('click', '.btn-submit-suggestion', function (e) {
    e.preventDefault();
    showLoading();
    var form = $('#form-modal-suggestion'); 
    var type = $('#form-modal input[name="_method"]').val();
    if(typeof type == "undefined") {
        type = form.attr('method');
    }
    $.ajax({
        url: form.attr('action'),
        type: type,
        data: form.serialize(),
        dataType: 'json',
        success: function(response) {
            hideLoading();
            if(response.success){
                $('#suggestion-modal').modal('hide');
                notify('success', response.message);
            } else {
                if(response.validator) {
                  var message = '';
                  $.each(response.message, function(key, value) {
                    message += value+' ';
                  });
                  notify('error', message);
                } else {
                  notify('error', response.message);
                }
            }
           
        },
        error: function (status) {
            hideLoading();
            notify('error', status.statusText);
        }
    });
});

//cancel return page old
$(document).on('click', '.btn-cancel', function (e) {
    e.preventDefault();
    getPages(CURRENT_URL);
    $('#content-title').text(current_title);
    $('.btn-create').show();
    $('.top_search').show();
});

//reset search
$(document).on('click', '.search-cancel', function (e) {
    e.preventDefault();
    getPages(CURRENT_URL);
    $('#search').val('');
    $(this).hide();
    loadResposiveTable();
});

// search register all
$(document).on('click', '.search', function () {
    showLoading();
    var term = $('#search').val();
    var $this = $(this);
    $('.search-cancel').show();
    if(term){
        $.ajax({
            url: CURRENT_URL,
            type:"GET",
            data:{ search: term },
            dataType: 'json',
            success: function(response) {
                hideLoading();
                if(response.success){
                    $('#content-table').html(response.view);
                    loadResposiveTable();
                } else {
                    notify('error', response.message);
                }
            },
            error: function (status) {
                hideLoading();
                notify('error', status.statusText);
            }
        });
    } else {
        //
    }
});

// search status all
$(document).on('change', '#status', function () {
    showLoading();
    var $this = $(this);
    $.ajax({
        url: CURRENT_URL,
        type:"GET",
        data:{ status: $this.val() },
        dataType: 'json',
        success: function(response) {
            CURRENT_URL = this.url;
            hideLoading();
            if(response.success){
                $('#content-table').html(response.view);
                loadResposiveTable();
            } else {
                notify('error', response.message);
            }
        },
        error: function (status) {
            hideLoading();
            notify('error', status.statusText);
        }
    });
});

// search branch all
$(document).on('change', '#branch', function () {
    showLoading();
    var $this = $(this);
    $.ajax({
        url: CURRENT_URL,
        type:"GET",
        data:{ branch_office: $this.val() },
        dataType: 'json',
        success: function(response) {
            hideLoading();
            if(response.success){
                $('#content-table').html(response.view);
                loadResposiveTable();
            } else {
                notify('error', response.message);
            }
        },
        error: function (status) {
            hideLoading();
            notify('error', status.statusText);
        }
    });
});


$(document).ready(function() {
    $(document).on('click', '.pagination a', function (e) {
        getPages($(this).attr('href'));
        e.preventDefault();
    });
});

function getPages(page) {
    showLoading();
    $.ajax({
        url: page,
        type:"GET",
        dataType: 'json',
        success: function(response) {
            hideLoading();
            if(response.success){
                $('#content-table').html(response.view);
                loadResposiveTable();
                CURRENT_URL = page;
            }
        },
        error: function (status) {
            hideLoading();
            console.log(status.statusText);
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

// datatable-responsive
function loadResposiveTable() {
    table.destroy();
    table = $('#datatable-responsive').DataTable(options_table);
}

$(document).on('change', '#file_image', function () { 
    showLoading();
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image_upload').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }
    hideLoading();
});

$(document).on('click', '.send-suggestions', function () {
    $('#suggestion-modal').modal('show');
});

function showLoading() {
    $('#loading').addClass('is-active');
}

function hideLoading() {
    $('#loading').removeClass('is-active'); 
}

$(document).ready(function() {

  $('form').keypress(function(e){   
    if(e == 13){
      return false;
    }
  });

  $('input').keypress(function(e){
    if(e.which == 13){
      return false;
    }
  });

});
// /script general