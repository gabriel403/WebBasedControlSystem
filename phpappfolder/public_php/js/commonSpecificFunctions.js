function getForm(event)
{
	if (event.preventDefault) {
		event.preventDefault();
	} else if (window.event) /* for ie */ {
		window.event.returnValue = false;
	}
	link = event.target;
	var idprefix = null;
	var href = link.getAttribute("href");
	if( href.split(/\//).length > 0)
		idprefix = href.split(/\//).pop();
	else
		return true;
	xhrPost({
		action:href,
		onload: function(data){
			showForm(data, idprefix)
		}
	});
}

function xhrForm(eventObject)
{
	if (eventObject.preventDefault) {
		eventObject.preventDefault();
	} else if (window.event) /* for ie */ {
		window.event.returnValue = false;
	}
	if ( this.getAttribute("action") )
		xhrPost({
			action:this.getAttribute("action"),
			form: this,
			handleAs: "json",
			onload: processFormSubmittion
		});
//    else
//        this.submit();

}

function processFormSubmittion(data)
{
	var errors = 0;
	var firsterror = "";
	for ( var i in data )
	{
		if ( isString(data[i]) && i != "success" )
		{
			if ( document.getElementsByName(i).length > 0 )
				document.getElementsByName(i)[0].setAttribute("class", "formError");
			if ( 0 == errors )
				firsterror = data[i];
			errors++;
		}
	//		else if ( isString(data[i]) && i == "success" )
	//			if ( document.getElementsByName(i).length > 0 )
	//				document.getElementsByName(i)[0].setAttribute("class", "formSuccess");
	}
	if ( errors > 0 )
	{
		var divs = document.getElementsByTagName("div");
		for ( var x in divs )
		{
			if ( divs[x] && divs[x].getAttribute && divs[x].getAttribute("class") )
			{
				if (divs[x].getAttribute("class") == "msgDiv" )
				{
					if ( errors > 1 )
						divs[x].innerHTML = firsterror+"<br /> + "+errors+" more errors.";
					else
						divs[x].innerHTML = firsterror+"<br />";
				}
			}
		}
	}
	else {
		var divs = document.getElementsByTagName("div");
		for ( var x in divs )
		{
			
			if ( divs[x] && divs[x].getAttribute && divs[x].getAttribute("class") )
			{
				if (divs[x].getAttribute("class") == "msgDiv" )
				{
					divs[x].innerHTML = data["success"]+"<br />";
				}
				if ( divs[x].getAttribute("class") == "overlayInner" )
				{
					divs[x].setAttribute("class", "overlayInner formSuccess")
				}
			}
		}
		
	}
	if ( data['redirect'])
		window.location = data['redirect'];
}

function fadeinmenu(  )
{

	setTimeout("fade('topTitle')", 1000);
	setTimeout("fade('topMenu')", 1000);
	setTimeout("fade('welcomemessage')", 1000);
}