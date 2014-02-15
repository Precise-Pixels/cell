var myHeight;

if( typeof( window.innerWidth ) == 'number' ) { 

//Non-IE 

myHeight = window.innerHeight; 

} else if( document.documentElement && 

( document.documentElement.clientHeight ) ) { 

//IE 6+ in 'standards compliant mode' 

myHeight = document.documentElement.clientHeight; 

}

window.onload = function ()
{
  var primaryHeader = document.getElementById('primary-header');
  primaryHeader.style.height = myHeight - 40 + 'px'; 
} 