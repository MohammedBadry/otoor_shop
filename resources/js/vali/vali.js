require('./bootstrap');
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

const lang = document.documentElement.lang.substr(0, 2);

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-Accept-Language'] = lang;

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': token.content,
      'X-Accept-Language': lang
    }
  });
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

import Vue from 'vue';
import VueInternationalization from 'vue-i18n';
import Locale from '../../js/vue-i18n-locales.generated';
import FileUploader from 'laravel-file-uploader';

Vue.use(FileUploader);
Vue.use(VueInternationalization);

// or however you determine your current app locale

const i18n = new VueInternationalization({
  locale: lang,
  messages: Locale
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('select2', require('../components/Select2Component').default);
Vue.component('custom-field-select', require('../components/CustomFieldSelectComponent').default);
Vue.component('sizes-component', require('../components/SizesComponent').default);

const app = new Vue({
  el: '#app',
  i18n
});

(function ($) {

  $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
  $('#flash-overlay-modal').modal();

  $('.nav-sidebar .nav-treeview .nav-item .active').each((index, el) => {
    $(el).closest('.has-treeview').addClass('menu-open');
  });

})(jQuery);

(function () {
  "use strict";

  var Inputmask = require('inputmask').default;
  // $('.price').mask('9999.999');
  // $(".price").inputmask({ alias : "currency", prefix: '₱ ' });
  Inputmask().mask(document.querySelectorAll("input"));


  var treeviewMenu = $('.app-menu');

  // Toggle Sidebar
  $('[data-toggle="sidebar"]').click(function (event) {
    event.preventDefault();
    $('.app').toggleClass('sidenav-toggled');
  });

  // Activate sidebar treeview toggle
  $("[data-toggle='treeview']").click(function (event) {
    event.preventDefault();
    if (!$(this).parent().hasClass('is-expanded')) {
      treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
    }
    $(this).parent().toggleClass('is-expanded');
  });

  // Set initial active toggle
  $("[data-toggle='treeview.'].is-expanded").parent().toggleClass('is-expanded');

  //Activate bootstrip tooltips
  $("[data-toggle='tooltip']").tooltip();

  $('.treeview-item.active').closest('ul.treeview-menu').closest('li.treeview').addClass('is-expanded');

})();


// Initialization
$(function () {

  toastr.options.rtl = $('html').attr('dir') === 'rtl';

  //Date range picker
  $('#reservation').daterangepicker();
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({
    timePicker: true,
    timePickerIncrement: 30,
    locale: {
      format: 'MM/DD/YYYY hh:mm A'
    }
  });
  //Date range as a button
  $('#daterange-btn').daterangepicker(
    {
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate: moment()
    },
    function (start, end) {
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
  );

  // Timepicker
  $('#timepicker').datetimepicker({
    format: 'LT'
  })

  //Bootstrap Duallistbox
  $('.duallistbox').bootstrapDualListbox()

  // Tags input
  $('.tags').tagsinput({
    tagClass: function () {
      return 'badge badge-primary';
    }
  })

  // //Colorpicker
  $('.my-colorpicker1').colorpicker()
  // //color picker with addon
  $('.my-colorpicker2').colorpicker()

  $('.my-colorpicker2').on('colorpickerChange', function (event) {
    $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
  });

  $(function () {
    // Summernote
    $('.textarea').summernote({
      height: 300,
      callbacks: {
        onImageUpload: function (files, editor, welEditable) {
          console.log(files[0], this);
        }
      },
      placeholder: 'Start typing your text...',
      toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['ltr', 'rtl']],
        ['insert', ['link', 'picture', 'video', 'hr']],
        ['view', ['fullscreen', 'codeview']]
      ]
    });
  });
  // Hide filter popover on click outside
  $(document).on('click', 'body', (e) => {
    //did not click a popover toggle or popover
    let isBtn = e.target == $('#filter-popover')[0]
      || e.target.innerHTML == $('#filter-popover').html();
    if (!isBtn && $(e.target).parents('.popover').length === 0) {
      $('#filter-popover').popover('hide');
    }
  });
  $(document).on('click', '.slider .items > li[data-src]', function (event) {
    event.preventDefault();
    $(this).closest('.items').find('li.active').removeClass('active');
    $(this).addClass('active');
    $(this).closest('.slider').find('.preview img').attr('src', $(this).data('src'));
  })
});
