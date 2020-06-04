
$(document).ready(function(){

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });


/********
Like
********/   
  //store like
  $(document).on('click', '.like', function(){

    // click more than once return false
    $(this).click(function() {
      return false;
    });

    var id = $(this).find('#like').val();

   $.post('/comment/like', { _method: 'post', comment_id: id})
      .done( function(msg) { 
        $('#comment').load(location.href + ' #comment'); 
        console.log('like success');
        //console.log(msg.comment_id) 
      })
      .fail( function(xhr, textStatus, errorThrown) {
          alert('oops, it seems we got error.' + xhr.responseText);
      });

  });


  //delete
  $(document).on('click', '.unlike', function(){

  
   // click more than once return false
    $(this).click(function() {
      return false;
    });
    var id = $(this).find('#unlike').val();

   $.post('/comment/like/delete/'+id, { _method: 'delete'})
      .done( function(msg) { 
        $('#body').load(location.href + ' #body'); 
        console.log('delete success');
        console.log(msg.like_id); 
      })
      .fail( function(xhr, textStatus, errorThrown) {
          alert('oops, it seems we got error.' + xhr.responseText);
      });

});

});
