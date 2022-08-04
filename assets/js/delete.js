$(function () {
  $(document).on('click', '.deleteTweet', function(){
    let tweet_id = $(this).data('tweet');
    $.post(baseURL + 'core/ajax/deleteTweet.php', {showPopup:tweet_id},function(data){
      $('.popupTweet').html(data);
      $('.close-retweet-popup, .cancel-it').click(function(){
        $('.retweet-popup').hide();
      });

      $(document).on('click', '.delete-it', function(){
        $.post(baseURL + 'core/ajax/deleteTweet.php', {deleteTweet:tweet_id}, function(){
          $('.retweet-popup').hide();
          location.reload();
        });
      });
    });
  });

  $(document).on("click", ".deleteComment", function () {
    let comment_id = $(this).data("comment");
    let tweet_id = $(this).data("tweet");

    $.post(
      baseURL + "core/ajax/deleteComment.php",
      { deleteComment: comment_id },
      function (data) {
        $.post(
          baseURL + "core/ajax/popUpTweets.php",
          { showPopup: tweet_id },
          function (data) {
            $(".popupTweet").html(data);
            $(".tweet-show-popup-box-cut").click(function () {
              $(".tweet-show-popup-wrap").hide();
            });
          }
        );
      }
    );
  });
});
