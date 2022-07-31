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
        $(".close-retweet-popup").click(function () {
          $(".retweet-popup").hide();
        });
      }
    );

    $(document).on("click", ".retweet-it", function () {
      let comment = $(".retweetMsg").val();
  
      $.post(baseURL + "core/ajax/retweet.php", {retweet:tweet_id, user_id:user_id, comment:comment}, function(){
        $('.retweet-popup').hide();
        count++;
        counter.text(count);
        button.removeClass('retweet').addClass('retweeted');
      });
    });
  });

  
});
