<html>
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<title>LifeFLOW</title>
</head>
<body>
<p><a href="/" id="logo" rel="home" title="Home"><img alt="LifeWOW" src="img/LifeWOW.png" />LifeFLOW<img alt="Hearts" src="img/hearts.svg" width="60"></a><a href="#About">About LifeFLOW! :)</a> - <a href="#Music">Choose Your Music! :)</a></p>
<!--?xml version="1.0" encoding="UTF-8" standalone="no"?-->

<table border="0" cellpadding="1" cellspacing="1" style="width: 600px;">
	<tbody>
		<tr>
			<td>
			
			<div id="svgContainerCreatures">
			</div>


			<div id="svgContainerUI">
			</div>
			
			
			<svg xmlns="http://www.w3.org/2000/svg" width="450px" height="250px">

			
			<svg id="svg1" onload="Start(evt)" height="250" version="1.1" width="450" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			<script type="text/ecmascript">
			
   <![CDATA[

//	Start(evt);
   
   
    var time = 0;
    var delta_time = 25;
    var max_time = 1000;
    var dir = 1;
	var dir_purple_spiral = 1;
	var opacity_ps = .9;
	
	var lifetime = 0; // overall time elapsing.
	
	var active_area = "creatures/avril3.svg"; //area for saving and loading in main view.
	var active_tool = "Touch"; //tool for playing/interacting with creaturez! :)
		//eventually p set default to Inspect


		
		
		// php interferes with local testing w/o a server, so comment out the URL GET area for local-only testing...
		// eventually can mv this stuff into e.g. open.php, or craft an alternative solution...

		//check URL for default area to load
		//if filexists w/ name "creatures/$(GET).svg" then set that as active_area...
		<?php
		//set up the file path from the URL "area" parameter
		//e.g. "/index.php?area=eagle5" opens "creatures/eagle5.svg"
		$area = 'creatures/';
		$area .= $_GET['area'];
		$area .= '.svg';
				
		//check if $area exists, and if so set it as active_area
		if (file_exists($area)) {
			echo 'active_area = "'.$area.'";';
		}
		
		?>


		
    var the_rect;
    var pink_rect;
    var eg_niblet;
    var eg_medy;
    var eg_biggo;
    var eg_newy;
    var purple_spiral;
    var avril_niblet_1;
	var eaglynew;
	
	var eg_newy2; // how's this? :)

	// do we need to declare satellites 3 and 4?
	var satellite3;
	var satellite4;
	
	
	var bg;
	
	var creatures = svg1;
	
	//array of clones! :)
	var clone_array = [];
	
	var clone_index = 0; //keep track of clones.
	
	//array of creatures! :)
	var creature_array = [];
	
	var creature_index = 0; //keep track of creatures.
	
//	var creatures_by_class = 0; // this should m be merged w/ the above creature_index...
	
//	var area_array = []; // map of areas for navigator
	var area_array = new Array(10); // map of areas for navigator
	var navigator_open = false; // 0: area navigator closed. 1: area navigator open.
	
	var xmlns = "http://www.w3.org/2000/svg" // set URI for SVG NameSpace

	
    function Start(evt) {
		//Start the mechanical magic!!! :)
			
		LoadCreatures();
	//	LoadUI();

		UpdateCreatures(evt);
	//	Set vars from dynamically loaded SVG
	

		Oscillate();
		// move the creatures!!! :)
    }

	
	function UpdateCreatures(evt){
	//create vars from ajax svg creatures! :)
		eaglynew = document.getElementById("eaglynew");
		
		the_rect = document.getElementById("mediumcreature3");
		pink_rect = document.getElementById("niblet3");
		eg_niblet = document.getElementById("planet3");
		eg_medy = document.getElementById("planet4");
		eg_biggo = document.getElementById("bigbeauty3");
	//      eg_biggo = evt.target.ownerDocument.getElementById("BiggoEG");
		eg_newy = document.getElementById("galaxy3");
		eg_newy2 = document.getElementById("galaxy4");
		satellite3 = document.getElementById("satellite3");
		satellite4 = document.getElementById("satellite4");

		back3 = document.getElementById("back3");

		purple_spiral = document.getElementById("PurpleSpiral");
		avril_niblet_1 = document.getElementById("AvrilNiblet1");
		
		// TODO; loop through clone_array[] and get var from svg...
		// p do sthg like "for each creature in svg, create a var..."
		
		// Also same for creature_array[]? probably yes
		
		//first I think we should clear the previously user-created creatures
		creature_array = [];
		
		
		//then load them anew...
//		creature_index = 0; // go back to beginning - is this necessary? probably yes. actually I think it shouldn't be with the below.
		
//		creature_array[creature_index] = document.getElementById("creature_name"); // add creature to js from svg...
//		i think we'll need to carefully loop through each svg element...
		var creatures_by_class = document.getElementsByClassName("creatureClass"); // should create an array containing all creatures...
		//var k; ...for now we're using creature_index instead, I think this should work... :)
		for (creature_index = 0; creature_index < creatures_by_class.length; creature_index++) {
			creature_array[creature_index] = creatures_by_class[creature_index];
		}

		
		
//		the_rect = evt.target.ownerDocument.getElementById("mediumcreature3");
//		pink_rect = evt.target.ownerDocument.getElementById("niblet3");
//		eg_niblet = evt.target.ownerDocument.getElementById("planet3");
//		eg_medy = evt.target.ownerDocument.getElementById("planet4");
//		eg_biggo = evt.target.ownerDocument.getElementById("bigbeauty3");
	//      eg_biggo = evt.target.ownerDocument.getElementById("BiggoEG");
//		eg_newy = evt.target.ownerDocument.getElementById("galaxy3");
//		eg_newy2 = evt.target.ownerDocument.getElementById("galaxy4");
//		satellite3 = evt.target.ownerDocument.getElementById("satellite3");
//		satellite4 = evt.target.ownerDocument.getElementById("satellite4");

//		back3 = evt.target.ownerDocument.getElementById("back3");

//		purple_spiral = document.getElementById("PurpleSpiral");
//		avril_niblet_1 = evt.target.ownerDocument.getElementById("AvrilNiblet1");
		
	}
	
	
	function LoadCreatures() {
	//Download creatures from server via AJAX requests.
	//Could maybe be combined with OpenArea()
	
	xhr = new XMLHttpRequest();
//	xhr.open("GET","creatures/0123456789.svg",false);
//	xhr.open("GET","creatures/allcreatures11.svg",false); //load dynamically! :)
//	xhr.open("GET","creatures/avril2.svg",false); //load dynamically! :)
//	var creatures_path = "creatures/"+active_area+".svg";
	xhr.open("GET",active_area + ((/\?/).test(active_area) ? "&" : "?") + "time="+(new Date()).getTime(),false); //load dynamically! :)
	// Following line is just to be on the safe side;
	// not needed if your server delivers SVG with correct MIME type
	xhr.overrideMimeType("image/svg+xml");
	xhr.send("");
	document.getElementById("svgContainerCreatures")
	  .appendChild(xhr.responseXML.documentElement);

  }

	function LoadUI() {
		//Loads the user interface. The UI itself should be moved out of here and into its own file.
		//SO what's in ui2.svg???
	
	xhr = new XMLHttpRequest();
	xhr.open("GET","ui/ui2.svg",false);
	// Following line is just to be on the safe side;
	// not needed if your server delivers SVG with correct MIME type
	xhr.overrideMimeType("image/svg+xml");
	xhr.send("");
	document.getElementById("svgContainerUI")
	  .appendChild(xhr.responseXML.documentElement);

  }


	function OpenArea(area) {
		// Go to a new area! :)
		// basically, switch the active_area, then replaceChild the svg
		
//		var new_area = "creatures/avril7.svg"; //this was around but I think now obsolete

		navigator_open = false; // set toggle off.
		
//		active_area = "creatures/avril7.svg"; // new active area
		active_area = area; // new active area
		
		var xhr_new = new XMLHttpRequest();
		xhr_new.open("GET",active_area + ((/\?/).test(active_area) ? "&" : "?") + "time="+(new Date()).getTime(),false); //load dynamically! :)
			// btw the test above is probably unecessary, as it should already be loading e.g. "...?area=Area-01", although it worx! :)
		xhr_new.overrideMimeType("image/svg+xml");
		xhr_new.send("");
		document.getElementById("svgContainerCreatures")
		  .replaceChild(xhr_new.responseXML.documentElement,document.getElementById("svgContainerCreatures").childNodes[1]);
//		  .replaceChild(xhr_new.responseXML.documentElement,document.getElementById("svgContainerCreatures").lastElementChild);
		  //insert the dynamically loaded svg where the previous svg was

		UpdateCreatures(); //Set them in motion again!!! :)
		
	}

  
	function dw_encodeVars(params) {
		var str = '';
		for (var i in params ) {
			str += encodeURIComponent(i) + '=' + encodeURIComponent( params[i] ) + '&';
		}
		return str.slice(0, -1);
	}

	
	function PrepareCreatures() {
		//convert creatures to proper file format for saving .svg in SaveCreatures()

		//get the creaturez meta template from server
//php		xhr_m1 = new XMLHttpRequest();
//php		xhr_m1.open("GET","creatures/creaturez-meta.svg",false);
		// Following line is just to be on the safe side;
		// not needed if your server delivers SVG with correct MIME type
//php		xhr_m1.overrideMimeType("image/svg+xml");
//php		xhr_m1.send("");
		
		//put together the creaturez into XML format for writing
		
//		var creaturez_pre = xhr_m1.responseXML.documentElement + eaglynew; // combine meta with creaturez;
//		var XMLS = new XMLSerializer(); //to convert creature DOMz into text for sending to save.php form
//		var creaturez_xml = XMLS.serializeToString(creaturez_pre); // convert meta and creaturez to text.
//		creaturez_xml += "</svg>"; // close svg
		
//		var creaturez_xml = xhr_m1.responseXML.documentElement; // add basic svg outline
//		creaturez_xml += XMLS.serializeToString(eaglynew); // add creaturez
		
		
		var XMLS = new XMLSerializer(); //to convert creature DOMz into text for sending to save.php form
//		var XMLS2 = new XMLSerializer(); //to convert creature DOMz into text for sending to save.php form
//php		var meta_xml = XMLS.serializeToString(xhr_m1.responseXML.documentElement); // serialize meta
//php		var creaturez_xml = meta_xml; // add basic svg outline
//		var creaturez_xml = xhr_m1.responseXML.documentElement; // add basic svg outline
		creaturez_xml = XMLS.serializeToString(eaglynew); // add creaturez
		creaturez_xml += XMLS.serializeToString(avril_niblet_1); // add creaturez */
		creaturez_xml += XMLS.serializeToString(purple_spiral); // add creaturez
		creaturez_xml += XMLS.serializeToString(back3); // add creaturez
		creaturez_xml += XMLS.serializeToString(eg_newy); // add creaturez
		creaturez_xml += XMLS.serializeToString(eg_newy2); // add creaturez
		creaturez_xml += XMLS.serializeToString(eg_niblet); // add creaturez
		creaturez_xml += XMLS.serializeToString(eg_medy); // add creaturez
		creaturez_xml += XMLS.serializeToString(satellite3); // add creaturez
		creaturez_xml += XMLS.serializeToString(satellite4); // add creaturez
		creaturez_xml += XMLS.serializeToString(the_rect); // add creaturez
		creaturez_xml += XMLS.serializeToString(pink_rect); // add creaturez
		creaturez_xml += XMLS.serializeToString(eg_biggo); // add creaturez
		
		for (i = 0; i < creature_index; i++) creaturez_xml += XMLS.serializeToString(creature_array[i]); // add user-created creatures
		
		
//php		creaturez_xml += "</svg>" // close svg

		//add clones too...
		//and new creatures...
		// for i = 0 to array index, serializeToString creature/clone[i]
		
		return creaturez_xml;
	}
  
	function SaveCreatures() {
		//creatures = svg1;
		//$var = $_POST['foo'];
		//file_put_contents('file_where_stored_value_is.php', $var);
		
		
//		creaturezready = eaglynew.childNodes;
//		areaready = PrepareArea(); //prepare area to save
		creaturezready = PrepareCreatures(); //prepare creaturez to save

		xhr = new XMLHttpRequest(); //create new request
//		xhr.open("GET","save.php?tub=testnewtub4&creaturez=SVG headers...: " + creaturezready); //"creatures/1234567.svg"); //what goes in 2nd/3rd params? "index.php"? "creatures/1234567"? ...?
		xhr.open("POST","save.php"); //"creatures/1234567.svg"); //what goes in 2nd/3rd params? "index.php"? "creatures/1234567"? ...?
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		var data = dw_encodeVars({area:active_area, creaturez:creaturezready}); // set up data to POST.
		xhr.send(data);
		//can js write the php? pn
		// devsave = xhr; // test var
		
	}

	
	function setTool(tool){
		//Set the active tool for interacting with creaturez! :)

		//Unhighlight the previously active tool's icon.
		document.getElementById(active_tool).setAttribute('fill-opacity','0.75');
		
		//Set the selected tool as active.
		active_tool = tool;
		
		//Highlight the newly active tool's icon.
		document.getElementById(tool).setAttribute('fill-opacity','0.99');
	}
	
	function tool(creature) {
		//Use the active tool on the selected creature! :)
		
		//eventually switch to a case statement or whatever...
		
		//document.getElementById(active_tool)(creature);...
		//basically run the active_tool on the creature
		
		if (active_tool == "Touch") touch(creature); //touch(creature);
		if (active_tool == "Clone") clone(creature); //clone(creature);
		if (active_tool == "Create") create(creature); //create(creature);
	/*	if (active_tool == "Download") touch(creature); //touch(creature);
		if (active_tool == "Upload") touch(creature); //touch(creature);
		if (active_tool == "Group") touch(creature); //touch(creature);
		if (active_tool == "Ungroup") touch(creature); //touch(creature);
		if (active_tool == "etc.") touch(creature); //touch(creature);
		if (active_tool == "...") touch(creature); //touch(creature);
	*/
	}

	function Move(creature, x, y) {
		creature.setAttribute("transform", "translate(x, y)");
	}
	
	function clone(creature) {
		//Clone a creature! :)
		var clone_name = creature.getAttribute("id")+"-"+Math.random(); //e.g. "the_rect-0.17239898123"
		clone_array[clone_index] = creature.cloneNode(true); // can we give the new clone a var on the basis of clone_name? let it use array instead.
		clone_array[clone_index].setAttribute("id",clone_name); // give the new clone a different id.
		clone_array[clone_index].setAttribute("transform","translate(-40,20)"); // translate the new clone. SHOULD P CHANGE WHERE EACH GOES
		clone_array[clone_index].setAttribute("onmousedown","deleteClone('"+clone_name+"')"); // Self-destruct! :) although that would override other toolz... ok for now, later would ideally deal w/ clones more elegantly...
						// insert clone_index into clone, for ease of deletion. 
	//		clone_array[clone_index].setAttribute("clone_index",clone_index); // insert clone_index into clone, for ease of deletion.
			// or should it be : "onmousedown=deleteClone(clone_index)"...? py...
		document.getElementById("svg2")
			.insertBefore(clone_array[clone_index], creature); // add the new clone into the inline svg (to get written automatically to file later)
			
		clone_index++; // go to next clone
	}
	
	function deleteClone(clone_name) {
		//or m use (creature)...
		
		document.getElementById("svg2") // rm clone from inline svg
			.removeChild(document.getElementById(""+clone_name+"")); //um...
//			.removeChild(clone_array[clone_index]); //um...
	}
	
	
	function givePersonality(creature_name) {
		//assign a personality (set of behaviors) to a creature
		
		//insert a set of steps into SVG <desc>
		//should yield basically eval("personalitycode")
		//e.g. document.getElementById(creature_name).setAttribute("transform", "translate(3,8), rotate(90)";
		document.getElementById(creature_name).setAttribute("transform", "translate(3,5)"); // transform the creature
			//could assign the above to a var and later eval() it if necessary
		
	}
	
	function moveCreature(creature_name, x, y) {
		//another take at improving creature personality
		
		//do any preprocessing
		x = x + document.getElementById(creature_name).getBoundingClientRect().x / 2 + 25*Math.random(); // update x
		y = y + document.getElementById(creature_name).getBoundingClientRect().y / 10 + 50*Math.random(); // update y
/*orig		x = x + document.getElementById(creature_name).getBoundingClientRect().x + 5; // update x
		y = y + document.getElementById(creature_name).getBoundingClientRect().y + 5; // update y
*/
		
		//translate creature_name x y
		document.getElementById(creature_name).setAttribute("transform", "translate("+x+", "+y+"), rotate("+x*y/38+")"); // transform the creature
			//now just make it relative to current position or o creature etc., instead of origin.
			
		
		
		
		
	}
	
	
	function getNearestNeighbor(creature_name) {
		var distanceMeasure; // check how far apart creature_name is from o creatures
		var distanceShortest = 450; // tmp store the shortest distance while iterating through
		var nearestNeighbor; // store the nearest neighbor
		
		//find the nearest other creature to creature_name
		if (creature_index > 0) {
			//if any other creatures around, calculate distances and keep the smallest
			for (var i = 0; i < creature_index; i++) {
				//iterate through creatures
//orig				distanceMeasure = 5*Math.random(); // calculate distance, probably something like Math.sqrt(Math.square(x)+Math.square(y))..
				distanceMeasure = (document.getElementById(creature_name).getBoundingClientRect().x - creature_array[i].getBoundingClientRect().x) + (document.getElementById(creature_name).getBoundingClientRect().y - creature_array[i].getBoundingClientRect().y); // calculate x diff
//btw what would diff x plus diff y give???				
				
//				5*Math.random(); // calculate distance, probably something like Math.sqrt(Math.square(x)+Math.square(y))..
				if (distanceMeasure < distanceShortest) {
					//if this is the shortest distance so far, then make this the return creature.
					distanceShortest = distanceMeasure; //set the new shortest distance
					nearestNeighbor = i; //store the index of the new shortest distance
				}
			}
		return nearestNeighbor; //should we return the index, or the whole creature?
			
		}

	}
	
	function moveExtralCreature(creature_name, x, y) {
		//another take at improving creature personality
		
		//do any preprocessing
		//here we should probably check for nearby creatures, and move somewhere along the way to the closest.
		if (creature_index > 0) {
			
			//if any other creatures, find the nearest creature and chase it! :)
			var nearestNeighbor = getNearestNeighbor(creature_name); // get (index of) nearbyest neighbor
			//getNearestNeighbor(creature_name);
			//iterate through creature_array[] and measure distance difference
				//measure vector distance, only keep the smallest
			//mv to a location between them
			x = (document.getElementById(creature_name).getBoundingClientRect().x - creature_array[nearestNeighbor].getBoundingClientRect().x) / 2;// mv somewhere between creature_name and nearestNeighbor
			y = (document.getElementById(creature_name).getBoundingClientRect().y - creature_array[nearestNeighbor].getBoundingClientRect().y) / 2;// mv somewhere between creature_name and nearestNeighbor

		} //if other creatures (else just wander randomly)
		
		else {
		//update x and y
		
		
		x = x + document.getElementById(creature_name).getBoundingClientRect().x / 2 + 2*Math.random(); // update x
		y = y + document.getElementById(creature_name).getBoundingClientRect().y / 1000 + 10*Math.random(); // update y
/*orig		x = x + document.getElementById(creature_name).getBoundingClientRect().x + 5; // update x
		y = y + document.getElementById(creature_name).getBoundingClientRect().y + 5; // update y
*/
		} // else wander around if no other creatures nearby
		
		//translate creature_name x y
		document.getElementById(creature_name).setAttribute("transform", "translate("+x+", "+y+")"); // transform the creature
			//now just make it relative to current position or o creature etc., instead of origin.
			
		
		
		
		
	}
	
	
	function create() {
		//Create a new creature! :)
		//We'll want to generalize this...
		//First let's make a new function for new creature type, then we can generalize...
		
		var cx_new = Math.random()*450; // create random starting x
		var cy_new = Math.random()*450; // create random starting y
		
		
		var creature_name = "Creature-"+Math.random(); //e.g. "Creature-0.17239898123"
	//	var creature_name = creature.getAttribute("id")+"-"+Math.random(); //e.g. "the_rect-0.17239898123"
		creature_array[creature_index] = document.createElementNS(xmlns,"circle"); //create a new creature! :)
	//			getElementById("satellite3").cloneNode(true); // can we give the new clone a var on the basis of clone_name? let it use array instead.
	//	creature_array[creature_index] = document.getElementById("satellite3").cloneNode(true); // can we give the new clone a var on the basis of clone_name? let it use array instead.
		creature_array[creature_index].setAttributeNS(null,"id",creature_name); // give the new clone a different id.
		creature_array[creature_index].setAttributeNS(null,"r",20); // give the new clone a different id.
		creature_array[creature_index].setAttributeNS(null,"cx",cx_new); // give the new clone a different id.
		creature_array[creature_index].setAttributeNS(null,"cy",cy_new); // give the new clone a different id.
		creature_array[creature_index].setAttributeNS(null,"style","fill:blue;stroke:purple"); // give the new clone a different id.
		creature_array[creature_index].setAttributeNS(null,"transform","translate(-40,20)"); // translate the new clone.
		creature_array[creature_index].setAttributeNS(null,"onmousedown","deleteCreature('"+creature_name+"')"); // Self-destruct! :) although that would override other toolz... ok for now, later would ideally deal w/ clones more elegantly...
	// add "Creature" class, for later readding/loading! :)
		creature_array[creature_index].setAttributeNS(null,"class","creatureClass"); // Assign new creatures to creatureClass. We can load AI etc. with this.
						// insert clone_index into clone, for ease of deletion. 
	//		clone_array[clone_index].setAttribute("clone_index",clone_index); // insert clone_index into clone, for ease of deletion.
			// or should it be : "onmousedown=deleteClone(clone_index)"...? py...
			
	// add <title> (hover-over tip where available) and <desc> (AI)! :)
		//<title> - this is the hover-over tooltip on desktop/laptop...
		var creature_title_element = document.createElementNS(xmlns,"title"); // creature_title_element is a <title> element
		var creature_title = document.createTextNode(creature_name); // creature_title is the creature name. Right now this is autogenerated ID, could be user-given name instead.
		creature_title_element.appendChild(creature_title); // add ID to <title> (I think this is necessary...)
		creature_array[creature_index].appendChild(creature_title_element); // add <title> to new creature.

		//<desc> - this is AI! :)
		// m also add <id="a-##########"> and/or <class="personalityClass>
		var creature_desc_element = document.createElementNS(xmlns,"desc"); // creature_desc_element is a <desc> element
		var creature_desc = document.createTextNode("document.getElementById(\""+creature_name+"\").setAttribute(\"transform\", \"translate(\"+33*Math.random()+\", \"+50*Math.random()+\")\");"); // creature_desc describes the creature's AI or movements. (Start with hard-coded, eventually refer to AI data.
//orig		var creature_desc = document.createTextNode("document.getElementById(\""+creature_name+"\").setAttribute(\"transform\", \"translate(Math.random()*30,Math.random()*50)\");"); // creature_desc describes the creature's AI or movements. (Start with hard-coded, eventually refer to AI data.
			//eg_newy.setAttribute("transform", "translate(" +Math.random()*100+ ", " +Math.random()*100+ " )"); // mv randomly! :)
	//document.getElementById("Creature-0.778706729708058");
//	eg_newy.setAttribute("transform", "translate(3,5)");
	
//	" +Math.random()*100+ ", " +Math.random()*100+ " )");

		creature_desc_element.appendChild(creature_desc); // add AI to <desc> (I think this is necessary...)
		creature_array[creature_index].appendChild(creature_desc_element); // add <desc> to new creature. Not sure if this worx...

	
		// Add new creaturez to HTML DOM:	
		document.getElementById("svg2")
			.insertBefore(creature_array[creature_index], document.getElementById("galaxy3")); // WHERE TO INSERT? add the new clone into the inline svg (to get written automatically to file later)
				// m instead do an appendChild to svg2 (above)...
		creature_index++; // go to next creature
		
		
	}

	
	function createRect() {
		//Create a new rectangular creature! :)
		//We'll want to generalize this...
		//First let's make a new function for new creature type, then we can generalize...
		
		var x_new = Math.random()*450; // create random starting x
		var y_new = Math.random()*450; // create random starting y
		
		
		var creature_name = "Creature-"+Math.random(); //e.g. "Creature-0.17239898123"
	//	var creature_name = creature.getAttribute("id")+"-"+Math.random(); //e.g. "the_rect-0.17239898123"
		creature_array[creature_index] = document.createElementNS(xmlns,"rect"); //create a new creature! :)
	//			getElementById("satellite3").cloneNode(true); // can we give the new clone a var on the basis of clone_name? let it use array instead.
	//	creature_array[creature_index] = document.getElementById("satellite3").cloneNode(true); // can we give the new clone a var on the basis of clone_name? let it use array instead.
		creature_array[creature_index].setAttributeNS(null,"id",creature_name); // give the new clone a different id.
		creature_array[creature_index].setAttributeNS(null,"x",x_new); // give the new creature a starting x.
		creature_array[creature_index].setAttributeNS(null,"y",y_new); // give the new creature a starting y.
		creature_array[creature_index].setAttributeNS(null,"width",20*Math.random()); // give the new creature a different width.
		creature_array[creature_index].setAttributeNS(null,"height",20*Math.random()); // give the new creature a different height.
		creature_array[creature_index].setAttributeNS(null,"style","fill:pink;stroke:yellow"); // give the new clone a different color.
		creature_array[creature_index].setAttributeNS(null,"transform","translate(-40,20)"); // translate the new clone.
		creature_array[creature_index].setAttributeNS(null,"onmousedown","deleteCreature('"+creature_name+"')"); // Self-destruct! :) although that would override other toolz... ok for now, later would ideally deal w/ clones more elegantly...
	// add "Creature" class, for later readding/loading! :)
		creature_array[creature_index].setAttributeNS(null,"class","creatureClass"); // Assign new creatures to creatureClass. We can load AI etc. with this.
						// insert clone_index into clone, for ease of deletion. 
	//		clone_array[clone_index].setAttribute("clone_index",clone_index); // insert clone_index into clone, for ease of deletion.
			// or should it be : "onmousedown=deleteClone(clone_index)"...? py...
			
	// add <title> (hover-over tip where available) and <desc> (AI)! :)
		//<title> - this is the hover-over tooltip on desktop/laptop...
		var creature_title_element = document.createElementNS(xmlns,"title"); // creature_title_element is a <title> element
		var creature_title = document.createTextNode(creature_name); // creature_title is the creature name. Right now this is autogenerated ID, could be user-given name instead.
		creature_title_element.appendChild(creature_title); // add ID to <title> (I think this is necessary...)
		creature_array[creature_index].appendChild(creature_title_element); // add <title> to new creature.

		//<desc> - this is AI! :)
		// m also add <id="a-##########"> and/or <class="personalityClass>
		var creature_desc_element = document.createElementNS(xmlns,"desc"); // creature_desc_element is a <desc> element
		var creature_desc = document.createTextNode("document.getElementById(\""+creature_name+"\").setAttribute(\"transform\", \"translate(\"+33*Math.random()+\", \"+50*Math.random()+\")\");"); // creature_desc describes the creature's AI or movements. (Start with hard-coded, eventually refer to AI data.
//orig		var creature_desc = document.createTextNode("document.getElementById(\""+creature_name+"\").setAttribute(\"transform\", \"translate(Math.random()*30,Math.random()*50)\");"); // creature_desc describes the creature's AI or movements. (Start with hard-coded, eventually refer to AI data.
			//eg_newy.setAttribute("transform", "translate(" +Math.random()*100+ ", " +Math.random()*100+ " )"); // mv randomly! :)
	//document.getElementById("Creature-0.778706729708058");
//	eg_newy.setAttribute("transform", "translate(3,5)");
	
//	" +Math.random()*100+ ", " +Math.random()*100+ " )");

		creature_desc_element.appendChild(creature_desc); // add AI to <desc> (I think this is necessary...)
		creature_array[creature_index].appendChild(creature_desc_element); // add <desc> to new creature. Not sure if this worx...

	
		// Add new creaturez to HTML DOM:	
		document.getElementById("svg2")
			.insertBefore(creature_array[creature_index], document.getElementById("galaxy3")); // WHERE TO INSERT? add the new clone into the inline svg (to get written automatically to file later)
				// m instead do an appendChild to svg2 (above)...
		creature_index++; // go to next creature
		
		
	}

	
	
	function createCool() {
		//Create a cool new  creature! :)
		//Should do something a little more interesting!!! :)
		
		var x_new = Math.random()*450; // create random starting x
		var y_new = Math.random()*450; // create random starting y
		
		
		var creature_name = "Creature-"+Math.random(); //e.g. "Creature-0.17239898123"
	//	var creature_name = creature.getAttribute("id")+"-"+Math.random(); //e.g. "the_rect-0.17239898123"
		creature_array[creature_index] = document.createElementNS(xmlns,"rect"); //create a new creature! :)
	//			getElementById("satellite3").cloneNode(true); // can we give the new clone a var on the basis of clone_name? let it use array instead.
	//	creature_array[creature_index] = document.getElementById("satellite3").cloneNode(true); // can we give the new clone a var on the basis of clone_name? let it use array instead.
		creature_array[creature_index].setAttributeNS(null,"id",creature_name); // give the new clone a different id.
		creature_array[creature_index].setAttributeNS(null,"x",x_new); // give the new creature a starting x.
		creature_array[creature_index].setAttributeNS(null,"y",y_new); // give the new creature a starting y.
		creature_array[creature_index].setAttributeNS(null,"width",80*Math.random()); // give the new creature a different width.
		creature_array[creature_index].setAttributeNS(null,"height",40*Math.random()); // give the new creature a different height.
		creature_array[creature_index].setAttributeNS(null,"style","fill:yellow;stroke:black"); // give the new clone a different color.
		creature_array[creature_index].setAttributeNS(null,"transform","translate(-40,20)"); // translate the new clone.
		creature_array[creature_index].setAttributeNS(null,"onmousedown","deleteCreature('"+creature_name+"')"); // Self-destruct! :) although that would override other toolz... ok for now, later would ideally deal w/ clones more elegantly...
	// add "Creature" class, for later readding/loading! :)
		creature_array[creature_index].setAttributeNS(null,"class","creatureClass"); // Assign new creatures to creatureClass. We can load AI etc. with this.
						// insert clone_index into clone, for ease of deletion. 
	//		clone_array[clone_index].setAttribute("clone_index",clone_index); // insert clone_index into clone, for ease of deletion.
			// or should it be : "onmousedown=deleteClone(clone_index)"...? py...
			
	// add <title> (hover-over tip where available) and <desc> (AI)! :)
		//<title> - this is the hover-over tooltip on desktop/laptop...
		var creature_title_element = document.createElementNS(xmlns,"title"); // creature_title_element is a <title> element
		var creature_title = document.createTextNode(creature_name); // creature_title is the creature name. Right now this is autogenerated ID, could be user-given name instead.
		creature_title_element.appendChild(creature_title); // add ID to <title> (I think this is necessary...)
		creature_array[creature_index].appendChild(creature_title_element); // add <title> to new creature.

		//<desc> - this is AI! :)
		// m also add <id="a-##########"> and/or <class="personalityClass>
		var creature_desc_element = document.createElementNS(xmlns,"desc"); // creature_desc_element is a <desc> element
	var creature_desc = document.createTextNode("document.getElementById(\""+creature_name+"\").setAttribute(\"transform\", \"translate(\"+document.getElementById(\""+creature_name+"\").getAttribute(\"x\")*time/max_time*5+\", \"+document.getElementById(\""+creature_name+"\").getAttribute(\"height\")*time/max_time*Math.sqrt(5)+\")\");"); // creature_desc describes the creature's AI or movements. (Start with hard-coded, eventually refer to AI data.
//b4heliotropic		var creature_desc = document.createTextNode("document.getElementById(\""+creature_name+"\").setAttribute(\"transform\", \"translate(\"+time*Math.random()+\", \"+50*Math.random()+\")\");"); // creature_desc describes the creature's AI or movements. (Start with hard-coded, eventually refer to AI data.
//orig		var creature_desc = document.createTextNode("document.getElementById(\""+creature_name+"\").setAttribute(\"transform\", \"translate(Math.random()*30,Math.random()*50)\");"); // creature_desc describes the creature's AI or movements. (Start with hard-coded, eventually refer to AI data.
			//eg_newy.setAttribute("transform", "translate(" +Math.random()*100+ ", " +Math.random()*100+ " )"); // mv randomly! :)
	//document.getElementById("Creature-0.778706729708058");
//	eg_newy.setAttribute("transform", "translate(3,5)");
	
//	" +Math.random()*100+ ", " +Math.random()*100+ " )");

		creature_desc_element.appendChild(creature_desc); // add AI to <desc> (I think this is necessary...)
		creature_array[creature_index].appendChild(creature_desc_element); // add <desc> to new creature. Not sure if this worx...

	
		// Add new creaturez to HTML DOM:	
		document.getElementById("svg2")
			.insertBefore(creature_array[creature_index], document.getElementById("galaxy3")); // WHERE TO INSERT? add the new clone into the inline svg (to get written automatically to file later)
				// m instead do an appendChild to svg2 (above)...
		creature_index++; // go to next creature
		
		
	}

	
	function createUltral() {
		//Create a cool new  creature! :)
		//Should do something a little more interesting!!! :)
		
		var x_new = Math.random()*450; // create random starting x
		var y_new = Math.random()*450; // create random starting y
		
		
		var creature_name = "Creature-"+Math.random(); //e.g. "Creature-0.17239898123"
	//	var creature_name = creature.getAttribute("id")+"-"+Math.random(); //e.g. "the_rect-0.17239898123"
		creature_array[creature_index] = document.createElementNS(xmlns,"rect"); //create a new creature! :)
	//			getElementById("satellite3").cloneNode(true); // can we give the new clone a var on the basis of clone_name? let it use array instead.
	//	creature_array[creature_index] = document.getElementById("satellite3").cloneNode(true); // can we give the new clone a var on the basis of clone_name? let it use array instead.
		creature_array[creature_index].setAttributeNS(null,"id",creature_name); // give the new clone a different id.
		creature_array[creature_index].setAttributeNS(null,"x",x_new); // give the new creature a starting x.
		creature_array[creature_index].setAttributeNS(null,"y",y_new); // give the new creature a starting y.
		creature_array[creature_index].setAttributeNS(null,"width",80*Math.random()); // give the new creature a different width.
		creature_array[creature_index].setAttributeNS(null,"height",40*Math.random()); // give the new creature a different height.
		creature_array[creature_index].setAttributeNS(null,"style","fill:brown;stroke:white"); // give the new clone a different color.
		creature_array[creature_index].setAttributeNS(null,"transform","translate(-40,20)"); // translate the new clone.
		creature_array[creature_index].setAttributeNS(null,"onmousedown","deleteCreature('"+creature_name+"')"); // Self-destruct! :) although that would override other toolz... ok for now, later would ideally deal w/ clones more elegantly...
	// add "Creature" class, for later readding/loading! :)
		creature_array[creature_index].setAttributeNS(null,"class","creatureClass"); // Assign new creatures to creatureClass. We can load AI etc. with this.
						// insert clone_index into clone, for ease of deletion. 
	//		clone_array[clone_index].setAttribute("clone_index",clone_index); // insert clone_index into clone, for ease of deletion.
			// or should it be : "onmousedown=deleteClone(clone_index)"...? py...
			
	// add <title> (hover-over tip where available) and <desc> (AI)! :)
		//<title> - this is the hover-over tooltip on desktop/laptop...
		var creature_title_element = document.createElementNS(xmlns,"title"); // creature_title_element is a <title> element
		var creature_title = document.createTextNode(creature_name); // creature_title is the creature name. Right now this is autogenerated ID, could be user-given name instead.
		creature_title_element.appendChild(creature_title); // add ID to <title> (I think this is necessary...)
		creature_array[creature_index].appendChild(creature_title_element); // add <title> to new creature.

		//<desc> - this is AI! :)
		// m also add <id="a-##########"> and/or <class="personalityClass>
		var creature_desc_element = document.createElementNS(xmlns,"desc"); // creature_desc_element is a <desc> element
	var creature_desc = document.createTextNode("moveCreature(\""+creature_name+"\", -120, -30)"); // make it flutter about like some kind of random particle
	
	
	
//more b4 ultral	document.getElementById(\""+creature_name+"\");"); // creature_desc describes the creature's AI or movements. (Start with hard-coded, eventually refer to AI data.
//b4 ultral	var creature_desc = document.createTextNode("document.getElementById(\""+creature_name+"\").setAttribute(\"transform\", \"translate(\"+document.getElementById(\""+creature_name+"\").getAttribute(\"x\")*time/max_time*5+\", \"+document.getElementById(\""+creature_name+"\").getAttribute(\"height\")*time/max_time*Math.sqrt(5)+\")\");"); // creature_desc describes the creature's AI or movements. (Start with hard-coded, eventually refer to AI data.
//b4heliotropic		var creature_desc = document.createTextNode("document.getElementById(\""+creature_name+"\").setAttribute(\"transform\", \"translate(\"+time*Math.random()+\", \"+50*Math.random()+\")\");"); // creature_desc describes the creature's AI or movements. (Start with hard-coded, eventually refer to AI data.
//orig		var creature_desc = document.createTextNode("document.getElementById(\""+creature_name+"\").setAttribute(\"transform\", \"translate(Math.random()*30,Math.random()*50)\");"); // creature_desc describes the creature's AI or movements. (Start with hard-coded, eventually refer to AI data.
			//eg_newy.setAttribute("transform", "translate(" +Math.random()*100+ ", " +Math.random()*100+ " )"); // mv randomly! :)
	//document.getElementById("Creature-0.778706729708058");
//	eg_newy.setAttribute("transform", "translate(3,5)");
	
//	" +Math.random()*100+ ", " +Math.random()*100+ " )");

		creature_desc_element.appendChild(creature_desc); // add AI to <desc> (I think this is necessary...)
		creature_array[creature_index].appendChild(creature_desc_element); // add <desc> to new creature. Not sure if this worx...

	
		// Add new creaturez to HTML DOM:	
		document.getElementById("svg2")
			.insertBefore(creature_array[creature_index], document.getElementById("galaxy3")); // WHERE TO INSERT? add the new clone into the inline svg (to get written automatically to file later)
				// m instead do an appendChild to svg2 (above)...
		creature_index++; // go to next creature
		
		
	}

	function createExtral() {
		//Create a cool new  creature! :)
		//Should do something a little more interesting!!! :)
		
		var x_new = Math.random()*450; // create random starting x
		var y_new = Math.random()*450; // create random starting y
		
		
		var creature_name = "Creature-"+Math.random(); //e.g. "Creature-0.17239898123"
	//	var creature_name = creature.getAttribute("id")+"-"+Math.random(); //e.g. "the_rect-0.17239898123"
		creature_array[creature_index] = document.createElementNS(xmlns,"rect"); //create a new creature! :)
	//			getElementById("satellite3").cloneNode(true); // can we give the new clone a var on the basis of clone_name? let it use array instead.
	//	creature_array[creature_index] = document.getElementById("satellite3").cloneNode(true); // can we give the new clone a var on the basis of clone_name? let it use array instead.
		creature_array[creature_index].setAttributeNS(null,"id",creature_name); // give the new clone a different id.
		creature_array[creature_index].setAttributeNS(null,"x",x_new); // give the new creature a starting x.
		creature_array[creature_index].setAttributeNS(null,"y",y_new); // give the new creature a starting y.
		creature_array[creature_index].setAttributeNS(null,"width",80*Math.random()); // give the new creature a different width.
		creature_array[creature_index].setAttributeNS(null,"height",40*Math.random()); // give the new creature a different height.
		creature_array[creature_index].setAttributeNS(null,"style","fill:orange;stroke:yellow"); // give the new clone a different color.
		creature_array[creature_index].setAttributeNS(null,"transform","translate(-40,20)"); // translate the new clone.
		creature_array[creature_index].setAttributeNS(null,"onmousedown","deleteCreature('"+creature_name+"')"); // Self-destruct! :) although that would override other toolz... ok for now, later would ideally deal w/ clones more elegantly...
	// add "Creature" class, for later readding/loading! :)
		creature_array[creature_index].setAttributeNS(null,"class","creatureClass"); // Assign new creatures to creatureClass. We can load AI etc. with this.
						// insert clone_index into clone, for ease of deletion. 
	//		clone_array[clone_index].setAttribute("clone_index",clone_index); // insert clone_index into clone, for ease of deletion.
			// or should it be : "onmousedown=deleteClone(clone_index)"...? py...
			
	// add <title> (hover-over tip where available) and <desc> (AI)! :)
		//<title> - this is the hover-over tooltip on desktop/laptop...
		var creature_title_element = document.createElementNS(xmlns,"title"); // creature_title_element is a <title> element
		var creature_title = document.createTextNode(creature_name); // creature_title is the creature name. Right now this is autogenerated ID, could be user-given name instead.
		creature_title_element.appendChild(creature_title); // add ID to <title> (I think this is necessary...)
		creature_array[creature_index].appendChild(creature_title_element); // add <title> to new creature.

		//<desc> - this is AI! :)
		// m also add <id="a-##########"> and/or <class="personalityClass>
		var creature_desc_element = document.createElementNS(xmlns,"desc"); // creature_desc_element is a <desc> element
	var creature_desc = document.createTextNode("moveExtralCreature(\""+creature_name+"\", -120, -30)"); // make it flutter about like some kind of insect or bacterium
	
	
	
//more b4 ultral	document.getElementById(\""+creature_name+"\");"); // creature_desc describes the creature's AI or movements. (Start with hard-coded, eventually refer to AI data.
//b4 ultral	var creature_desc = document.createTextNode("document.getElementById(\""+creature_name+"\").setAttribute(\"transform\", \"translate(\"+document.getElementById(\""+creature_name+"\").getAttribute(\"x\")*time/max_time*5+\", \"+document.getElementById(\""+creature_name+"\").getAttribute(\"height\")*time/max_time*Math.sqrt(5)+\")\");"); // creature_desc describes the creature's AI or movements. (Start with hard-coded, eventually refer to AI data.
//b4heliotropic		var creature_desc = document.createTextNode("document.getElementById(\""+creature_name+"\").setAttribute(\"transform\", \"translate(\"+time*Math.random()+\", \"+50*Math.random()+\")\");"); // creature_desc describes the creature's AI or movements. (Start with hard-coded, eventually refer to AI data.
//orig		var creature_desc = document.createTextNode("document.getElementById(\""+creature_name+"\").setAttribute(\"transform\", \"translate(Math.random()*30,Math.random()*50)\");"); // creature_desc describes the creature's AI or movements. (Start with hard-coded, eventually refer to AI data.
			//eg_newy.setAttribute("transform", "translate(" +Math.random()*100+ ", " +Math.random()*100+ " )"); // mv randomly! :)
	//document.getElementById("Creature-0.778706729708058");
//	eg_newy.setAttribute("transform", "translate(3,5)");
	
//	" +Math.random()*100+ ", " +Math.random()*100+ " )");

		creature_desc_element.appendChild(creature_desc); // add AI to <desc> (I think this is necessary...)
		creature_array[creature_index].appendChild(creature_desc_element); // add <desc> to new creature. Not sure if this worx...

	
		// Add new creaturez to HTML DOM:	
		document.getElementById("svg2")
			.insertBefore(creature_array[creature_index], document.getElementById("galaxy3")); // WHERE TO INSERT? add the new clone into the inline svg (to get written automatically to file later)
				// m instead do an appendChild to svg2 (above)...
		creature_index++; // go to next creature
		
		
	}

	
	
	function removeFromArray(array , index) {
	// Remove an item from an array.
	// Utility function to delete items from arrays, for example removing a creature from creature_array during creature deletion.
	
		return array.slice(0, index)
			.concat(array.slice(index + 1));
	}

	
	function deleteCreature(creature_name) {
		//Delete a creature
		//can m eventually also replace deleteClone()
		
		//should also rm from array (and maybe change index???)
//something like this		removeFromArray(creature_array, indexOf(creature_name)); // rm creature from array
		// also probably decrement creature_index...

		//debug
//		testdel = creature_name; //debug
//make it work
		removeFromArray(creature_array, creature_array.indexOf(document.getElementById(creature_name))); // rm clone from creature_array...
		//check the above, and implement removeFromArray()...
		//seems to check out! :)
		// removeFromArray (creature_array, document.getElementById(creature_name));
//makeitwork
		creature_index--; // decrement (reduce) creature_index for future operations/additions.
		//creatures_by_class--; // decrement (reduce) creature_index for future operations/additions.
		//the above vars should probably be merged/combined...
			

		document.getElementById("svg2") // rm clone from inline svg
//orig			.removeChild(document.getElementById(""+creature_name+"")); //um...
			.removeChild(document.getElementById(creature_name)); //um...

		UpdateCreatures(); // seems to fix array issue after del??? not sure if this is a sane approach...

	}
	
	function touch(creature) {
		//Touch a creature! :)
		//the creature should at least respond minimally, and eventually have sophisticated behaviors...
		
		var x_mv = Math.random() * (time * 25) / max_time;
		var y_mv = Math.random() * (time * 25) / max_time;
		
		creature.setAttribute("transform", "translate("+x_mv+", "+y_mv+")");
		creature.setAttribute("transform", "rotate(90,225,225)");
		creature.setAttribute("transform", "rotate(90,225,225)");
		creature.setAttribute("transform", "rotate(90,225,225)");
		creature.setAttribute("transform", "rotate(90,225,225)");
		/*		x_mv -= 2.5;
		y_mv += 2.5;
//		setTimeout("creature.setAttribute('transform', 'translate('+x_mv+', '+y_mv+')')", delta_time);
		creature.setAttribute("transform", "translate("+x_mv+", "+y_mv+")");
		x_mv -= 25;
		y_mv += 25;
		creature.setAttribute("transform", "translate("+x_mv+", "+y_mv+")");
		x_mv += 2.5;
		y_mv -= 55;
		creature.setAttribute("transform", "translate("+x_mv+", "+y_mv+")");
		x_mv -= 25;
		y_mv += 2.5;
		creature.setAttribute("transform", "translate("+x_mv+", "+y_mv+")");
		x_mv += 50;
		y_mv += 25;
		creature.setAttribute("transform", "translate("+x_mv+", "+y_mv+")");
*/
		
//		creature.setAttribute("transform", "translate(-100,20)");
//		creature.setAttribute("transform", "translate(-20,200)");
//		creature.setAttribute("transform", "translate(30,-20)");
//		creature.setAttribute("transform", "translate(-10,-20)");
//		creature.setAttribute("transform", "translate(10,20)");
//		creature.setAttribute("transform", "translate(-"+(2*x_mv)+", "+y_mv+")");
//		creature.setAttribute("transform", "translate("+x_mv+", -"+y_mv+")");
//		creature.setAttribute("transform", "translate(-"+x_mv+", "+y_mv+")");
//		creature.setAttribute("transform", "translate("+x_mv+", -"+y_mv+")");
//		creature.setAttribute("transform", "scale(2)");
//		creature.setAttribute("transform", "rotate(90,200,200)");
//		creature.setAttribute("transform", "rotate(90,225,225)");
//		creature.setAttribute("transform", "rotate(90)");
	}
	
	
	function navigate() {
		//Navigate the LifeFLOW! :)
		
		//The area navigator starts life as a simple 100x100 grid of boxes.
		//Eventually it will become a nesting "map" that lets players move around the areas! :)
		
		//check if Navigator already open:
		if (navigator_open == true) close_navigator(); else {
		

		//create g, add stuff to g, add go to dom...
		var navigator_g = document.createElementNS(xmlns,"g");
		navigator_g.setAttributeNS(null,"id","navigator_g");
		document.getElementById("svg2").appendChild(navigator_g);
	
		// Create NAVIGATE AREAS text and CANCEL button.
		// eventually create a g too, for all the navigator elements...
		var navigator_title = document.createElementNS(xmlns,"text");
		navigator_title.setAttributeNS(null,"id","navigator_title");
		navigator_title.setAttributeNS(null,"x","90");
		navigator_title.setAttributeNS(null,"y","35");
		navigator_title.setAttributeNS(null,"font-size","32");
		navigator_title.setAttributeNS(null,"fill","lightblue");
		navigator_title.textContent = "NAVIGATE AREAS";
//		navigator_title.setAttributeNS(null,"content","NAVIGATE AREAS");
		document.getElementById("navigator_g").appendChild(navigator_title);


		var navigator_title = document.createElementNS(xmlns,"text");
		navigator_title.setAttributeNS(null,"id","navigator_title");
		navigator_title.setAttributeNS(null,"x","190");
		navigator_title.setAttributeNS(null,"y","435");
		navigator_title.setAttributeNS(null,"font-size","24");
		navigator_title.setAttributeNS(null,"fill","lightblue");
		navigator_title.setAttributeNS(null,"opacity","0.75");
		navigator_title.setAttributeNS(null,"onmouseover","setAttributeNS(null,'fill-opacity','0.5')");
		navigator_title.setAttributeNS(null,"onmouseout","setAttributeNS(null,'fill-opacity','0.75')");
		navigator_title.setAttributeNS(null,"onmousedown","close_navigator()");
		navigator_title.textContent = "CANCEL";
//		navigator_title.setAttributeNS(null,"content","NAVIGATE AREAS");
		document.getElementById("navigator_g").appendChild(navigator_title);

		
		// do we have to declare the array subarrays? looks like good practice
		
		// for (i < 10) (for (j < 10) (draw boxes, make 'em pretty)
		for (var i = 0; i < 10; i++) { // loop through columns 1-10.
			area_array[i] = new Array(10);
			//area_array[i] = i; // each column in the array gets a number
			for (var j = 0; j < 10; j++) { // loop through rows 1-10.
				//area_array[i][j] = (i+","+j); // each row (in each column) get a number
				
				//create squares, populate them w/ text/img, make them open areas, etc! :)
				//area_array[i][j] = "<rect width="32" height="32" x="" y="" id="area-x,y" onmousedown="openArea(area-x,y)" onmouseover="setAttribute('fill-opacity','0.75')" onmouseout="setAttribute('fill-opacity','0.5')" style="fill:lightblue;stroke:blue"><title>Area x,y</title></rect>"
				//p have to escape lots of single or double quotes
				//actually i think there's a better way: add w/ js, m make a container svg/div for it...
				area_array[i][j] = document.createElementNS(xmlns,"rect");
				area_array[i][j].setAttributeNS(null,"id","Area-"+i+j);
				area_array[i][j].setAttributeNS(null,"width","32");
				area_array[i][j].setAttributeNS(null,"height","32");
				area_array[i][j].setAttributeNS(null,"x",(36*i)+45);
				area_array[i][j].setAttributeNS(null,"y",(36*j)+50);
				area_array[i][j].setAttributeNS(null,"style","fill:lightblue;stroke:blue;opacity:0.5");
				area_array[i][j].setAttributeNS(null,"onmousedown","OpenArea('creatures/Area-"+i+j+".svg')");
				//set color according to presence of file...				
				//also show previews...
				area_array[i][j].setAttributeNS(null,"onmouseover","setAttributeNS(null,'fill-opacity','0.5')");
				area_array[i][j].setAttributeNS(null,"onmouseout","setAttributeNS(null,'fill-opacity','1')");
//				area_array[i][j].setAttributeNS(null,"onmousedown","OpenArea('creatures/avril3.svg')");
				//add the rest of the attributes...
				//p somehow group them?!
				//incl. <title>
				
				//append boxes to SVG
//				document.getElementById("svgContainerCreatures").appendChild(area_array[i][j]);
				document.getElementById("navigator_g").appendChild(area_array[i][j]);
//				document.getElementById("svg2").insertBefore(area_array[i][j],document.getElementById("BlueRect"));

				//create <title> to show which area each map opens
				var title = document.createElementNS(xmlns,"title");
				title.textContent = "Area-"+i+j;
				document.getElementById("Area-"+i+j).appendChild(title);
				
				//abovelineseemsto be causing issues... m sthg with all the quotes?
				//makea new div within? make a new g...
				
			} // close j/row loop
		} //close i/column loop
		//m at some point we'll separate multidimensional array innitiation from use?
		
		navigator_open = true; // set toggle on.
		}// try closing code block outside of case where Navigator was already open and we simply close it.
	} //close function navigate()
	
	
	function close_navigator() {
		//turn off/destroy Navigator
		//m useful for example for cancel navigator?
		
		//destroy navigator in DOM, and turn off toggle
		
		//p much easier w/ a new group, then just destroy the g
		document.getElementById("svg2").removeChild(document.getElementById("navigator_g"));
		
		navigator_open = false; // set toggle off.
	}
	
	
	function raise_money() {
		//request that users considerately pay money to developers! :)
		
		var fundraiser = "This function has yet to be born! Please contribute to LifeFLOW to speed up development! :)"
		
		alert(fundraiser);
	}
	
	
	function download() {
		//download creature
		
		raise_money(); //for now just ask for money! :)
	}
	
	function upload() {
		//upload creature
		
		raise_money(); //for now just ask for money! :)
	}
	
	function group() {
		//group creatures
		
		raise_money(); //for now just ask for money! :)
	}
	
	function ungroup() {
		//ungroup creatures
		
		raise_money(); //for now just ask for money! :)
	}
	
	
	
	function Turn() {
		dir = -dir;
	}
	
	function Act(creature) {
		//probably obsoleted by tool()
		//creature.setAttribute('fill-opacity',)
		//BiggoEG.setAttribute('fill-opacity','BiggoEG.getAttribute('fill-opacity')*0.9');
		creature.setAttribute('fill-opacity',creature.getAttribute('fill-opacity')*0.9);
	}

	function Speed() {
		delta_time = 1 / delta_time;
	}
	
	function Randomize() {
		time = Math.random()*1000;
	}
	
	function Reverse(creature) {
		dir_purple_spiral = -dir_purple_spiral;
		opacity_ps = opacity_ps * 0.9;
//		opacity_ps = opacity_ps - 0.2;
		purple_spiral.setAttribute('fill-opacity',opacity_ps);
//		purple_spiral.setAttribute('fill-opacity','0.1');
	//	purple_spiral.setAttribute('fill-opacity','0.25');
	//	purple_spiral.setAttribute('fill','fill+1');
		//dir = -dir;
	}

//	function Reverse() {
//		dir = -dir;
//	}

	function MovePurpleSpiral() {
	
	//	Move(purple_spiral);
	//	x_pos_ps = x_pos * 3;
	//	dir_purple_spiral = dir_purple_spiral * x_pos;
		x_pos_ps = (time * 25) / max_time * dir_purple_spiral;
		purple_spiral.setAttribute("transform", "translate(" +x_pos_ps+ ", " +y_pos+ ")");
		//purple_spiral.setAttribute("transform", "rotate(90, 100, 120)");
//		purple_spiral.setAttribute("transform", "rotate(90, " +x_pos_ps+ ", " +y_pos+ ")");

	}
	
    function Oscillate() {
	//mv the creatures/env. eventually we'll p switch to linear time, m leaving Oscillate() as an option.

      time = time + dir * delta_time;
      if (time >  max_time)  dir = -1;
      if (time < -max_time)  dir =  1;

	  // Save creatures every full oscillation
	  if (time >  max_time) SaveCreatures();
	  
	  
	  // Save creatures every 100 oscillations
//	  if (time >  max_time) lifetime += 1000;
//	  if (lifetime % 10000 == 0) SaveCreatures();

	  
	  // Calculate reference coordinate with respect to time:
      // Calculate x position
      x_pos = (time * 25) / max_time;
      // Calculate y position
      y_pos = (time * 25) / max_time;
	  galaxy4_y_pos = y_pos / 2;

      the_rect.setAttribute("transform", "translate( 0.0 , " +y_pos+ " )");
      pink_rect.setAttribute("transform", "translate( 0.0 , " +y_pos+ " )");

      eg_niblet.setAttribute("transform", "translate(" +x_pos+ ", 0.0 )");

//	we're trying herenow some new ai...


// orig:
      eg_biggo.setAttribute("transform", "translate(" +x_pos+ ", 0.0 )");
		//call instead from <desc>...

//useful? i think biggo - was useful for testing ai, for now just leaving biggo floating about! :)
//		eval(document.getElementById("ai2").textContent); // try running ai
		
		//p make array of ai[]
		
/*	old way to do desc ai:
		var ai = document.getElementById("ai2").textContent; // try running ai
		ai = ai.substring(1, ai.length()); // strip leading double quote
		ai = ai.substring(0, ai.length() - 1); // strip trailing double quote
		ai;
*/
      eg_medy.setAttribute("transform", "translate(" +x_pos+ ", 0.0 )");
//      eg_medy.setAttribute("transform", "translate(0.0, " +y_pos+ " )");

      // move(purple_spiral, " +x_pos+ ", 0.0);
	  //x_pos_ps = x_pos * 3;
      //purple_spiral.setAttribute("transform", "translate(" +x_pos_ps+ ", " +y_pos+ ")");
		MovePurpleSpiral();
	  
      // Move newyz
      orig: eg_newy.setAttribute("transform", "translate(" +x_pos+ ", " +y_pos+ " )");
//useful?  i think galaxy??? - was useful for testing personality, now just floating about! :)
//	  eval(document.getElementById("ai5").textContent); // mv newy/galaxy3 from svg ai

	  // Can we similarly mv whole creatureClass e.g.?
	  //eval(document.getElementByClass("creatureClass").textContent); // mv newy/galaxy3 from svg ai
	  
	  /* fix:
		for (creature_index = 0; creature_index < creature_array.length; creature_index++) {
			creature_array[creature_index].setAttribute("transform", "translate(" +Math.random()*100+ ", " +Math.random()*100+ " )"); // mv randomly! :)
//orig			creature_array[creature_index] = creatures_by_class[creature_index];
		}
		*/
	  
      eg_newy2.setAttribute("transform", "translate(" +x_pos+ ", " +galaxy4_y_pos+ " )");
      avril_niblet_1.setAttribute("transform", "translate(" +x_pos+ ", " +y_pos+ " )");

      satellite3.setAttribute("transform", "translate(" +x_pos+ ", " +y_pos+ " )");
      satellite4.setAttribute("transform", "translate(" +x_pos+ ", " +y_pos+ " )");

	  eaglynew.setAttribute("transform", "translate(" +x_pos+ ", " +y_pos+ " )");

	  // Move clones
	  // add something like (for each clone in array, animate)
	  
	 // for (i <= clone_index in clone_array) clone_array[clone_index].setAttribute("transform", "translate(" +x_pos+ ", " +y_pos+ " )"); i++
	 for (i = 0; i < clone_index; i++) clone_array[i].setAttribute("transform", "translate(" +2*Math.random()*x_pos+ ", " +2*Math.random()*y_pos+ " )");

	 // mv user-defined creatures; replace this with more sophisiticated motions then w/ custom AI! :)
//orig second copy???	 for (i = 0; i < creature_index; i++) creature_array[i].setAttribute("transform", "translate(" +x_pos+ ", " +y_pos+ " )");
	 
	 // instead of hard-coding here the movements generally for all generated creatures, let's load each individual creature's personality! :)
	 //for each creature, execute/eval() its personality/<desc>
	 
	 for (i = 0; i < creature_index; i++) eval(creature_array[i].childNodes[1].textContent); // Run the creature's <desc> personality. NOTE: Should ideally refer to <desc> in a more specifiic way, in case we have other childNodes before <desc> than <title>!
		 //testdebug = creature_array[i].childNodes[1];
		 //testdebug = (i+" - "+creature_array[i] + " - " + creature_array[i].childNodes[1]); //debug
	 //more debug  
 
		 //eval(creature_array[i].childNodes[1].textContent); // Run the creature's <desc> personality. NOTE: Should ideally refer to <desc> in a more specifiic way, in case we have other childNodes before <desc> than <title>!

		 //debug	 for (i = 0; i < creature_index; i++) print(creature_array[i].childNodes[1].textContent); // Run the creature's <desc> personality. NOTE: Should ideally refer to <desc> in a more specifiic way, in case we have other childNodes before <desc> than <title>!
//orig: 	 for (i = 0; i < creature_index; i++) creature_array[i].setAttribute("transform", "translate(" +x_pos+ ", " +y_pos+ " )");
	 
	 //i think it should be for each creature eval(creature_array[i]:getbyclass(personalityClass)) or sthg...
//ref:		eval(document.getElementById("ai2").textContent); // try running ai

      // Repeat
      setTimeout("Oscillate()", delta_time) //semicolon?
    }

    window.Oscillate = Oscillate //semicolon?

   ]]>
  </script>




<a style="fill-opacity:0.75" xlink:href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=TLUCRBGYW5XTS"> <rect height="10" id="NibletEGdemo" onmouseout="setAttribute('fill-opacity','0.5')" onmouseover="setAttribute('fill-opacity','1.0')" style="fill:green;stroke:lightgreen" width="10" x="30" y="180"> <desc id="desc3364">A clickable square to test simple JavaScript.</desc>
			<title id="title3362"></title>
			</rect> </a> 

			<a style="fill-opacity:0.75" xlink:href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=V5C7SW55G7J2S"><text x="160" y="120" font-family="Verdana" font-size="15">CONTRIBUTE! :)</text></a>

			<a style="fill-opacity:0.75" xlink:href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=TLUCRBGYW5XTS"><text x="30" y="210">Little niblet! :)</text></a>
<a style="fill-opacity:0.75" xlink:href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SBNNRLFPME2UN">
 <g
       id="MedyEGdemo"
	   onmouseout="setAttribute('fill-opacity','0.1')" onmouseover="setAttribute('fill-opacity','1.0')" >
	   
      <rect
         style="opacity:0.87000002;fill:#0000ff;fill-opacity:1;stroke:#0000ff;stroke-width:0.6047619;stroke-miterlimit:4;stroke-dasharray:none"
         id="rect6509"
         width="63.533783"
         height="31.766891"
         x="150"
         y="160" />
      <path
         style="opacity:0.87000002;fill:#ff8080;fill-opacity:1;stroke:#0000ff;stroke-width:0.6047619;stroke-miterlimit:4;stroke-dasharray:none"
         id="path6511"
         d="m 185,180 -6.160837,-1.4834 -4.714657,4.23419 -0.493011,-6.31769 -5.483865,-3.17547 5.856139,-2.42116 1.325442,-6.19674 4.112304,4.82134 6.303033,-0.65433 -3.314595,5.40091 z" />
      <path
         style="opacity:0.87000002;fill:#ff8080;fill-opacity:1;stroke:#0000ff;stroke-width:0.6047619;stroke-miterlimit:4;stroke-dasharray:none"
         id="path6513"
         d="m 190,180 -1.06782,-3.99694 -3.89796,-1.38629 3.47135,-2.25068 0.1139,-4.13556 3.21323,2.60595 3.96835,-1.16963 -1.48546,3.86124 2.33867,3.41269 -4.13129,-0.21956 z" />
      <path
         style="opacity:0.87000002;fill:#ff8080;fill-opacity:1;stroke:#0000ff;stroke-width:0.6047619;stroke-miterlimit:4;stroke-dasharray:none"
         id="path6515"
         d="m 162,185 -2.173306,-0.73698 -1.839194,1.3725 0.02933,-2.29468 -1.873674,-1.32505 2.191432,-0.6812 0.6812,-2.19143 1.32505,1.87368 2.294678,-0.0293 -1.372506,1.8392 z" />
      <path
         style="opacity:0.87000002;fill:#ff8080;fill-opacity:1;stroke:#0000ff;stroke-width:0.6047619;stroke-miterlimit:4;stroke-dasharray:none"
         id="path6517"
         d="m 196,185 2.201552,-4.70569 -2.628342,-4.48131 5.155694,0.63966 3.44978,-3.8845 0.984842,5.10102 4.760422,2.08056 -4.547027,2.51294 -0.507677,5.17036 -3.79506,-3.54794 z" />
    </g>
</a> 


			<a style="fill-opacity:0.75" xlink:href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SBNNRLFPME2UN"><text x="150" y="210">Medium creature! :)</text></a>
<a style="fill-opacity:0.75" xlink:href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=V5C7SW55G7J2S"> 
	<g
       id="BiggoEGdemo"
	   onmouseout="setAttribute('fill-opacity','0.5')" onmouseover="setAttribute('fill-opacity','1.0')">
      <desc
         id="desc4151">A big creature for LifeFLOW! :)</desc>
      <circle
         r="30"
         cy="160"
         cx="330"
         id="path4137"
         style="opacity:0.28999999;fill:#ffff00;stroke:#800080;stroke-width:0.6047619" />
      <circle
         r="7.3308215"
         cy="165"
         cx="337"
         id="path4139"
         style="opacity:0.28999999;fill:#ffff00;stroke:#800080;stroke-width:0.6047619" />
      <ellipse
         ry="10.996231"
         rx="3.6654108"
         cy="147"
         cx="322"
         id="path4141"
         style="opacity:0.28999999;fill:#0000ff;stroke:#800080;stroke-width:0.6047619" />
      <ellipse
         ry="3.6654108"
         rx="9.7744284"
         cy="170"
         cx="315"
         id="path4143"
         style="opacity:0.28999999;fill:#0000ff;stroke:#800080;stroke-width:0.6047619" />
    </g></a>



			<a style="fill-opacity:0.75" xlink:href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=V5C7SW55G7J2S"><text x="300" y="210">Big beauty! :)</text></a>
			


		<!-- text menu items -->
			
			<text x="30" y="20" opacity="0.1" onmousedown="Turn()" onmouseover="setAttribute('opacity','0.75')" onmouseout="setAttribute('opacity','0.1')" onmouseover="setAttribute('transform', 'translate(" +x_pos+ ", 0.0 )')">Reverse the flow! :)</text>
			<text x="180" y="20" opacity="0.1" onmousedown="Speed()" onmouseover="setAttribute('opacity','0.75')" onmouseout="setAttribute('opacity','0.1')" onmouseover="setAttribute('transform', 'translate(" +x_pos+ ", 0.0 )')">Pause/Resume! :)</text>
			<text x="320" y="20" opacity="0.1" onmousedown="Randomize()" onmouseover="setAttribute('opacity','0.75')" onmouseout="setAttribute('opacity','0.1')" onmouseover="setAttribute('transform', 'translate(" +x_pos+ ", 0.0 )')">Flow Forth! :)</text>

		<!-- graphical buttons -->
		

	<!--Button 1: Clone creature-->
	
	<g id="Clone"
			onmouseout="setAttribute('fill-opacity','0.75')" onmouseover="setAttribute('fill-opacity','0.9')" onmousedown="setTool('Clone')";>
			<title>Clone creature! :)</title>

		
			<rect height="32" width="32" x="30" y="40" id="Button1" onmouseout="setAttribute('fill-opacity','0.5')" onmouseover="setAttribute('fill-opacity','1.0')" style="fill:green;stroke:lightgreen"><desc id="First button on toolbar! :)">Inspect creature! :)</desc>
			</rect>

    <g
       id="g4339eg">
      <desc
         id="desc4343">clone icon</desc>
      <ellipse
         ry="4.8638129"
         rx="4.8638134"
         cy="50"
         cx="40"
         id="path4337"
         style="opacity:1;fill:#00ffff;stroke:#0000ff;stroke-width:0.27237353;stroke-miterlimit:4;stroke-dasharray:none" />
      <ellipse
         ry="4.8638129"
         rx="4.8638134"
         cy="60"
         cx="50"
         id="path4337"
         style="opacity:1;fill:#00ffff;stroke:#0000ff;stroke-width:0.27237353;stroke-miterlimit:4;stroke-dasharray:none" />
    </g>
			
			
	</g>
	
	
		<!--Button 2: Reverse flow-->
	
	<g id="Reverse"
				onmouseout="setAttribute('fill-opacity','0.75')" onmouseover="setAttribute('fill-opacity','0.9')" onmousedown="setTool('Reverse')";>
				<title>Reverse flow! :)</title>

			
			<rect height="32" width="32" x="70" y="40" id="Button2" onmousedown="Turn()" onmouseout="setAttribute('fill-opacity','0.5')" onmouseover="setAttribute('fill-opacity','1.0')" style="fill:green;stroke:lightgreen"> 
			<title><desc id="First button on toolbar! :)">Reverse the flow! :)</desc></title>
			</rect>

				<path
				   style="opacity:1;fill:#00ffff;stroke:#800080;stroke-width:0.18216613"
				   id="path4136"
				   onmousedown="Turn()" onmouseout="setAttribute('fill-opacity','0.5')" onmouseover="setAttribute('fill-opacity','1.0')" 
				   d="m 82,42 c 2.50289,-0.15428 5.00444,-0.0471 7.50749,0.0373 2.46447,0.0996 4.84471,0.59894 7.15284,1.40694 1.35134,0.51927 2.60501,1.16584 3.68248,2.11325 0.93505,0.92641 1.18752,2.08797 1.28979,3.32895 0.0332,2.2365 -1.05468,4.26562 -2.09359,6.20274 -0.74075,1.50129 -1.6671,2.86523 -2.96509,3.96219 -2.59849,1.8482 -5.62791,3.21097 -8.38422,4.70659 -0.60095,0.32609 -1.20977,0.58392 -1.85521,0.81378 -0.6246,0.31049 -1.23227,0.64964 -1.86834,0.93735 0,0 6.08357,-4.69345 6.08357,-4.69345 l 0,0 c 0.61334,-0.31325 1.23251,-0.61922 1.87681,-0.8697 0.77525,-0.332 0.36756,-0.14869 1.15762,-0.52389 0.2133,-0.1013 0.84425,-0.42103 0.64006,-0.30357 -10.5777,6.08457 -7.09397,4.069 -4.84846,2.70008 1.4593,-0.92444 2.49046,-2.2502 3.27423,-3.74737 1.03534,-1.77706 2.06917,-3.65567 2.11746,-5.74175 -0.0909,-1.03726 -0.21312,-2.05129 -1.01108,-2.82853 -1.01695,-0.85491 -2.22583,-1.41649 -3.46208,-1.92111 -2.19344,-0.8105 -4.48887,-1.2463 -6.84144,-1.32905 -2.56308,-0.0817 -5.18733,-0.21933 -7.70234,0.35936 0,0 6.2495,-4.61008 6.2495,-4.61008 z"
				   inkscape:connector-curvature="0" />
				<path
				   inkscape:connector-curvature="0"
				   onmousedown="Turn()" onmouseout="setAttribute('fill-opacity','0.5')" onmouseover="setAttribute('fill-opacity','1.0')" 
				   d="m 92,70 c -2.50289,0.15428 -5.00444,0.0471 -7.50749,-0.0373 -2.46447,-0.0996 -4.84471,-0.59894 -7.15284,-1.40694 -1.35134,-0.51927 -2.60501,-1.16584 -3.68248,-2.11325 -0.93505,-0.92641 -1.18752,-2.08797 -1.28979,-3.32895 -0.0332,-2.2365 1.05468,-4.26562 2.09359,-6.20274 0.74075,-1.50129 1.6671,-2.86523 2.96509,-3.96219 2.59849,-1.8482 5.62791,-3.21097 8.38422,-4.70659 0.60095,-0.32609 1.20977,-0.58392 1.85521,-0.81378 0.6246,-0.31049 1.23227,-0.64964 1.86834,-0.93735 0,0 -6.08357,4.69345 -6.08357,4.69345 l 0,0 c -0.61334,0.31325 -1.23251,0.61922 -1.87681,0.8697 -0.77525,0.332 -0.36756,0.14869 -1.15762,0.52389 -0.2133,0.1013 -0.84425,0.42103 -0.64006,0.30357 10.5777,-6.08457 7.09397,-4.069 4.84846,-2.70008 -1.4593,0.92444 -2.49046,2.2502 -3.27423,3.74737 -1.03534,1.77706 -2.06917,3.65567 -2.11746,5.74175 0.0909,1.03726 0.21312,2.05129 1.01108,2.82853 1.01695,0.85491 2.22583,1.41649 3.46208,1.92111 2.19344,0.8105 4.48887,1.2463 6.84144,1.32905 2.56308,0.0817 5.18733,0.21933 7.70234,-0.35936 0,0 -6.2495,4.61008 -6.2495,4.61008 z"
				   id="path4147"
				   style="opacity:1;fill:#0000ff;stroke:#800080;stroke-width:0.18216613" />

				   
				   
	</g>
	
	
	
		<!--Button 3: Slow flow-->
	
	<g id="Slow"
				onmouseout="setAttribute('fill-opacity','0.75')" onmouseover="setAttribute('fill-opacity','0.9')" onmousedown="setTool('Slow')";>
				<title>Slow flow! :)</title>

			<rect height="32" width="32" x="110" y="40" id="Button3" onmousedown="Speed()" onmouseout="setAttribute('fill-opacity','0.5')" onmouseover="setAttribute('fill-opacity','1.0')" style="fill:green;stroke:lightgreen"> 
			<title><desc id="First button on toolbar! :)">Pause/Resume! :)</desc></title>
			</rect>
			
			
    <g
		onmousedown="Speed()"
       id="g4349">
      <desc
         id="desc4353">move icon</desc>
      <path
         inkscape:connector-curvature="0"
         d="m 118,45 c 2.34949,0.62488 4.64194,1.41706 7.00388,1.9962 3.54565,0.74369 7.16208,1.04609 10.77317,1.24807 1.93138,0.12749 3.86839,0.11921 5.72955,-0.44216 0,0 -5.65785,4.32362 -5.65785,4.32362 l 0,0 c -1.85435,0.3595 -3.74107,0.27347 -5.6147,0.0878 -3.64562,-0.30015 -7.32684,-0.49691 -10.90386,-1.30362 -2.43924,-0.62037 -4.84433,-1.41164 -7.34327,-1.76227 0,0 6.01308,-4.14759 6.01308,-4.14759 z"
         id="path4345"
         style="opacity:1;fill:#00ffff;stroke:#0000ff;stroke-width:0.24354082;stroke-miterlimit:4;stroke-dasharray:none" />
      <path
         style="opacity:1;fill:#0000ff;stroke:#0000ff;stroke-width:0.24354082;stroke-miterlimit:4;stroke-dasharray:none"
         id="path4347"
         d="m 118,65 c 2.34949,-0.62487 4.64194,-1.41706 7.00388,-1.9962 3.54565,-0.74369 7.16208,-1.04609 10.77317,-1.24807 1.93138,-0.12749 3.86839,-0.11921 5.72955,0.44216 0,0 -5.65785,-4.32362 -5.65785,-4.32362 l 0,0 c -1.85435,-0.3595 -3.74107,-0.27347 -5.6147,-0.0878 -3.64562,0.30015 -7.32684,0.49691 -10.90386,1.30362 -2.43924,0.62037 -4.84433,1.41164 -7.34327,1.76227 0,0 6.01308,4.14759 6.01308,4.14759 z"
         inkscape:connector-curvature="0" />
    </g>

	</g>
	
	<!--Button4: New cool creature-->
	
	<g id="CreateCool"
				onmouseout="setAttribute('fill-opacity','0.75')" onmouseover="setAttribute('fill-opacity','0.9')" onmousedown="createCool()";>
				<title>Create a cool creature! :)</title>
	
			<rect height="32" width="32" x="150" y="40" id="Button4"  style="fill:yellow;stroke:lightgreen;opacity:0.75" onmouseout="setAttribute('fill-opacity','0.75')" onmouseover="setAttribute('fill-opacity','1.0')"> <desc id="First button on toolbar! :)">A clickable square to test simple JavaScript.</desc>
			</rect>

			
			    <g
       id="g4367">
      <path
         d="m 177,48 c -0.62488,2.34949 -1.41706,4.64194 -1.9962,7.00388 -0.74369,3.54565 -1.04609,7.16208 -1.24807,10.77317 -0.12749,1.93138 -0.11921,3.86839 0.44216,5.72955 0,0 -4.32362,-5.65785 -4.32362,-5.65785 l 0,0 c -0.3595,-1.85435 -0.27347,-3.74107 -0.0878,-5.6147 0.30015,-3.64562 0.49691,-7.32684 1.30362,-10.90386 0.62037,-2.43924 1.41164,-4.84433 1.76227,-7.34327 0,0 4.14759,6.01308 4.14759,6.01308 z"
         id="path4361"
         style="opacity:1;fill:#008000;stroke:#0000ff;stroke-width:0.24354082;stroke-miterlimit:4;stroke-dasharray:none" />
      <path
         style="opacity:1;fill:#0000ff;stroke:#0000ff;stroke-width:0.24354082;stroke-miterlimit:4;stroke-dasharray:none"
         id="path4363"
         d="m 157,48 c 0.62487,2.34949 1.41706,4.64194 1.9962,7.00388 0.74369,3.54565 1.04609,7.16208 1.24807,10.77317 0.12749,1.93138 0.11921,3.86839 -0.44216,5.72955 0,0 4.32362,-5.65785 4.32362,-5.65785 l 0,0 c 0.3595,-1.85435 0.27347,-3.74107 0.0878,-5.6147 -0.30015,-3.64562 -0.49691,-7.32684 -1.30362,-10.90386 -0.62037,-2.43924 -1.41164,-4.84433 -1.76227,-7.34327 0,0 -4.14759,6.01308 -4.14759,6.01308 z" />
    </g>

	</g>
			


	<!--Button 5: New rectangular creature-->
	
	<g id="CreateRect"
				onmouseout="setAttribute('fill-opacity','0.75')" onmouseover="setAttribute('fill-opacity','0.9')" onmousedown="createRect()";>
				<title>Create a rectangle! :)</title>
			
			<rect height="32" width="32" x="190" y="40" id="Button5" onmouseout="setAttribute('fill-opacity','0.5')" onmouseover="setAttribute('fill-opacity','1.0')" style="fill:red;stroke:pink"> <desc id="First button on toolbar! :)">A clickable square to test simple JavaScript.</desc>
			</rect>
			
			
			
    <g
       id="g4379">
      <path
         inkscape:connector-curvature="0"
         d="m 196,65 c 0.62488,-2.34949 1.41706,-4.64194 1.9962,-7.00388 0.74369,-3.54565 1.04609,-7.16208 1.24807,-10.77317 0.12749,-1.93138 0.11921,-3.86839 -0.44216,-5.72955 0,0 4.32362,5.65785 4.32362,5.65785 l 0,0 c 0.3595,1.85435 0.27347,3.74107 0.0878,5.6147 -0.30015,3.64562 -0.49691,7.32684 -1.30362,10.90386 -0.62037,2.43924 -1.41164,4.84433 -1.76227,7.34327 0,0 -4.14759,-6.01308 -4.14759,-6.01308 z"
         id="path4373"
         style="opacity:1;fill:#ff0000;stroke:#0000ff;stroke-width:0.24354082;stroke-miterlimit:4;stroke-dasharray:none" />
      <path
         style="opacity:1;fill:#ffff00;stroke:#0000ff;stroke-width:0.24354082;stroke-miterlimit:4;stroke-dasharray:none"
         id="path4375"
         d="m 216,65 c -0.62487,-2.34949 -1.41706,-4.64194 -1.9962,-7.00388 -0.74369,-3.54565 -1.04609,-7.16208 -1.24807,-10.77317 -0.12749,-1.93138 -0.11921,-3.86839 0.44216,-5.72955 0,0 -4.32362,5.65785 -4.32362,5.65785 l 0,0 c -0.3595,1.85435 -0.27347,3.74107 -0.0878,5.6147 0.30015,3.64562 0.49691,7.32684 1.30362,10.90386 0.62037,2.43924 1.41164,4.84433 1.76227,7.34327 0,0 4.14759,-6.01308 4.14759,-6.01308 z"
         inkscape:connector-curvature="0" />
    </g>
	
	</g>

	<!-- Button 6: New circular creature -->
			
	<g id="Create"
				onmouseout="setAttribute('fill-opacity','0.75')" onmouseover="setAttribute('fill-opacity','0.9')" onmousedown="create()";>
				<title>Create a circle! :)</title>
			
			<rect height="32" width="32" x="230" y="40" id="Button7" onmouseout="setAttribute('fill-opacity','0.5')" onmouseover="setAttribute('fill-opacity','1.0')" style="fill:blue;stroke:lightgreen"> <desc id="First button on toolbar! :)">A clickable square to test simple JavaScript.</desc>
			</rect>
			
			
			
			
			<g
       id="g4411">
      <path
         inkscape:connector-curvature="0"
         d="m 240,70 c 2.15738,-2.87358 4.02933,-5.97792 5.58282,-9.21883 0.40965,-0.85464 0.77204,-1.73116 1.15806,-2.59674 0.92857,-2.2163 1.57914,-4.52929 2.20773,-6.84326 0.35264,-1.29816 0.52081,-2.1214 1.01004,-3.38086 0.24992,-0.64338 0.55484,-1.26402 0.83226,-1.89603 0.34179,-0.66061 0.68358,-1.32123 1.02537,-1.98184 0,0 4.53032,-2.04296 4.53032,-2.04296 l 0,0 c -0.33011,0.64291 -0.66021,1.28582 -0.99031,1.92873 -0.25899,0.60814 -0.53843,1.20797 -0.77698,1.82442 -1.32045,3.41221 -2.02512,7.047 -3.50388,10.40524 -1.73774,3.99327 -3.68289,7.89361 -6.02239,11.57353 0,0 -5.05304,2.2286 -5.05304,2.2286 z"
         id="path4391"
         style="opacity:1;fill:#ffff00;stroke:#0000ff;stroke-width:0.74645996;stroke-miterlimit:4;stroke-dasharray:none" />
      <path
         style="opacity:1;fill:#ffff00;stroke:#0000ff;stroke-width:0.74645996;stroke-miterlimit:4;stroke-dasharray:none"
         id="path4393"
         d="m 238,43 c 1.4099,3.30514 3.16236,6.47846 5.19233,9.44427 0.53532,0.78209 1.11321,1.53419 1.66981,2.30128 1.45509,1.91232 3.13291,3.63223 4.82257,5.33358 0.94792,0.95448 1.57679,1.51174 2.42289,2.56515 0.43223,0.53813 0.81726,1.11252 1.22588,1.66878 0.40122,0.62631 0.80243,1.25261 1.20364,1.87891 0,0 -0.4959,4.94486 -0.4959,4.94486 l 0,0 c -0.39172,-0.60734 -0.78345,-1.21467 -1.17518,-1.822 -0.39716,-0.52836 -0.77691,-1.07028 -1.1915,-1.5851 -2.29483,-2.84964 -5.09032,-5.2773 -7.25926,-8.23707 -2.5894,-3.50156 -4.99462,-7.13627 -7.01178,-11.00229 0,0 0.5965,-5.49037 0.5965,-5.49037 z"
         inkscape:connector-curvature="0" />
      <path
         inkscape:connector-curvature="0"
         d="m 242,58 c -0.5499,1.28911 -1.23342,2.52681 -2.02517,3.68357 -0.20879,0.30504 -0.43419,0.59839 -0.65128,0.89757 -0.56753,0.74588 -1.22193,1.41669 -1.88096,2.08028 -0.36972,0.37227 -0.61499,0.58962 -0.945,1.00048 -0.16858,0.20989 -0.31876,0.43392 -0.47813,0.65088 -0.15649,0.24428 -0.31298,0.48856 -0.46947,0.73284 0,0 0.19342,1.92865 0.19342,1.92865 l 0,0 c 0.15279,-0.23688 0.30558,-0.47376 0.45836,-0.71064 0.15491,-0.20607 0.30302,-0.41744 0.46473,-0.61824 0.89505,-1.11145 1.98539,-2.05831 2.83134,-3.21272 1.00995,-1.36572 1.94807,-2.78338 2.73482,-4.29125 0,0 -0.23266,-2.14142 -0.23266,-2.14142 z"
         id="path4395"
         style="opacity:1;fill:#ffff00;stroke:#0000ff;stroke-width:0.29114342;stroke-miterlimit:4;stroke-dasharray:none" />
      <path
         style="opacity:1;fill:#ffff00;stroke:#0000ff;stroke-width:0.29114342;stroke-miterlimit:4;stroke-dasharray:none"
         id="path4397"
         d="m 248,52 c -0.84146,-1.12078 -1.57157,-2.33157 -2.17748,-3.59563 -0.15978,-0.33334 -0.30112,-0.67521 -0.45168,-1.01282 -0.36218,-0.86443 -0.61592,-1.76656 -0.86109,-2.66909 -0.13754,-0.50632 -0.20313,-0.82741 -0.39394,-1.31864 -0.0975,-0.25094 -0.21641,-0.493 -0.32462,-0.73951 -0.13331,-0.25766 -0.26661,-0.51532 -0.39992,-0.77299 0,0 -1.76697,-0.79682 -1.76697,-0.79682 l 0,0 c 0.12875,0.25077 0.25749,0.50152 0.38625,0.75227 0.10101,0.23719 0.21001,0.47115 0.30305,0.71159 0.51501,1.33086 0.78986,2.74855 1.36662,4.05838 0.67777,1.5575 1.43645,3.07876 2.34893,4.51404 0,0 1.97085,0.86922 1.97085,0.86922 z"
         inkscape:connector-curvature="0" />
    </g>
    
	</g>

	<!--Button 7: New ultral creature! :)-->
	
	<g id="CreateUltral"
				onmouseout="setAttribute('fill-opacity','0.75')" onmouseover="setAttribute('fill-opacity','0.9')" onmousedown="createUltral()";>
				<title>Create ultral creature! :)</title>
	
			<rect height="32" width="32" x="270" y="40" id="Button6" onmouseout="setAttribute('fill-opacity','0.5')" onmouseover="setAttribute('fill-opacity','1.0')" style="fill:brown;stroke:orange"> <desc id="First button on toolbar! :)">A clickable square to test simple JavaScript.</desc>
			</rect>

			
			    <g
       id="g4431">
      <path
         style="opacity:1;fill:#ff0000;stroke:#0000ff;stroke-width:0.74645996;stroke-miterlimit:4;stroke-dasharray:none"
         id="path4419"
         d="m 296,42 c -2.15738,2.87358 -4.02933,5.97792 -5.58282,9.21883 -0.40965,0.85464 -0.77204,1.73116 -1.15806,2.59674 -0.92857,2.2163 -1.57914,4.52929 -2.20773,6.84326 -0.35264,1.29816 -0.52081,2.1214 -1.01004,3.38086 -0.24992,0.64338 -0.55484,1.26402 -0.83226,1.89603 -0.34179,0.66061 -0.68358,1.32123 -1.02537,1.98184 0,0 -4.53032,2.04296 -4.53032,2.04296 l 0,0 c 0.33011,-0.64291 0.66021,-1.28582 0.99031,-1.92873 0.25899,-0.60814 0.53843,-1.20797 0.77698,-1.82442 1.32045,-3.41221 2.02512,-7.047 3.50388,-10.40524 1.73774,-3.99327 3.68289,-7.89361 6.02239,-11.57353 0,0 5.05304,-2.2286 5.05304,-2.2286 z"
         inkscape:connector-curvature="0" />
      <path
         inkscape:connector-curvature="0"
         d="m 295,70 c -1.4099,-3.30514 -3.16236,-6.47846 -5.19233,-9.44427 -0.53532,-0.78209 -1.11321,-1.53419 -1.66981,-2.30128 -1.45509,-1.91232 -3.13291,-3.63223 -4.82257,-5.33358 -0.94792,-0.95448 -1.57679,-1.51174 -2.42289,-2.56515 -0.43223,-0.53813 -0.81726,-1.11252 -1.22588,-1.66878 -0.40122,-0.62631 -0.80243,-1.25261 -1.20364,-1.87891 0,0 0.4959,-4.94486 0.4959,-4.94486 l 0,0 c 0.39172,0.60734 0.78345,1.21467 1.17518,1.822 0.39716,0.52836 0.77691,1.07028 1.1915,1.5851 2.29483,2.84964 5.09032,5.2773 7.25926,8.23707 2.5894,3.50156 4.99462,7.13627 7.01178,11.00229 0,0 -0.5965,5.49037 -0.5965,5.49037 z"
         id="path4421"
         style="opacity:1;fill:#ff0000;stroke:#0000ff;stroke-width:0.74645996;stroke-miterlimit:4;stroke-dasharray:none" />
    </g>
	
	</g>

	<!--Button 8: New extral creature! :)-->
			<!--button 8 exterior-->
			
	<g id="CreateExtral"
				onmouseout="setAttribute('fill-opacity','0.75')" onmouseover="setAttribute('fill-opacity','0.9')" onmousedown="createExtral()";>

				<a style="fill-opacity:0.75">
			<rect height="32" width="32" x="310" y="40" id="Button8" onmouseout="setAttribute('fill-opacity','0.5')" onmouseover="setAttribute('fill-opacity','1.0')" style="fill:purple;stroke:lightpurple"> <desc id="First button on toolbar! :)">Open Avril7! :)</desc><title>Create new extral creature! :)</title>
			</rect> </a> 


			<!--button 8 interior-->
			
				    <rect
       style="opacity:1;fill:#00ff00;stroke:#008000"
       id="rect4309"
       width="20"
       height="20"
       x="316"
       y="46" ><title>Create new extral creature! :)</title>
      <desc
         id="desc4311">Save icon</desc>
    </rect>

	</g>

	<!--Button 9: Navigate-->
			
		<!--button 9 exterior-->

<g id="Navigate"
			onmousedown="navigate()"
			onmouseout="setAttribute('fill-opacity','0.5')" onmouseover="setAttribute('fill-opacity','1.0')"
><title>Navigate areas! :)</title>

			<rect height="32" width="32" x="350" y="40" id="Button9ext" style="fill:blue;stroke:lightblue"> <desc id="First button on toolbar! :)"></desc>
			
</rect>
		
		
		<!--button 9 interior-->		
		
			<rect
       style="opacity:1;fill:#00ffff;stroke:#0000ff"
       id="rect4309"
       width="20"
       height="20"
       x="356"
       y="46">
      <desc
         id="desc4311">Save icon</desc>
    </rect>
</g>


<!--Button10: Touch-->

<g id="Touch"
		onmouseout="setAttribute('fill-opacity','0.75')" onmouseover="setAttribute('fill-opacity','0.9')" onmousedown="setTool('Touch')";>
<title>Touch creature! :)</title>		
			
			<rect height="32" width="32" x="390" y="40" id="Button10" style="fill:almond;stroke:vanilla;fill-opacity:0.75"> <desc id="First button on toolbar! :)">A clickable square to test simple JavaScript.</desc>
			</rect> 
			
			
			    <circle
       style="opacity:1;fill:#ffff00;stroke:#0000ff;stroke-width:1.03703701;stroke-miterlimit:4;stroke-dasharray:none"
       id="path4435"
       cx="406"
       cy="56"
       r="11.481482" />
</g>

			<p>New flow: Let's go! :)</p>
			
			</svg>
			
			</td>

			
			<!--CONTRIBUTIONS-->
			
			<td width="30%" valign="top">
			<p><strong>Contribute to the flow!</strong></p>

			<p></p>

			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"><input name="cmd" type="hidden" value="_s-xclick" /> <input name="hosted_button_id" type="hidden" value="7FS6H88GTKDQY" />
			<table>
				<tbody>
					<tr>
						<td><input name="on0" type="hidden" value="Add" />Add:</td>
					</tr>
					<tr>
						<td><select name="os0"><option value="Little niblet">Little niblet $1.00 USD</option><option value="Medium creature">Medium creature $2.00 USD</option><option value="Big beauty">Big beauty $5.00 USD</option> </select></td>
					</tr>
					<tr>
						<td><input name="on1" type="hidden" value="What do you want to feed life?" />What do you want to feed life?</td>
					</tr>
					<tr>
						<td><input maxlength="200" name="os1" type="text" /></td>
					</tr>
				</tbody>
			</table>
			<input name="currency_code" type="hidden" value="USD" /> <input alt="PayPal - The safer, easier way to pay online!" border="0" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" type="image" /> <img alt="" border="0" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" /></form>

			<p><strong>Subscribe to the flow!</strong></p>

			<p></p>

			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"><input name="cmd" type="hidden" value="_s-xclick" /> <input name="hosted_button_id" type="hidden" value="3VNCFPBM8JQM2" />
			<table>
				<tbody>
					<tr>
						<td><input name="on0" type="hidden" value="Add:" />Add:</td>
					</tr>
					<tr>
						<td><select name="os0"><option value="Little niblet">Little niblet : $1.00 USD - weekly</option><option value="Medium creature">Medium creature : $2.00 USD - weekly</option><option value="Big beauty">Big beauty : $5.00 USD - weekly</option> </select></td>
					</tr>
					<tr>
						<td><input name="on1" type="hidden" value="What do you want to feed life?" />What do you want to feed life?</td>
					</tr>
					<tr>
						<td><input maxlength="200" name="os1" type="text" /></td>
					</tr>
				</tbody>
			</table>
			<input name="currency_code" type="hidden" value="USD" /> <input alt="PayPal - The safer, easier way to pay online!" border="0" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" type="image" /> <img alt="" border="0" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" /></form>


			</td>
			<td width=30% valign="top">
			<p><strong>Rent a private flow area!</strong></p>
			
			<p></p>
			
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="H56HWNAV9S6Z6">
<table>
<tr><td><input type="hidden" name="on0" value="Size">Size</td></tr><tr><td><select name="os0">
	<option value="450 pixel x 450 pixel">450 pixel x 450 pixel : $10.00 USD - monthly</option>
	<option value="900 pixel x 450 pixel">900 pixel x 450 pixel : $15.00 USD - monthly</option>
	<option value="900 pixel x 900 pixel">900 pixel x 900 pixel : $20.00 USD - monthly</option>
</select> </td></tr>
<tr><td><input type="hidden" name="on1" value="Any special requests?">Any special requests?</td></tr><tr><td><input type="text" name="os1" maxlength="200"></td></tr>
</table>
<input type="hidden" name="currency_code" value="USD">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

			<p><a href="mailto:life@worldsowisdom.com?subject=Free LifeFLOW area"><img src="img/LifeFLOW.png"></p>
			
			<p>FREE LifeFLOW area - E-mail now!</a></p>
			
			</td>

			<td valign="top"><script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54b6d62b7a5579c7" async="async"></script>
			<div class="addthis_sharing_toolbox"></div>
			</td>
			
			<td valign="top" align="center">
			<p><strong>Ads</strong></p>
			<a href="http://eaglegamma.com/writing/el-burrito-que-queria-volar/"><img src="http://eaglegamma.com/wp-content/uploads/Burrito-front-300x193.png" width="160" /> El burrito que quer&iacute;a volar <br>Print Edition <br>200 Mexican pesos <br>$11.50 US</a></center>

			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"><input name="cmd" type="hidden" value="_s-xclick" /> <input name="hosted_button_id" type="hidden" value="HA5GGA9SNPZMN" /> <input alt="PayPal - The safer, easier way to pay online!" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" type="image" /> <img alt="" border="0" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" /></form>
			</td>
		</tr>

		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>

<p></p>

<p></p>

<p></p>

<p><h2 id="About">Welcome to LifeFLOW! :)</h2></p>

<p><b>LifeFLOW</b> is a fun evolving part of <a href="http://life.worldsowisdom.com/">Life Worlds O Wisdom (LifeWOW)</a>. It is kind of like a game, and kind of like nature! :)</p>

<p>You can think of LifeFLOW as a digital terrarium/aquarium, or "digitarium". We create and play with living electronic creatures who travel their environmental realms. How cool is that? :)</p>

<p>LifeFLOW is a little place where we can play with moving machines. Each of these creatures goes around the area exploring and playing. You can observe them move, interact with them by touching, cloning, creating, removing, and more. New features continue to become available. You can also navigate around many different areas. <strong>Please contribute something to the flow, and enjoy! :)</strong></p>

<p>For extra special creatures, we store information about them at <a href="http://life.worldsowisdom.com/?q=bank">LifeBANK</a>. This includes data like name and code, and metadata like imagery and what makes each creature so special.</p>

<p>A few tips: Use the blue square navigator to browse around the areas. Currently areas save every full period. We're still in the very early stages and welcome your comments on growth and development!</p>

<p>Some questions: What do you like or dislike about LifeFLOW? What do you want next? What do you think makes or would make LifeFLOW more useful, beautiful, interesting?</p>

<p>Contact: <a href="mailto:life@worldsowisdom.com?subject=LifeFLOW">life@worldsowisdom.com</a>! :)</p>

<p><h3 id="Music">Music</h3>
<p>Here is some music. Please let us know what else you would like! :)</p>
<iframe width="100%" height="450" scrolling="no" frameborder="no" src="http://www.bitlisten.com/"></iframe>
<iframe width="100%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/309714233&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>

</body>
</html>

