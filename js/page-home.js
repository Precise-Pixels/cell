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
    console.log(myHeight - 40);
  var primaryHeader = document.getElementById('primary-header');//.setAttribute("height","myHeight");
  primaryHeader.style.height = myHeight; 
} 