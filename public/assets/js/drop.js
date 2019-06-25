$('.ui.dropdown')
  .dropdown()
;
$('.ui.checkbox')
  .checkbox()
;
$('.encaminhar.modal')
  .modal({
    blurring: true
  })
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