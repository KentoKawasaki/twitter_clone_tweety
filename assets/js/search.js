$(function(){
    $('.search').keyup((function(){
        let search = $(this).val();
        $.post('http://localhost/tweety/core/ajax/search.php',{search:search}, function(data){
            $('.search-result').html(data);
        })
    }));
});