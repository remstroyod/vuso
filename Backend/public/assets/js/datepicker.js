$(function() {
  'use strict';

  if($('#datePicker').length) {
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    $('#datePicker').datepicker({
      format: "yyyy-mm-dd",
      todayHighlight: true,
      autoclose: true
    });
    ///$('#datePicker').datepicker('setDate', today);
  }

  if($('#yearPicker').length) {
    $('#yearPicker').datepicker({
      format: "yyyy",
      changeYear: true,
      showButtonPanel: true,
      autoclose: true
    });
    ///$('#datePicker').datepicker('setDate', today);
  }

  if($('#datePickerTime').length) {
    $('#datePickerTime').datepicker({
      format: "yyyy-mm-dd",
      todayHighlight: true,
      autoclose: true,
    });
  }

});
