

/*
 * 
 * xhrargs = {
 *      form: formId,
 *      action: actionDestination,
 *      data: {
 *          name: value,
 *          name2: value2
 *      },
 *      onload: callbackfunc,
 *      onerror:callbackfunc
 * }
 * 
 * 
 */

function xhrPost(xhrargs)
{
    var xhr = xhrreq();
    if ( !xhr )
        throw "No xhr available.";

    var action;
    var data = [];
    if ( xhrargs === undefined )
        throw "xhrargs needs to be supplied.";
    
    if ( xhrargs.form !== undefined )
    {
        if ( document.getElementById(xhrargs.form) )
        {
            if ( xhrargs.action === undefined )
                if ( document.getElementById(xhrargs.form).action.length > 0 )
                    action = document.getElementById(xhrargs.form).action.length;
                else
                    action = xhrargs.action;
            var form = document.getElementById(xhrargs.form);
            var inputs = form.getElementsByTagName("input");
            for ( var key in inputs ){
                if ( inputs[key].name )
                    data.push(inputs.name + "=" + inputs.value);
            }
            data = data.join("&");
        }
    }
    else if ( xhrargs.action !== undefined )
        action = xhrargs.action;
    else
        throw "No action supplied in xhrargs.";
    
    xhr.open("POST", action, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.setRequestHeader("X_REQUESTED_WITH", "XMLHTTPREQUEST");
    
    
    var requestTimer = setTimeout(function() {
        xhr.abort();
        if ( xhrargs.onerror !== undefined )
            xhrargs.onerror("Timeout was reached");
    }, 10000);
    
    xhr.send(data);
    
    xhr.onreadystatechange = function()
    {                
        if(xhr.readyState != 4)
            return;
        clearTimeout(requestTimer);
        if (xhr.status != 200)  {
            if ( xhrargs.onerror !== undefined )
                xhrargs.onerror(xhr.responseText);
            return;
        }
        if ( xhrargs.onload !== undefined )
            xhrargs.onload(xhr.responseText);
    };
}

function xhrreq()
{
    var xhr=null;

    try{
        return new XMLHttpRequest();
    } catch(e) { }
    
    try {
        return new ActiveXObject("Msxml2.XMLHTTP");
    } 
    catch (e){ }
    
    try {
        return new ActiveXObject("Microsoft.XMLHTTP");
    } catch (e3) {
        throw "xhr not allowed";
        return null;
    }
}


 