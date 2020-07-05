$('.summernote').summernote();

const url_edit_page = jQuery("#permalink").val();

// Выбор языка 
jQuery(".select_lang_1").change(function () {
  jQuery(".select_lang_1").prop('checked', false);
  jQuery(this).prop('checked', true);
});
jQuery(".select_lang_2").change(function () {
  jQuery(".select_lang_2").prop('checked', false);
  jQuery(this).prop('checked', true);
});

jQuery("#clear_translate_2").click(function () {
  event.preventDefault();
  jQuery(".select_lang_2").prop('checked', false);
});
jQuery("#clear_translate_1").click(function () {
  event.preventDefault();
  jQuery(".select_lang_1").prop('checked', false);
});

// Выбор направления

jQuery(".select_direction").change(function () {
  jQuery(".select_direction").prop('checked', false);
  jQuery(this).prop('checked', true);
});

jQuery("#clear_direction").click(function () {
  event.preventDefault();
  jQuery(".select_direction").prop('checked', false);
});


// Выбор услуги

jQuery("#clear_services").click(function () {
  event.preventDefault();
  jQuery(".select_services").prop('checked', false);
});

// Выбор врача
jQuery(".select_staff").change(function () {
  jQuery(".select_staff").prop('checked', false);
  jQuery(this).prop('checked', true);
});
jQuery("#clear_doc").click(function () {
  event.preventDefault();
  jQuery(".select_staff").prop('checked', false);
});

// Отображение страницы
jQuery(".show_page").click(function () {
  event.preventDefault();
  window.open(URL_FRONT + url_edit_page, '_blank');
});




