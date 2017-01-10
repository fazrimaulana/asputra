Pusher OK<br>
<p>{{ $count }}</p>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://js.pusher.com/3.2/pusher.js"></script>
<script>
/*Pusher.logToConsole = true;*/

var pusher = new Pusher('{{env("PUSHER_KEY")}}');
var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data){
  	console.log(data.message);
    $("p").replaceWith("<p>"+data.message+"</p>"); 
});


</script>