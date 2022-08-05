$(function () {
  let win = $(window);
  let offset = 10;

  win.scroll(function () {
    if ($(document).height() <= win.height() + win.scrollTop()) {
      offset += 10;
      $.post(
        baseURL + "core/ajax/fetchPosts.php",
        { fetchPosts: offset },
        function (data) {
          if(data !== null){
            $("#loader").show();
            $('.tweets').html(data);
            $('#loader').hide();
          }
        }
      );
    }
  });
});
