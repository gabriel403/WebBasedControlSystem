

/*
 * 
 * xhrargs = {
 *      form: formId,
 *      action: actionDestination,
 *      data: {
 *          name: value,
 *          name2: value2
 *      },
 *      handleAs: json.
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

	var action = false;
	var data = [];
	if ( xhrargs.data )
		data = xhrargs.data;
		
	if ( xhrargs === undefined )
		throw "xhrargs needs to be supplied.";
    
	if ( xhrargs.form !== undefined )
	{
		if ( isString(xhrargs.form) )
			xhrargs.form = document.getElementById(xhrargs.form);
		if ( xhrargs.form.getAttribute("action").length > 0 )
			action = xhrargs.form.getAttribute("action");

		var inputs = xhrargs.form.getElementsByTagName("input");
		for ( var key in inputs ){
			if ( inputs[key].name )
				data.push(inputs[key].name + "=" + inputs[key].value);
		}
	}
	if ( xhrargs.action !== undefined )
		action = xhrargs.action;
	if ( !action )
		throw "No action supplied in xhrargs.";
    
    
	xhr.open("POST", action, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.setRequestHeader("X_REQUESTED_WITH", "XMLHTTPREQUEST");
    
    
	var requestTimer = setTimeout(function() {
		xhr.abort();
		if ( xhrargs.onerror !== undefined )
			xhrargs.onerror("Timeout was reached");
	}, 10000);
    
	if ( isArray(data) )
		data = data.join("&");
	console.log(data);
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
		{
			if ( xhrargs.handleAs && xhrargs.handleAs.search(/json/i) > -1)
				xhrargs.onload(JSON.parse(xhr.responseText));
			else
				xhrargs.onload(xhr.responseText);
		}
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


 