function daisyWheel( textArray, arrayPlace, stringPlace, domNode, callback )
{

    var tempText = textArray[arrayPlace].split("");
    if ( stringPlace < tempText.length )
    {
        var delay = 2000/tempText.length;
        document.getElementById(domNode).innerHTML += tempText[stringPlace++];
        setTimeout(function(){daisyWheel(textArray, arrayPlace, stringPlace, domNode, callback)}, delay);
    }
    else if ( ++arrayPlace < textArray.length )
    {
        document.getElementById(domNode).appendChild(document.createElement("br"));
        setTimeout(function(){daisyWheel(textArray, arrayPlace, 0, domNode, callback)}, 100);
    }
    else
        callback();
}


