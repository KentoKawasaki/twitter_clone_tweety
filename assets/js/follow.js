$(function () {
  $(".follow-btn").click(function () {
    let follow_id = $(this).data("follow");
    let button = $(this);

    if (button.hasClass("following-btn")) {
      $.post(baseURL + "core/ajax/followingFollowers.php", {unfollow:follow_id}, function(data){
        data = JSON.parse(data);
        button.removeClass("following-btn");
        button.removeClass("unfollow-btn");
        button.html('<i class="fa fa-user-plus"></i>Follow');
        $('.count-following').text(data.following);
        $('.count-followers').text(data.followers);
      });
    } else {
      $.post(baseURL + "core/ajax/followingFollowers.php", {follow:follow_id}, function(data){
        data = JSON.parse(data);
        button.removeClass("follow-btn");
        button.addClass("following-btn");
        button.html('Following');
        $('.count-following').text(data.following);
        $('.count-followers').text(data.followers);
      });
    }
  });

  $('.follow-btn').hover(function(){
    let button = $(this);

    if(button.hasClass('following-btn')){
      button.addClass('unfollow-btn');
      button.text('Unfollow');
    }
  }, function(){
    let button = $(this);

    if(button.hasClass('following-btn')){
      button.removeClass('unfollow-btn');
      button.text('Following');
    }
  });
});
