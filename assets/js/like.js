$(function () {
  $(document).on("click", ".like-btn", function () {
    let tweet_id = $(this).data("tweet");
    let user_id = $(this).data("user");
    let counter = $(this).find(".likesCounter");
    let count = counter.text();
    let button = $(this);

    $.post(
      baseURL+"core/ajax/like.php",
      { like: tweet_id, user_id: user_id },
      function () {
        counter.show();
        button.addClass("unlike-btn");
        button.removeClass("like-btn");
        count++;
        counter.text(count);
        button.find(".fa-heart-o").addClass("fa-heart");
        button.find(".fa-heart").removeClass("fa-heart-o");
      }
    );
  });

  $(document).on("click", ".unlike-btn", function () {
    let tweet_id = $(this).data("tweet");
    let user_id = $(this).data("user");
    let counter = $(this).find(".likesCounter");
    let count = counter.text();
    let button = $(this);

    $.post(
      baseURL+"core/ajax/like.php",
      { unlike: tweet_id, user_id: user_id },
      function () {
        counter.show();
        button.addClass("like-btn");
        button.removeClass("unlike-btn");
        count--;
        if(count === 0){
          counter.hide();
        }else{
          counter.text(count);
        }
        button.find(".fa-heart").addClass("fa-heart-o");
        button.find(".fa-heart-o").removeClass("fa-heart");
      }
    );
  });
});
