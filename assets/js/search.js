$(function(){
    $('.search').keyup((function(){
        let search = $(this).val();
        $.post(baseURL+'core/ajax/search.php',{search:search}, function(data){
            $('.search-result').html(data);
        })
    }));

    $(document).on('keyup', '.search-user', function(){
        $('.message-recent').hide();
        let search = $(this).val();

        $.post(baseURL + 'core/ajax/searchUserInMsg.php', {search:search}, function(data){
            $('.message-body').html(data);
        });
    });
});