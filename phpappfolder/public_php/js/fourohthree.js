window.onload = onloadfunction;

var textArray = [];
var splitText = "";

function onloadfunction()
{
    textArray = ["403 ERROR 403", "You do not have permission to access this website.", "Please register or login by using the links above."];
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
    else
    {
        setTimeout("fade('topTitle')", 1000);
        setTimeout("fade('topMenu')", 1000);
    }
}
