$(function () {
 
  $("#rateYo").rateYo({
    rating: 3.6
  });
 
  $("#rateYo").rateYo()
  .on("rateyo.set", function (e, data) {

    id = $("#idtbl_obras").val();
    $.post('http://127.0.0.1:8000/api/calificar',{id:id,star:data.rating},function(match){
    if(match)
    {
      alert("Gracias Por calificarnos");
    }
    });
  });
});