  $(document).ready(function() {

    $('[data-toggle="popover"]').popover()

    if ($('#category-field').val() != "") {
      $.each($('#category-field').val().split(','), function(key, val) {
        $('[data-id=' + val + ']').addClass('category-label-selected');
      });

      // Now clear out the category hidden form field
      $('#category-field').val('');
    }

  $(".category-label").click(function() {

    if ($(this).hasClass('category-label-selected')) {
      
      $(this).removeClass('category-label-selected');

    } else {

      if ($(".category-label-selected").length < 3) {

        $(this).toggleClass('category-label-selected');

      }

    }

  });

  $("#legionnaire-form").submit(function(e) {
    var catArray = [];
    $('.category-label-selected').each(function(i, obj) {
      catArray.push($(this).data('id'));
    });
    $('#category-field').val(catArray);
  });

  });
