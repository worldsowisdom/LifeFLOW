			<div id="svgContainerCreatures">
			</div>


			<div id="svgContainerUI">
			</div>
			
			
			<svg xmlns="http://www.w3.org/2000/svg" width="450px" height="250px">

			
			<svg id="svg1" onload="Start(evt)" height="250" version="1.1" width="450" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			<script type="text/ecmascript">
			
   <![CDATA[

   //This begins the JavaScript code for LifeFLOW! :)
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

	var test12345 = "debugdata"; //test stuff
	var test23456 = "debugdata2"; //test stuff
		
		
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
		if (creature_index > 1) {
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
		if (creature_index > 1) {
			
			//if any other creatures, find the nearest creature and chase it! :)
			var nearestNeighbor = getNearestNeighbor(creature_name); // get (index of) nearbyest neighbor
			//getNearestNeighbor(creature_name);
			//iterate through creature_array[] and measure distance difference
				//measure vector distance, only keep the smallest
			//mv to a location between them
			x = (document.getElementById(creature_name).getBoundingClientRect().x - creature_array[nearestNeighbor].getBoundingClientRect().x) / 2 * Math.random();// mv somewhere between creature_name and nearestNeighbor
			y = (document.getElementById(creature_name).getBoundingClientRect().y - creature_array[nearestNeighbor].getBoundingClientRect().y) / 2 * Math.random();// mv somewhere between creature_name and nearestNeighbor

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
	
	function moveSmoothyCreature(creature_name, x, y) {
		//another take at improving creature personality
		
		//do any preprocessing
		//here we should probably check for nearby creatures, and move somewhere along the way to the closest.
		if (creature_index > 1) {
			
			//if any other creatures, find the nearest creature and chase it! :)
			var nearestNeighbor = getNearestNeighbor(creature_name); // get (index of) nearbyest neighbor
			//getNearestNeighbor(creature_name);
			//iterate through creature_array[] and measure distance difference
				//measure vector distance, only keep the smallest
			//mv to a location between them
		test12345 = (document.getElementById(creature_name).getBoundingClientRect().x);
		test23456 = creature_array[nearestNeighbor];//(creature_array[nearestNeighbor].getBoundingClientRect().x);
		
		//test12345 = (document.getElementById(creature_name).getBoundingClientRect().x - creature_array[nearestNeighbor].getBoundingClientRect().x);
//debug			if (Math.random() < 0.5) {x = document.getElementById(creature_name).getBoundingClientRect().x + 0.001} else {x = document.getElementById(creature_name).getBoundingClientRect().x - 0.001};
//debug			if (Math.random() < 0.5) {y = document.getElementById(creature_name).getBoundingClientRect().y + 0.001} else {y = document.getElementById(creature_name).getBoundingClientRect().y - 0.001};
//new			if ((document.getElementById(creature_name).getBoundingClientRect().x - creature_array[nearestNeighbor].getBoundingClientRect().x) < 0) {x = document.getElementById(creature_name).getBoundingClientRect().x * 0.001} else {x = document.getElementById(creature_name).getBoundingClientRect().x - 0.001};
//new			if ((document.getElementById(creature_name).getBoundingClientRect().y - creature_array[nearestNeighbor].getBoundingClientRect().y) < 0) {y = document.getElementById(creature_name).getBoundingClientRect().y / 0.001} else {y = document.getElementById(creature_name).getBoundingClientRect().y - 0.001};
			x = ((document.getElementById(creature_name).getBoundingClientRect().x + creature_array[nearestNeighbor].getBoundingClientRect().x) / 2 * Math.random());// mv somewhere between creature_name and nearestNeighbor
			y = ((document.getElementById(creature_name).getBoundingClientRect().y + creature_array[nearestNeighbor].getBoundingClientRect().y) / 2 * Math.random());// mv somewhere between creature_name and nearestNeighbor

		} //if other creatures (else just wander randomly)
		
		else {
		//update x and y
		
		
		x = x * document.getElementById(creature_name).getBoundingClientRect().x / 5 + 20*Math.random(); // update x
		y = y + document.getElementById(creature_name).getBoundingClientRect().y / 2 + 10*Math.random(); // update y
/*orig		x = x + document.getElementById(creature_name).getBoundingClientRect().x + 5; // update x
		y = y + document.getElementById(creature_name).getBoundingClientRect().y + 5; // update y
*/
		} // else wander around if no other creatures nearby
		
		//translate creature_name x y
		document.getElementById(creature_name).setAttribute("transform", "translate("+x+", "+y+")"); // transform the creature
			//now just make it relative to current position or o creature etc., instead of origin.
			
		
		
		
		
	}
	
	function moveCoolCreature(creature_name, x, y) {
		//another take at improving creature personality
		
		//do any preprocessing
		
		var coolMode = 0; // give cool creature a mode, default to 0
		
		//here we should probably check for nearby creatures, and move somewhere along the way to the closest.
		if (creature_index > 1) {
			if (coolMode == 0) {
				//if any other creatures, find the nearest creature and chase it! :)
				var nearestNeighbor = getNearestNeighbor(creature_name); // get (index of) nearbyest neighbor
				//getNearestNeighbor(creature_name);
				//iterate through creature_array[] and measure distance difference
					//measure vector distance, only keep the smallest
				//mv to a location between them
			test12345 = (document.getElementById(creature_name).getBoundingClientRect().x);
			test23456 = creature_array[nearestNeighbor];//(creature_array[nearestNeighbor].getBoundingClientRect().x);
			
			//test12345 = (document.getElementById(creature_name).getBoundingClientRect().x - creature_array[nearestNeighbor].getBoundingClientRect().x);
	//debug			if (Math.random() < 0.5) {x = document.getElementById(creature_name).getBoundingClientRect().x + 0.001} else {x = document.getElementById(creature_name).getBoundingClientRect().x - 0.001};
	//debug			if (Math.random() < 0.5) {y = document.getElementById(creature_name).getBoundingClientRect().y + 0.001} else {y = document.getElementById(creature_name).getBoundingClientRect().y - 0.001};
	//new			if ((document.getElementById(creature_name).getBoundingClientRect().x - creature_array[nearestNeighbor].getBoundingClientRect().x) < 0) {x = document.getElementById(creature_name).getBoundingClientRect().x * 0.001} else {x = document.getElementById(creature_name).getBoundingClientRect().x - 0.001};
	//new			if ((document.getElementById(creature_name).getBoundingClientRect().y - creature_array[nearestNeighbor].getBoundingClientRect().y) < 0) {y = document.getElementById(creature_name).getBoundingClientRect().y / 0.001} else {y = document.getElementById(creature_name).getBoundingClientRect().y - 0.001};
				x = (((document.getElementById(creature_name).getBoundingClientRect().x + creature_array[nearestNeighbor].getBoundingClientRect().x) / 2) * 0.3 + 0.1*(document.getElementById(creature_name).getBoundingClientRect().x - document.getElementById(creature_name).getAttribute("x")));// mv somewhere between creature_name and nearestNeighbor
				y = ((document.getElementById(creature_name).getBoundingClientRect().y + creature_array[nearestNeighbor].getBoundingClientRect().y) / 2 * 0.3);// mv somewhere between creature_name and nearestNeighbor

			} //do mode0 stuff
		} //if other creatures (else just wander randomly)
		
		
		
		else {
		//update x and y
		
		
		x = x * document.getElementById(creature_name).getBoundingClientRect().x / 5 + 20*Math.random(); // update x
		y = y + document.getElementById(creature_name).getBoundingClientRect().y / 2 + 10*Math.random(); // update y
/*orig		x = x + document.getElementById(creature_name).getBoundingClientRect().x + 5; // update x
		y = y + document.getElementById(creature_name).getBoundingClientRect().y + 5; // update y
*/
		} // else wander around if no other creatures nearby
		
		//translate creature_name x y
		document.getElementById(creature_name).setAttribute("transform", "translate("+x+", "+y+") rotate(2"+time*Math.random()+")"); // transform the creature
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

	
	function createSmoothy() {
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

		var creature_desc = document.createTextNode("moveSmoothyCreature(\""+creature_name+"\", 1, 1)"); // make it flutter about like some kind of insect or bacterium

//b4smoothy		var creature_desc = document.createTextNode("document.getElementById(\""+creature_name+"\").setAttribute(\"transform\", \"translate(\"+33*Math.random()+\", \"+50*Math.random()+\")\");"); // creature_desc describes the creature's AI or movements. (Start with hard-coded, eventually refer to AI data.
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
		
		var x_new = 0; // create random starting x
		var y_new = 0; // create random starting y
//orig		var x_new = Math.random()*450; // create random starting x
//orig		var y_new = Math.random()*450; // create random starting y
		
		
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
		var creature_desc = document.createTextNode("moveCoolCreature(\""+creature_name+"\", 1, 1)"); // make it flutter about like some kind of insect or bacterium
//b4smootheningcool 	var creature_desc = document.createTextNode("document.getElementById(\""+creature_name+"\").setAttribute(\"transform\", \"translate(\"+document.getElementById(\""+creature_name+"\").getAttribute(\"x\")*time/max_time*5+\", \"+document.getElementById(\""+creature_name+"\").getAttribute(\"height\")*time/max_time*Math.sqrt(5)+\")\");"); // creature_desc describes the creature's AI or movements. (Start with hard-coded, eventually refer to AI data.
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