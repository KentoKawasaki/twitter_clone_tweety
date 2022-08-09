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
  $(document).on('click', '.people-message', function(){
    let get_id = $(this).data('user');

    $.post(baseURL + 'core/ajax/messages.php', {showChatPopup:get_id}, function(data){
      $('.popupTweet').html(data);
    });

    $.post(baseURL + 'core/ajax/messages.php', {showChatMessage:get_id}, function(data){
      $('.main-msg-inner').html(data);
    });
  });
});
