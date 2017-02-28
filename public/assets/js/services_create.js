$("#date_search").on("dp.change", function(e) {
    var delivery = new Date(e.date);
    delivery.setDate(delivery.getDate() + 1);
    $("#date_delivery").data('DateTimePicker').date(delivery);
});

$("#check_today").on("ifClicked", function() {
  $('#check_tomorrow').iCheck('uncheck');
  var today1 = today;
  today1.setDate(today1.getDate());
  $("#date_search").data('DateTimePicker').date(today1);
});

$("#check_tomorrow").on("ifClicked", function() {
  $('#check_today').iCheck('uncheck');
  var tomorrow2 = today;
  tomorrow2.setDate(tomorrow.getDate() + 1);
  $("#date_search").data('DateTimePicker').date(tomorrow2);
});

$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}

var add_cart = 0;
var array_packages = [];

function addCart() {
    var packages = '';
    var quantity = '';
    array_packages.forEach(function(value, key) {
      packages += key+',';
      quantity += value+',';
    });
    var time_selected = $('#time_delivery option:selected').val();
    if(add_cart > 0) {
      $.ajax({
          url: url_preview_order,
          type:'GET',
          data: {packages: packages, quantity:quantity, time: time_selected},
          success: function(response) {
              hideLoading();
              if(response.success){
                $('#packages_table').html(response.view);
                total();
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
      $('#packages_table').html('<p>seleccionar paquetes</p>');
    }
}


function total() {
  if(add_cart > 0) { 
  var sum = 0;    
  var container = document.getElementById('list_prices');  
    $("#packages_list tr").each( function() {       
      var price = $(this).find('td:eq(4) span.prices-pack');
      if (price.text() != null) {
        sum += parseFloat(price.text());
      }             
    })   
    $("#total").text(sum.toFixed(2).toString());  
    $("#total_price").val(sum.toFixed(2).toString());
    $("#sub-total").text(sum.toFixed(2).toString()); 
    $("#sub_total_price").val(sum.toFixed(2).toString());
    discount(); 
  }
}   

$(document).on('click', '.addOrder', function () {
  addCart();
});


$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldID = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $('#input-number-'+fieldID);
    var currentVal = parseInt(input.val());

    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > 0) {
                input.val(currentVal - 1);
                add_cart--;
            } 
            if(input.val() == 0) {
              array_packages.splice(fieldID, 1);
            }

        } else if(type == 'plus') {

            if(currentVal < 10) {
                input.val(currentVal + 1);
                array_packages[fieldID] = input.val();
                add_cart++;
            }
        }

    } else {
        input.val(0);
    }
});

$(document).on('change', '#time_delivery', function () {
  if(add_cart > 0) {
    show_price_by_time();
  }
});

$(document).on('click', '.delete-package', function () {
    var row = $(this).closest('tr');
    row.remove();
    add_cart--;
    total();
});

var percentage = 0;
var coupon_validate = false;

$(document).on('click', '.validate', function () {
  var $this = $(this);
  if (add_cart > 0 && $('#coupon').val()) {
      showLoading();
      $.ajax({
        url: url_validate_coupon,
        type:'GET',
        data: {'code': $('#coupon').val() },
        success: function(response) {
            hideLoading();
            if(response.success){
                percentage = response.percentage;
                coupon_validate = true;
                $('#client_coupon_id').val(response.client_coupon_id);
                discount();
                notify('success', response.message);
            } else {
              hideLoading();
              coupon_validate = false;
              notify('error', response.message);
            }
           
        }
    });
  } else {
    if (! $('#coupon').val() ) {
      notify('warning', first_introduce_coupon);
    } else {
      notify('warning', first_select_package);
    }
  }

});

function discount() {
  if(percentage > 0 && coupon_validate) {

    var total = $("#total").text(); 
    discount = total * percentage/100;
    var sub_total = total - discount;

    $("#discount").text('-'+discount.toFixed(2).toString());
    $("#discount-porcentage").text(' ('+percentage+'%)');
    $("#total").text(sub_total.toFixed(2).toString());  
    $("#total_price").val(sub_total.toFixed(2).toString());
    $('.sub-total').show();  
    $('.discount').show();    
    $("#discount_price").val(discount.toFixed(2).toString());  
  }
}  

$(document).on('click', '.select-location', function () {
  var $this = $(this);
  $('.row_location').removeClass('success');
  $this.closest('tr').addClass('success');
  $('#client_location_id').val($this.data('location'));
});
