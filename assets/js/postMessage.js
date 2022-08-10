$(function(){
    $(document).on('click', '#send', function(){
        let message = $('#msg').val();
        let get_id = $(this).data('user');

        $.post(baseURL + 'core/ajax/messages.php', {sendMessage:message, get_id:get_id}, function(data){
            getMessages();
            $('#msg').val('');
        });
    })
})