jQuery(document).ready(function(){
	   jQuery("#sname").focus(function(){	if( jQuery("#sname").val()=='Enter Your First Name') jQuery("#sname").val(''); });
	   jQuery("#sname").blur(function(){ if( jQuery("#sname").val()=='') jQuery("#sname").val('Enter Your First Name');  });
	   jQuery("#semail").focus(function(){	if( jQuery("#semail").val()=='Enter Your Email Address') jQuery("#semail").val(''); });
	   jQuery("#semail").blur(function(){ if( jQuery("#semail").val()=='') jQuery("#semail").val('Enter Your Email Address');  });
	   jQuery("#searchBox").focus(function(){	if( jQuery("#searchBox").val()=='Search...') jQuery("#searchBox").val(''); });
	   jQuery("#searchBox").blur(function(){ if( jQuery("#searchBox").val()=='') jQuery("#searchBox").val('Search...');  });	   
})