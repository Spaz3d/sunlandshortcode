jQuery(function($){
	$(document).ready(function(){			

	/* -----------------------------------------
		Custom jQuery Calendar Functions
	----------------------------------------- */
	var caleranStart, caleranEnd, startSelected = null, endSelected = null;

        var ondrawEvent = function (instance) {
            if (instance.globals.initComplete) {
                var reDraw = false;
                if (startSelected != instance.config.startDate || endSelected != instance.config.endDate) reDraw = true;
                instance.config.startDate = startSelected;
                instance.config.endDate = endSelected;
                if (reDraw) {
                    instance.reDrawCells();
                }
            }
        };

        var updateInputs= function () {
            if (startSelected && endSelected && startSelected.hasOwnProperty("_isAMomentObject") && endSelected.hasOwnProperty("_isAMomentObject")) {
                if (startSelected.isAfter(endSelected)) {
                    endSelected = startSelected.clone().add(1, "days");
                }
                caleranStart.config.startDate = startSelected;
                caleranStart.config.endDate = endSelected;
                caleranEnd.config.minDate = startSelected;
                caleranEnd.config.startDate = startSelected;
                caleranEnd.config.endDate = endSelected;
                caleranStart.$elem.val(startSelected.format(caleranStart.config.format));
                caleranEnd.$elem.val(endSelected.format(caleranEnd.config.format));
            }
        };

        // start always selects start date.
        $("#caleran-start").caleran({
        		minDate: moment(),
        		showHeader: false,
        		showFooter:false,
        		calendarCount: 1,
            oninit: function (instance) {
                instance.globals.delayInputUpdate = true;
                instance.$elem.val("");
                caleranStart = instance;
            },
            ondraw: ondrawEvent,
            onfirstselect: function (instance, start) {
                startSelected = start;
								endSelected = start;
                instance.globals.startSelected = false;
                updateInputs();
                instance.hideDropdown();
                caleranEnd.showDropdown();
            }
        });

        // end always selects end date.
        $("#caleran-end").caleran({
        	  showHeader: false,
        		showFooter:false,
        		calendarCount: 1,
            oninit: function (instance) {
                instance.globals.delayInputUpdate = true;
                instance.$elem.val("");
                caleranEnd = instance;
            },
            		ondraw: ondrawEvent,
            		onfirstselect: function (instance, start) {
                endSelected = start;
                instance.globals.startSelected = false;
                updateInputs();
                instance.hideDropdown();
            }
        });
 
			  // start always selects start date.
        $("#caleran-start-modal").caleran({
        		minDate: moment(),
        		showHeader: false,
        		showFooter:false,
        		calendarCount: 1,
            oninit: function (instance) {
                instance.globals.delayInputUpdate = true;
                instance.$elem.val("");
                caleranStart = instance;
            },
            ondraw: ondrawEvent,
            onfirstselect: function (instance, start) {
                startSelected = start;
								endSelected = start;
                instance.globals.startSelected = false;
                updateInputs();
                instance.hideDropdown();
                caleranEnd.showDropdown();
            }
        });

        // end always selects end date.
        $("#caleran-end-modal").caleran({
        	  showHeader: false,
        		showFooter:false,
        		calendarCount: 1,
            oninit: function (instance) {
                instance.globals.delayInputUpdate = true;
                instance.$elem.val("");
                caleranEnd = instance;
            },
            		ondraw: ondrawEvent,
            		onfirstselect: function (instance, start) {
                endSelected = start;
                instance.globals.startSelected = false;
                updateInputs();
                instance.hideDropdown();
            }
        });       
	/* -----------------------------------------
		Custom Select Boxes
	----------------------------------------- */
	var box = $(".dk");
	box.dropkick({
		theme: 'ci'
	});			

	}); // END doc ready
}); // END function ($)