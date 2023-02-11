jQuery(document).ready(function($) {


    var selector = $('input[type="tel"]');

    var im = new Inputmask("+7(999) 999-9999");
    im.mask(selector);    

  });