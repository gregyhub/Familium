$(function() {
    
    $('.showcomment').on('click', function(){
        $(this).html('afficher les commentaires');
        if($(this).next().css('display') == 'none'){
            $(this).html('masquer les commentaires');
        }
        //idArticle = $(this).attr('data');
        $(this).next().toggle('slow');
        
    }); //fin de l'event click

});