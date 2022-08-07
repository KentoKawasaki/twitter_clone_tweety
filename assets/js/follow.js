$(function () {
  $(".follow-btn").click(function () {
    let follow_id = $(this).data("follow");
    let button = $(this);

    if ($button.hasClass("following-btn")) {
      $.post(baseURL + "core/ajax/follow.php", {unfollow:follow_id}, function(data){
        data = JSON.parse(data);
        button.removeClass("following-btn");
        button.removeClass("unfollowing-btn");
        button.html('<i class="fa fa-user-plus"></i>Follow');
        $('.count-following').text(data.following);
        $('.count-followers').text(data.followers);

      });
    } else {
    }
  });
});
