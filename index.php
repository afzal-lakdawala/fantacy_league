<!doctype html>
<html lang="en">
<head>
 
<title>Politics Fantasy League</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>

<style>
.list_element
{
	border:2px solid;
	border-radius:15px;
	padding:4px;
	z-index:5;
	width:250px;
}


#nda
{
	position:absolute;
	top:33px;
	left:74px;
}

#upa
{
	position:absolute;
	top:33px;
	left:413px;
}

#alt
{
	position:absolute;
	top:33px;
	left:707px;
}

#other
{
	position:absolute;
	top:33px;
	left:1035px;
}

#nda_list
{
	border:2px solid; 
	border-radius:25px; 
	width:270px; 
	padding:8px; 
	height:500px; 
	overflow-x:hidden;
	overflow-y:auto;
	position:absolute;
	top:20px;
	left:20px;
	z-index:2;
	padding-top:50px;
}

#upa_list
{
	border:2px solid; 
	border-radius:25px; 
	width:270px; 
	padding:8px; 
	height:500px; 
	overflow-x:hidden;
	overflow-y:auto;
	position:absolute;
	top:20px;
	left:350px;
	z-index:2;
	padding-top:50px;
}

#alternate_front_list
{
	border:2px solid; 
	border-radius:25px; 
	width:270px; 
	padding:8px; 
	height:500px; 
	overflow-x:hidden;
	overflow-y:auto;
	position:absolute;
	top:20px;
	left:670px;
	z-index:2;
	padding-top:50px;
}

#other_list
{
	border:2px solid; 
	border-radius:25px; 
	width:270px; 
	padding:8px; 
	height:500px; 
	overflow-x:hidden;
	overflow-y:auto;
	position:absolute;
	top:20px;
	left:980px;
	z-index:2;
	padding-top:50px;
}
</style>
 
<script type="text/javascript">
 
// JavaScript will go here

var nda_seat_sum = 0;
var upa_seat_sum = 0;
var alt_seat_sum = 0;
var other_seat_sum = 0;

$(document).ready(function(){

	d3.json("parties.json", function(error, result){
		for(var i = 0; i < result.parties.length; ++i){
			if(result.parties[i].seats > 0){
				if(result.parties[i].default_alliance == "NDA"){
					$('<div class="list_element">' + result.parties[i].name + " (Seats: " + result.parties[i].seats + ")" + '</div>').data( 'seats', result.parties[i].seats ).attr( 'id', result.parties[i].code ).appendTo( '#nda_list' ).draggable( {
						  helper:	function () { return $(this).clone().appendTo('#content').css('zIndex',5).show(); },
					      containment: '#content',
					      stack: '#nda_list div',
					      cursor: 'move',
					      revert: true
				    } )
				    .css('background-color' , result.parties[i].color);	
				    nda_seat_sum += result.parties[i].seats;
				}
				else if(result.parties[i].default_alliance == "UPA"){
					$('<div class="list_element">' + result.parties[i].name + " (Seats: " + result.parties[i].seats + ")"  + '</div>').data( 'seats', result.parties[i].seats ).attr( 'id', result.parties[i].code ).appendTo( '#upa_list' ).draggable( {
						  helper:	function () { return $(this).clone().appendTo('body').css('zIndex',5).show(); },
					      containment: '#content',
					      stack: '#upa_list div',
					      cursor: 'move',
					      revert: true
				    } )
				    .css('background-color' , result.parties[i].color);
				    upa_seat_sum += result.parties[i].seats;
				}
				else if(result.parties[i].default_alliance == "Alternate Front"){
					$('<div class="list_element">' + result.parties[i].name + " (Seats: " + result.parties[i].seats + ")"  + '</div>').data( 'seats', result.parties[i].seats ).attr( 'id', result.parties[i].code ).appendTo( '#alternate_front_list' ).draggable( {
						  helper:	function () { return $(this).clone().appendTo('body').css('zIndex',5).show(); },
					      containment: '#content',
					      stack: '#alternate_front_list div',
					      cursor: 'move',
					      revert: true
				    } )
				    .css('background-color' , result.parties[i].color);
				    alt_seat_sum += result.parties[i].seats;
				}
				else if(result.parties[i].default_alliance == "Other"){
					$('<div class="list_element">' + result.parties[i].name + " (Seats: " + result.parties[i].seats + ")"  + '</div>').data( 'seats', result.parties[i].seats ).attr( 'id', result.parties[i].code ).appendTo( '#other_list' ).draggable( {
						  helper:	function () { return $(this).clone().appendTo('body').css('zIndex',5).show(); },
					      containment: '#content',
					      stack: '#other_list div',
					      cursor: 'move',
					      revert: true
				    } )
				    .css('background-color' , result.parties[i].color);
				    other_seat_sum += result.parties[i].seats;
				}
			}
		}
	$('#nda').text('NDA (Total seats: ' + nda_seat_sum + ')');
	$('#upa').text('UPA (Total seats: ' + upa_seat_sum + ')');
	$('#alt').text('Alternate Front (Total seats: ' + alt_seat_sum + ')');
	$('#other').text('Others (Total seats: ' + other_seat_sum + ')');	});



	$('#nda_list').html('');
	$('#upa_list').html('');
	$('#alternate_front_list').html('');
	$('#other_list').html('');

$('#nda_list').droppable( {
      accept: '#upa_list div, #alternate_front_list div, #other_list div, #nda_list div',
      hoverClass: 'hovered',
      drop: handleNameDrop
 });

$('#upa_list').droppable( {
      accept: '#nda_list div, #alternate_front_list div, #other_list div, #upa_list div',
      hoverClass: 'hovered',
      drop: handleNameDrop
 });

$('#alternate_front_list').droppable( {
      accept: '#upa_list div, #nda_list div, #other_list div, #alternate_front_list div',
      hoverClass: 'hovered',
      drop: handleNameDrop
 });

$('#other_list').droppable( {
      accept: '#upa_list div, #alternate_front_list div, #nda_list div, #other_list div',
      hoverClass: 'hovered',
      drop: handleNameDrop
 });

$('#content').droppable( {
	   accept: '#upa_list div, #alternate_front_list div, #nda_list div, #other_list div',
      hoverClass: 'hovered',
      drop: handleNameDrop
});


function handleNameDrop(event, ui){
	var id = ui.draggable[0].id;
	var parent_id = ui.draggable[0].parentNode.id;
	var dest_id = $(this)[0].id;

	if(dest_id == 'content')
		dest_id = parent_id;

	ui.draggable.draggable( 'option', 'revert', false );
	$(ui.helper).remove();

	$('#' + parent_id).remove(id);
	//$('#' + id).appendTo('#' + dest_id).attr('id', id);
	$('#' + id).appendTo('#' + dest_id).draggable({
		revert: true,
		helper:	function () { return $(this).clone().appendTo('body').css('zIndex',5).show(); }
	});

	var num_seats = $('#' + id).data('seats');
	if(parent_id == 'nda_list')
		nda_seat_sum -= num_seats;
	else if(parent_id == 'upa_list')
		upa_seat_sum -= num_seats;
	else if(parent_id == 'alternate_front_list')
		alt_seat_sum -= num_seats;
	else if(parent_id == 'other_list')
		other_seat_sum -= num_seats;

	if(dest_id == 'nda_list')
		nda_seat_sum += num_seats;
	else if(dest_id == 'upa_list')
		upa_seat_sum += num_seats;
	else if(dest_id == 'alternate_front_list')
		alt_seat_sum += num_seats;
	else if(dest_id == 'other_list')
		other_seat_sum += num_seats;

	$('#nda').text('NDA (Total seats: ' + nda_seat_sum + ')');
	$('#upa').text('UPA (Total seats: ' + upa_seat_sum + ')');
	$('#alt').text('Alternate Front (Total seats: ' + alt_seat_sum + ')');
	$('#other').text('Others (Total seats: ' + other_seat_sum + ')');
}

});

</script>
 
</head>
<body>
 
<div id="content" style="height:700px">
 
  <div id="nda_list"> </div><br/><br/><br/>
  <div id="upa_list"> </div><br/><br/><br/>
  <div id="alternate_front_list"> </div><br/><br/><br/>
  <div id="other_list"> </div><br/><br/><br/>

  <div id="nda"> </div><br/><br/>
  <div id="upa"> </div><br/><br/>
  <div id="alt"> </div><br/><br/>
  <div id="other"> </div><br/><br/>


</div>
 
</body>
</html>