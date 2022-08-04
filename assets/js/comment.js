$(function () {
    $(document).on('click', '#postComment', function(){
        let comment = $('#commentField').val();
        let tweet_id = $('#commentField').data('tweet');

        if(comment !== ""){
            $.post(baseURL + "core/ajax/comment.php", {comment: comment, tweet_id:tweet_id}, function(data) {
                $('#comments').html(data);
                $('#commentField').val("");
            });
        }
    });
});
