
$(document).ready(function(){

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });


  /********
  Comment
  ********/   
  $(document).on('click', '#comment_submit', function(){

    //prevent illegal clicks
      $(this).attr('disabled','disabled').hide(50);
    
  var post_id = $(this).find("input[type='hidden']").val();
  var description = $('#description').val();
 

  $.post('/blog/comment/store/'+post_id, { _method: 'post', post_id: post_id, description : description})
        .done( function(msg) { 
          
          $('#comment').load(location.href + ' #comment'); 

          console.log(msg.store); 
          
          $('#comment_submit').show().attr('disabled',false);
        })
        .fail( function(xhr, textStatus, errorThrown) {
          console.log(xhr.responseText);
          if(xhr.responseJSON.errors.description){
             $('#description').addClass('is-invalid');  
          }

          $('#comment_submit').show().attr('disabled',false);

          //encountered error: 
             //422 status code: if the incoming request was an ajax request, no redirect will be generated. 
             //Instead, an HTTP response with a 422 code will be return in the browser containing a JSON representation of the vaidation error.
             //console.log(xhr.responseJSON.message); 
        });
  });


});

