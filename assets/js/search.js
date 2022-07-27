$(function(){
    $('.search').keyup((function(){
        let search = $(this).val();
        $.post(baseURL+'core/ajax/search.php',{search:search}, function(data){
            $('.search-result').html(data);
        })
    }));
});