$(function() {

          $('#article_category').on('change', function(){
              var category = $(this).val();
              console.log(category);
              $.ajax({
                  url:'/ajax/category',
                  type: "POST",
                  dataType: "json",
                  async: true,
                  data:{
                      'category': category
                  },
                  success: function (data){
                      console.log(data);
                      //$('div#ajax-results').html(data.output);
                  }, 
                  error : function(xhr, textStatus, errorThrown) {  

              console.log(xhr); 
              console.log(textStatus); 
              console.log(errorThrown ); 
             }  
              });
          });

      });