window.onload = onloadfunction;

var textArray = [];
var splitText = "";

function onloadfunction()
{
    textArray = ["403 ERROR 403", "You do not have permission to access this website.", "Please register or login by using the links above."];
    daisyWheel(textArray, 0, 0, "bottomText", fadeinmenu);
}

function fadeinmenu(  )
{

    setTimeout("fade('topTitle')", 1000);
    setTimeout("fade('topMenu')", 1000);
}

function getRegForm()
{
    xhrPost({action: "registration"});
}