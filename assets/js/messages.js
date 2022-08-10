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
  $(document).on("click", ".people-message", function () {
    let get_id = $(this).data("user");

    $.post(
      baseURL + "core/ajax/messages.php",
      { showChatPopup: get_id },
      function (data) {
        $(".popupTweet").html(data);
        if (autoscroll) {
          scrolldown();
        }

        $("#chat").on("scroll", function () {
          if ($(this).scrollTop() < window.innerHeight - $(this).height()) {
            autoscroll = false;
          } else {
            autoscroll = true;
          }
        });
        $('.close-msgPopup').click(function(){
          clearInterval(timer);
        });
      }
    );

    globalThis.getMessages = function () {
      $.post(
        baseURL + "core/ajax/messages.php",
        { showChatMessage: get_id },
        function (data) {
          $(".main-msg-inner").html(data);
          if (autoscroll) {
            scrolldown();
          }

          // console.log(window.innerHeight);
          $("#chat").on("scroll", function () {
            if ($(this).scrollTop() < window.innerHeight - $(this).height()) {
              autoscroll = false;
            } else {
              autoscroll = true;
            }
          });
          $('.close-msgPopup').click(function(){
            clearInterval(timer);
          });
        }
      );
    };

    let timer = setInterval(getMessages, 5000);
    getMessages();

    autoscroll = true;

    const scrolldown = function () {
      // console.log($("#chat"));
      $("#chat").scrollTop($("#chat")[0].scrollHeight);
    };

    $(document).on("click", ".back-messages", function () {
      let getMessages = 1;
      $.post(
        baseURL + "core/ajax/messages.php",
        { showMessage: getMessages },
        function (data) {
          $(".popupTweet").html(data);
          clearInterval(timer);
        }
      );
    });
  });
});
