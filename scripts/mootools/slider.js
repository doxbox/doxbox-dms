var imgInfoState_0 = 0;
var imgInfoState_1 = 0;

var imgNewsState_0 = 0;
var imgNewsState_1 = 0;

var imgRevState_0 = 0;
var imgRevState_1 = 0;

var imgDLState = 0;
var imgHDState = 0;
var imgBFState = 0;
var imgCBState = 0;
var imgTNState = 0;
var imgCSState = 0;
var imgPDState = 0;
var imgTCState = 0;
var imgDPState = 0;
var imgLSState = 0;
var imgSRState = 0;
var imgOSState = 0;
var imgPLState = 0;
var imgTOOLSState = 0;
var imgEmailState = 0;

window.addEvent('domready', function() {



if (document.getElementById('e_slide'))
{
       var EmailSlide = new Fx.Slide('e_slide');
   
       EmailSlide.open = true;
       EmailSlide.toggle();


        $('e_toggle').addEvent('click', function(){

        if (imgEmailState == 0)
        {
           document.getElementById('e_slide').style.display = 'block';
           EmailSlide.open = false;
           imgEmailState = 1;
        }
        else
        {
           imgEmailState = 0;
           EmailSlide.open = true;
        }

        EmailSlide.toggle();
    }); 
}


if (document.getElementById('newsinfo_slide_0'))
{
	var NewsInfoSlide_0 = new Fx.Slide('newsinfo_slide_0');

	NewsInfoSlide_0.open = true;
	NewsInfoSlide_0.toggle();


	$('newsinfo_toggle_0').addEvent('click', function(){
		if (imgNewsState_0 == 0)
		{
                   document.getElementById('newsinfo_slide_0').style.display = 'block';
	           NewsInfoSlide_0.open = false;
		   imgNewsState_0 = 1;
		}
		else
		{
		   imgNewsState_0 = 0;
	           NewsInfoSlide_0.open = true;
		}

		NewsInfoSlide_0.toggle();
	});

}

if (document.getElementById('newsinfo_slide_1'))
{
	var NewsInfoSlide_1 = new Fx.Slide('newsinfo_slide_1');

	NewsInfoSlide_1.open = true;
	NewsInfoSlide_1.toggle();


	$('newsinfo_toggle_1').addEvent('click', function(){
		if (imgNewsState_1 == 0)
		{
                   document.getElementById('newsinfo_slide_1').style.display = 'block';
	           NewsInfoSlide_1.open = false;
		   imgNewsState_1 = 1;
		}
		else
		{
		   imgNewsState_1 = 0;
	           NewsInfoSlide_1.open = true;
		}

		NewsInfoSlide_1.toggle();
	});

}

if (document.getElementById('fileinfo_slide_0'))
{
	var FileInfoSlide_0 = new Fx.Slide('fileinfo_slide_0');

	FileInfoSlide_0.open = true;
	FileInfoSlide_0.toggle();


	$('fileinfo_toggle_0').addEvent('click', function(){
		if (imgInfoState_0 == 0)
		{
                   document.getElementById('fileinfo_slide_0').style.display = 'block';
	           FileInfoSlide_0.open = false;
		   imgInfoState_0 = 1;
		}
		else
		{
		   imgInfoState_0 = 0;
	           FileInfoSlide_0.open = true;
		}

		FileInfoSlide_0.toggle();
	});

}

if (document.getElementById('fileinfo_slide_1'))
{
	var FileInfoSlide_1 = new Fx.Slide('fileinfo_slide_1');

	FileInfoSlide_1.open = true;
	FileInfoSlide_1.toggle();


	$('fileinfo_toggle_1').addEvent('click', function(){
		if (imgInfoState_1 == 0)
		{
           document.getElementById('fileinfo_slide_1').style.display = 'block';
	       FileInfoSlide_1.open = false;
		   imgInfoState_1 = 1;
		}
		else
		{
		   imgInfoState_1 = 0;
	       FileInfoSlide_1.open = true;
		}

		FileInfoSlide_1.toggle();
	});

}

if (document.getElementById('peerrev_slide_0'))
{
	var PeerRevSlide_0 = new Fx.Slide('peerrev_slide_0');

	PeerRevSlide_0.open = true;
	PeerRevSlide_0.toggle();


	$('peerrev_toggle_0').addEvent('click', function(){
		if (imgRevState_0 == 0)
		{
                   document.getElementById('peerrev_slide_0').style.display = 'block';
	           PeerRevSlide_0.open = false;
		   imgRevState_0 = 1;
		}
		else
		{
		   imgRevState_0 = 0;
	           PeerRevSlide_0.open = true;
		}

		PeerRevSlide_0.toggle();
	}); 

}

if (document.getElementById('peerrev_slide_1'))
{
	var PeerRevSlide_1 = new Fx.Slide('peerrev_slide_1');

	PeerRevSlide_1.open = true;
	PeerRevSlide_1.toggle();


	$('peerrev_toggle_1').addEvent('click', function(){
		if (imgRevState_1 == 0)
		{
                   document.getElementById('peerrev_slide_1').style.display = 'block';
	           PeerRevSlide_1.open = false;
		   imgRevState_1 = 1;
		}
		else
		{
		   imgRevState_1 = 0;
	           PeerRevSlide_1.open = true;
		}

		PeerRevSlide_1.toggle();
	}); 

}

if (document.getElementById('hd_slide'))
{
    var HDSlide = new Fx.Slide('hd_slide');

    HDSlide.open = true;
    HDSlide.toggle();


    $('hd_toggle').addEvent('click', function(){
        if (imgHDState == 0)
        {
           document.getElementById('hd_slide').style.display = 'block';
           HDSlide.open = false;
           imgHDState = 1;
        }
        else
        {
           imgHDState = 0;
           HDSlide.open = true;
        }

        HDSlide.toggle();
    });

}

if (document.getElementById('bf_slide'))
{
    var BFSlide = new Fx.Slide('bf_slide');

    BFSlide.open = true;
    BFSlide.toggle();


    $('bf_toggle').addEvent('click', function(){
        if (imgBFState == 0)
        {
           document.getElementById('bf_slide').style.display = 'block';
           BFSlide.open = false;
           imgBFState = 1;
        }
        else
        {
           imgBFState = 0;
           BFSlide.open = true;
        }

        BFSlide.toggle();
    });

}


if (document.getElementById('cb_slide'))
{
    var CBSlide = new Fx.Slide('cb_slide');

    CBSlide.open = true;
    CBSlide.toggle();


    $('cb_toggle').addEvent('click', function(){
        if (imgCBState == 0)
        {
           document.getElementById('cb_slide').style.display = 'block';
           CBSlide.open = false;
           imgCBState = 1;
        }
        else
        {
           imgCBState = 0;
           CBSlide.open = true;
        }

        CBSlide.toggle();
    });

}


if (document.getElementById('tn_slide'))
{
    var TNSlide = new Fx.Slide('tn_slide');

    TNSlide.open = true;
    TNSlide.toggle();


    $('tn_toggle').addEvent('click', function(){
        if (imgTNState == 0)
        {
           document.getElementById('tn_slide').style.display = 'block';
           TNSlide.open = false;
           imgTNState = 1;
        }
        else
        {
           imgTNState = 0;
           TNSlide.open = true;
        }

        TNSlide.toggle();
    });

}


if (document.getElementById('cs_slide'))
{
    var CSSlide = new Fx.Slide('cs_slide');

    CSSlide.open = true;
    CSSlide.toggle();


    $('cs_toggle').addEvent('click', function(){
        if (imgCSState == 0)
        {
           document.getElementById('cs_slide').style.display = 'block';
           CSSlide.open = false;
           imgCSState = 1;
        }
        else
        {
           imgCSState = 0;
           CSSlide.open = true;
        }

        CSSlide.toggle();
    });

}


if (document.getElementById('pd_slide'))
{
    var PDSlide = new Fx.Slide('pd_slide');

    PDSlide.open = true;
    PDSlide.toggle();


    $('pd_toggle').addEvent('click', function(){
        if (imgPDState == 0)
        {
           document.getElementById('pd_slide').style.display = 'block';
           PDSlide.open = false;
           imgPDState = 1;
        }
        else
        {
           imgPDState = 0;
           PDSlide.open = true;
        }

        PDSlide.toggle();
    });

}


if (document.getElementById('os_slide'))
{
    var OSSlide = new Fx.Slide('os_slide');

    OSSlide.open = true;
    OSSlide.toggle();


    $('os_toggle').addEvent('click', function(){
        if (imgOSState == 0)
        {
           document.getElementById('os_slide').style.display = 'block';
           OSSlide.open = false;
           imgOSState = 1;
        }
        else
        {
           imgOSState = 0;
           OSSlide.open = true;
        }

        OSSlide.toggle();
    });

}


if (document.getElementById('tc_slide'))
{
    var TCSlide = new Fx.Slide('tc_slide');

    TCSlide.open = true;
    TCSlide.toggle();


    $('tc_toggle').addEvent('click', function(){
        if (imgTCState == 0)
        {
           document.getElementById('tc_slide').style.display = 'block';
           TCSlide.open = false;
           imgTCState = 1;
        }
        else
        {
           imgTCState = 0;
           TCSlide.open = true;
        }

        TCSlide.toggle();
    });

}


if (document.getElementById('dp_slide'))
{
    var DPSlide = new Fx.Slide('dp_slide');

    DPSlide.open = true;
    DPSlide.toggle();


    $('dp_toggle').addEvent('click', function(){
        if (imgDPState == 0)
        {
           document.getElementById('dp_slide').style.display = 'block';
           DPSlide.open = false;
           imgDPState = 1;
        }
        else
        {
           imgDPState = 0;
           DPSlide.open = true;
        }

        DPSlide.toggle();
    });

}


if (document.getElementById('ls_slide'))
{
    var LSSlide = new Fx.Slide('ls_slide');

    LSSlide.open = true;
    LSSlide.toggle();


    $('ls_toggle').addEvent('click', function(){
        if (imgLSState == 0)
        {
           document.getElementById('ls_slide').style.display = 'block';
           LSSlide.open = false;
           imgLSState = 1;
        }
        else
        {
           imgLSState = 0;
           LSSlide.open = true;
        }

        LSSlide.toggle();
    });

}


if (document.getElementById('sr_slide'))
{
    var SRSlide = new Fx.Slide('sr_slide');

    SRSlide.open = true;
    SRSlide.toggle();


    $('sr_toggle').addEvent('click', function(){
        if (imgSRState == 0)
        {
           document.getElementById('sr_slide').style.display = 'block';
           SRSlide.open = false;
           imgSRState = 1;
        }
        else
        {
           imgSRState = 0;
           SRSlide.open = true;
        }

        SRSlide.toggle();
    });

}


if (document.getElementById('pl_slide'))
{
    var PLSlide = new Fx.Slide('pl_slide');

    PLSlide.open = true;
    PLSlide.toggle();


    $('pl_toggle').addEvent('click', function(){
        if (imgPLState == 0)
        {
           document.getElementById('pl_slide').style.display = 'block';
           PLSlide.open = false;
           imgPLState = 1;
        }
        else
        {
           imgPLState = 0;
           PLSlide.open = true;
        }

        PLSlide.toggle();
    });

}


if (document.getElementById('tools_slide'))
{
    var TOOLSSlide = new Fx.Slide('tools_slide');

    TOOLSSlide.open = true;
    TOOLSSlide.toggle();


    $('tools_toggle').addEvent('click', function(){
        if (imgTOOLSState == 0)
        {
           document.getElementById('tools_slide').style.display = 'block';
           TOOLSSlide.open = false;
           imgTOOLSState = 1;
        }
        else
        {
           imgTOOLSState = 0;
           TOOLSSlide.open = true;
        }

        TOOLSSlide.toggle();
    });

}

if (document.getElementById('dl_slide'))
{
    var DLSlide = new Fx.Slide('dl_slide');

    DLSlide.open = true;
    DLSlide.toggle();


    $('dl_toggle').addEvent('click', function(){
        if (imgDLState == 0)
        {
           document.getElementById('dl_slide').style.display = 'block';
           DLSlide.open = false;
           imgDLState = 1;
        }
        else
        {
           imgDLState = 0;
           DLSlide.open = true;
        }

        DLSlide.toggle();
    });

}

});

