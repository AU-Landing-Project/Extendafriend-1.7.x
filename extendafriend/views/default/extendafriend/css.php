.extendafriendclear {
	clear:both;
	height: 1px;	
}

.extendafriendcloselink {
	display: block;
	text-align: center;	
}

.extendafriendcollectionlist {
	width: 170px;
	float: left;
	padding: 5px;	
}


/* ************************
	OVERLAY CSS
	*********************** */
	
/* the overlayed element */ 
.simple_overlay { 
     
    /* must be initially hidden */ 
    display:none; 
     
    /* place overlay on top of other elements */ 
    z-index:10000; 
     
    /* styling */ 
    background-color:#333; 
     
    width:675px;     
    min-height:200px; 
    border:1px solid #666; 
     
    /* CSS3 styling for latest browsers */ 
    -moz-box-shadow:0 0 90px 5px #000; 
    -webkit-box-shadow: 0 0 90px #000;     
} 
 
/* close button positioned on upper right corner */ 
.simple_overlay .close { 
    background-image:url(graphics/close.png); 
    position:absolute; 
    right:-15px; 
    top:-15px; 
    cursor:pointer; 
    height:35px; 
    width:35px; 
}

.modal { 
    background-color:#ffffff; 
    display:none; 
    width:600px; 
    padding:35px; 
    text-align:left; 
    border:3px solid #333333; 
 
    -moz-border-radius:8px; 
    -webkit-border-radius:8px;
    border-radius: 8px;  
} 

.modal a{
}