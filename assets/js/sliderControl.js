featuredcontentglider.init({
	gliderid: "featuredContent", //ID of main glider container
	contentclass: "slides", //Shared CSS class name of each glider content
	togglerid: "slideNav", //ID of toggler container
	remotecontent: "", //Get gliding contents from external file on server? "filename" or "" to disable
	selected: 0, //Default selected content index (0=1st)
	persiststate: false, //Remember last content shown within browser session (true/false)?
	speed: 500, //Glide animation duration (in milliseconds)
	direction: "rightleft", //set direction of glide: "updown", "downup", "leftright", or "rightleft"
	autorotate: true, //Auto rotate contents (true/false)?
	autorotateconfig: [8000/*2*/] //if auto rotate enabled, set [milliseconds_btw_rotations, cycles_before_stopping]
})