
$(document).ready(function(){

  //get url hash
  if(window.location.hash){

    //window.location.hash returns hash(#) then the key string, erase hash 
    var hash = (window.location.hash).replace('#','');
    var present = $(this).find("div[id='"+hash+"']");

    if(present){
      present.css({
        'background-color': 'lightblue',
        'border-radius': '12px',
        'transition-duration': '3s',
      });
    }

  }

});