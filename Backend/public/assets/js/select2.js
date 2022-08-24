$(function() {
  'use strict'

  if ($(".js-example-basic-single").length) {
    $(".js-example-basic-single").select2();
  }
  if ($(".js-example-readonly").length) {
    $(".js-example-readonly").select2({
      disabled: true
    });
  }
  if ($(".js-example-basic-multiple").length) {
    $(".js-example-basic-multiple").select2({
      width: '100%'
    });
  }
  if ($(".js-example-basic-multiple-tags").length) {
    $(".js-example-basic-multiple-tags").select2({
      width: '100%',
      tags: true,
      tokenSeparators: [',']
    });
  }
});
