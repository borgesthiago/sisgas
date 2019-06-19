$('.ui.dropdown')
  .dropdown()
;
$('.ui.checkbox')
  .checkbox()
;
$('.encaminhar.modal')
  .modal('attach events', '.encaminhar.button', 'show')
;
$('.message .close')
  .on('click', function() {
    $(this)
      .closest('.message')
      .transition('fade')
    ;
  })
;