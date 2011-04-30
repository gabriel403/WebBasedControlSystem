window.onload = onloadfunction;

var textArray = [];
var splitText = "";


function onloadfunction()
{
    textArray = ["Welcome to CTEC 3609.", "Telematics and Web Based Control Systems."];
    daisyWheel(textArray, 0, 0, "bottomText", fadeinmenu);
}

function changepage( )
{
    var href = window.location.href;
    href = href.replace("index","");
    //window.location = href+"FourOhThree";
}
