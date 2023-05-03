(jQuery)(document).ready( function(){	
var buttons = { previous:(jQuery)('#jslidernews2 .button-previous') , next:(jQuery)('#jslidernews2 .button-next') };			 
(jQuery)('#jslidernews2').lofJSidernews( { interval:5000, easing:'easeInOutQuad', duration:1200, auto:true, mainWidth:640, mainHeight:300, navigatorHeight: 100, navigatorWidth: 340, maxItemDisplay:3, buttons:buttons } );	});
