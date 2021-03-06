$("#data1").DataTable({
  'paging'      : true,
  'lengthChange': false,
  'searching'   : true,
  'ordering'    : false,
  'info'        : false,
  'autoWidth'   : false
})

$('#datepicker').datepicker({
  autoclose: true,
  format: 'dd-mm-yyyy',
})