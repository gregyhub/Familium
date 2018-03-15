$(function() {
    
    $('.togglec').on('click', function(){
        $('.showcomment').toggle();
        $('.hidecomment').toggle();
        
        //idArticle = $(this).attr('data');
        $(this).parent().next().toggle('slow');
        
    }); //fin de l'event click

});