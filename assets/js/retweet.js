$(function () {
  $(document).on("click", ".retweet", function () {
    let tweet_id = $(this).data("tweet");
    let user_id = $(this).data("user");
    let counter = $(this).find(".retweetsCounter");
    let count = counter.text();
    let button = $(this);

    $.post(
      baseURL + "core/ajax/retweet.php",
      { showPopup: tweet_id, user_id: user_id },
      function (data) {
        $(".popupTweet").html(data);
        $('.close-retweet-popup').click(function(){
          $('.retweet-popup').hide();
        });
      }
    );
  });
});
