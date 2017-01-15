function add_working_time() {

  $('#shedules_table').show();

  var tr    = document.createElement("TR");

  var select = document.createElement("select");
  var td    = document.createElement("TD");

  select.name  = 'shedules[]';
  select.className = 'form-control',
  $.each(working_hours, function(index, item) { 
    var option = document.createElement("option");
    option.value = item.id;
    option.text = item.interval;
    select.appendChild(option);
  });

  var input = document.createElement("input");
  input.type  = 'hidden';
  input.name  = 'shedule_id[]';
  input.value = 0;

  var td1    = document.createElement("TD");

  button               = document.createElement('button');
  button.className     = 'btn btn-round btn-danger delete-shedule';

  var icon               = document.createElement('i');
  icon.style.cursor  = 'pointer';
  icon.className     = 'fa fa-trash';
  
  button.appendChild(icon);

  td.appendChild(select);
  td.appendChild(input);
  td1.appendChild(button);

  tr.appendChild(td); 
  tr.appendChild(td1); 

  container = document.getElementById('shedules_list');
  container.appendChild(tr); 
}


$(document).on('click', '.delete-shedule', function () {
    var row = $(this).closest('tr');
    row.remove();
});
