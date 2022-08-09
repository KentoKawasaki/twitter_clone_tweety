$(function () {
  $(document).on("click", "#messagePopup", function () {
    let getMessages = 1;
    $.post(
      baseURL + "core/ajax/messages.php",
      { showMessage: getMessages },
      function (data) {
        $(".popupTweet").html(data);
      }
    );
  });
});
