/**
 * @author owner
 */
var myLayout; // a var is required because this page utilizes: myLayout.allowOverflow() method

	$(document).ready(function () {

		// this layout could be created with NO OPTIONS - but showing some here just as a sample...
		// myLayout = $('body').layout(); -- syntax with No Options
		myLayout = $('body').layout({
		//	reference only - these options are NOT required because are already the 'default'
			closable:				true	// pane can open & close
		,	resizable:				true	// when open, pane can be resized 
		,	slidable:				true	// when closed, pane can 'slide' open over other panes - closes on mouse-out
		//	some resizing/toggling settings
		,	north__slidable:		false	// OVERRIDE the pane-default of 'slidable=true'
		,	north__togglerLength_closed: '100%'	// toggle-button is full-width of resizer-bar
		,	north__spacing_closed:	20		// big resizer-bar when open (zero height)
		,	south__resizable:		false	// OVERRIDE the pane-default of 'resizable=true'
		,	south__spacing_open:	0		// no resizer-bar when open (zero height)
		,	south__spacing_closed:	20		// big resizer-bar when open (zero height)
		//	some pane-size settings
		,	west__minSize:			100
		,	east__size:				300
		,	east__minSize:			200
		,	east__maxSize:			Math.floor(screen.availWidth / 2) // 1/2 screen width
		});

		// add event to the 'Close' button in the East pane dynamically...
		myLayout.addCloseBtn('#btnCloseEast', 'east');

		// add event to the 'Toggle South' buttons in Center AND South panes dynamically...
		myLayout.addToggleBtn('.south-toggler', 'south');

		// add MULTIPLE events to the 'Open All Panes' button in the Center pane dynamically...
		myLayout.addOpenBtn('#openAllPanes', 'north');
		myLayout.addOpenBtn('#openAllPanes', 'south');
		myLayout.addOpenBtn('#openAllPanes', 'west');
		myLayout.addOpenBtn('#openAllPanes', 'east');

 	});
