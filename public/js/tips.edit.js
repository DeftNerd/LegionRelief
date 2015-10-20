  $(document).ready(function() {

    $('[data-toggle="popover"]').popover()

    if ($('#category-field').val() != "") {
      $.each($('#category-field').val().split(','), function(key, val) {
        $('[data-id=' + val + ']').toggleClass('category-label-selected');
      });

    }

  $('.category-label').on('click', function() {

    if ($(this).hasClass('category-label-selected')) {
      
      $(this).toggleClass('category-label-selected');

    } else {

      if ($(".category-label-selected").length < 3) {

        $(this).toggleClass('category-label-selected');

      }

    }

  });

  $("#tip-form").submit(function(e) {
    var catArray = [];
    $('.category-label-selected').each(function(i, obj) {
      catArray.push($(this).data('id'));
    });
    $('#category-field').val(catArray);
  });

  });