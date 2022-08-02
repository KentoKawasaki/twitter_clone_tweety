$(function () {
  $(document).on("click", ".t-show-popup", function () {
    let tweet_id = $(this).data("tweet");
    $.post(
      baseURL + "core/ajax/popUpTweets.php",
      { showPopup: tweet_id },
      function (data) {
        $('.popupTweet').html(data);
        $('.tweet-show-popup-box-cut').click(function(){
          $('.tweet-show-popup-wrap').hide();
        });
      }
    );
  });
});
