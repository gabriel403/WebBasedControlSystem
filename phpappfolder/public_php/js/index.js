window.onload = onloadfunction;

var textArray = [];
var splitText = "";

function onloadfunction()
{
    textArray = ["Welcome to CTEC 3901.", "Telematics and Web Based Control Systems."];
    splitText = textArray[0].split("");
    setTimeout("splitTextOutput(0,0)",1000);
}

function splitTextOutput( splitPlace, textPlace )
{
    document.getElementById("bottomText").innerHTML += splitText[splitPlace];
    splitPlace++;
    if ( splitPlace < splitText.length )
        setTimeout("splitTextOutput("+splitPlace+", "+textPlace+")", 100);
    else if ( ++textPlace < textArray.length )
    {
        splitText = textArray[textPlace].split("");
        document.getElementById("bottomText").appendChild(document.createElement("br"));
        setTimeout("splitTextOutput(0, "+textPlace+")", 1000);
    }
}
