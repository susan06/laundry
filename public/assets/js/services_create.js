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

var add_cart = 0;

function add_package(package, prices) {

   $('#packages_table').show();

    var input = document.createElement("input");
    var tr    = document.createElement("TR");
    var td    = document.createElement("TD");  

    var text_name = document.createTextNode(package.name); 

    input.type  = 'hidden';
    input.name  = 'packages[]';
    input.value = package.name;

    td.appendChild(input);
    td.appendChild(text_name);

    var td1    = document.createElement("TD"); 
    var text_category = document.createTextNode($('#category option:selected').text()); 
    td1.appendChild(text_category);

    var td2    = document.createElement("TD"); 

    $.each(prices, function(index, item) { 
      var span    = document.createElement("span"); 
      span.className = 'prices list_price_'+item.delivery_schedule;
      var price = document.createTextNode(item.price); 
      span.appendChild(price);    
      td2.appendChild(span);  

      var input_price = document.createElement("input");
      input_price.type  = 'hidden';
      input_price.name  = 'prices_'+item.delivery_schedule+'[]';
      input_price.value = item.price;
      td2.appendChild(input_price);             
    });

    var td3    = document.createElement("TD");

    button               = document.createElement('button');
    button.className     = 'btn btn-round btn-danger btn-md delete-package';

    var icon               = document.createElement('i');
    icon.style.cursor  = 'pointer';
    icon.className     = 'fa fa-trash';
    
    button.appendChild(icon);
    td3.appendChild(button);

    tr.appendChild(td); 
    tr.appendChild(td1); 
    tr.appendChild(td2);
    tr.appendChild(td3);  

    container = document.getElementById('packages_list');
    container.appendChild(tr); 

    add_cart++;
    show_price_by_time();
};

function show_price_by_time(){
    var time_selected = $('#time_delivery option:selected').val();
    if(time_selected) {
      $('.prices').hide();
      $('.list_price_'+time_selected).show();
    }  
    if(add_cart > 0) {
      total();
    }
}

function total() {
  if(add_cart > 0) {
  var time_selected = $('#time_delivery option:selected').val();  
  var sum = 0;    
  var container = document.getElementById('list_prices');  
    $("#packages_list tr").each( function() {       
      var price = $(this).find('td:eq(2) span.list_price_'+time_selected);
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

$(document).on('click', '.add-cart', function () {
  var $this = $(this);
  $this.addClass('not_clic');
  $this.closest('.thumbnail').addClass('thumbnail-green');
  $.ajax({
      url: url_package_get_details,
      type:'GET',
      data: {'id': $this.attr('id') },
      success: function(response) {
          if(response.success){
              notify('success', package_added);
              add_package(JSON.parse(response.details), JSON.parse(response.prices));
          } else {
              $this.removeClass('not_clic');
              $this.closest('.thumbnail').removeClass('thumbnail-green');
              notify('error', response.message);
          }
         
      }
  });
});

$(document).on('change', '#category', function () {
  var $this = $(this);
  var time_select = $('#time_delivery option:selected').val();
  if($this.val()) {
    showLoading();
    $.ajax({
        url: url_package_show_category,
        type:'GET',
        data: {'category': $this.val(), 'time_select': time_select },
        success: function(response) {
            hideLoading();
            if(response.success){
                $('#modal-title').text($('#category option:selected').text());
                $('#content-modal').html(response.view);
                $('#general-modal').modal('show');
                
            } else {
              hideLoading();
              notify('error', response.message);
            }
           
        }
    });
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
