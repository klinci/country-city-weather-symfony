// Animation JQuery
// $( "#fade" ).hide();
// $( "#slide" ).hide();
// $( "#fold" ).hide();
// $( "#bounce" ).hide();
// $( "#pulsate" ).hide();
// $( "#blind" ).hide();

$('#addbtn').click(function() {
	$( "#newDiv" ).show( "slide", 1000 );
});
$('#removeWidget').click(function() {
	$( "#newDiv" ).hide( "slide", 1000 );
});
setTimeout(function() {
	$( "#slide" ).show( "slide", 1000 );
}, 1000);
setTimeout(function() {
	$( "#fade" ).show( "fade", 1000 );
}, 800);

setTimeout(function() {
	$( "#fold" ).show( "fold", 1000 );
}, 800);

setTimeout(function() {
	$( "#bounce" ).show( "bounce", 1000 );
}, 800);

setTimeout(function() {
	$( "#pulsate" ).show( "pulsate", 1000);
}, 800);

setTimeout(function() {
	$( "#blind" ).show( "blind", 1000 );
}, 800);


setTimeout(function() {
	$( "#error" ).show( "pulsate", 1000);
}, 800);

setTimeout(function() {
	$( "#error" ).hide( "fade", 1000);
}, 7000);

setTimeout(function() {
	$( "#success" ).show( "fade", 1000);
}, 800);

setTimeout(function() {
	$( "#success" ).hide( "fade", 1000);
}, 7000);


// End Animation JQuery		