function showForm(data, idPrefix)
{

	var divs = document.getElementsByTagName("div"); 
	for( var i in divs ) {
		if ( closeElement("", divs[i]) )
			break;
	}
    
	var formbar = document.createElement("div");
	formbar.setAttribute("class", "formBar");
	var closeicon = document.createElement("div");
	closeicon.setAttribute("class", "closeParentDiv");
	//closeicon.innerHTML = "X";
        
	var innerdiv = document.createElement("div");
	innerdiv.setAttribute("id", idPrefix+"FormDiv");
	innerdiv.setAttribute("class", "overlayInner");
	innerdiv.innerHTML = data;
    
	var msgdiv = document.createElement("div");
	msgdiv.setAttribute("id", idPrefix+"MsgDiv");
	msgdiv.setAttribute("class", "msgDiv");
    
	var outerdiv = document.createElement("div");
	outerdiv.setAttribute("id", idPrefix+"DivOuter");
	outerdiv.setAttribute("class", "overlayOuter transparent");

	formbar.appendChild(closeicon);
	outerdiv.appendChild(formbar);
	outerdiv.appendChild(innerdiv);
	outerdiv.appendChild(msgdiv);
	document.body.appendChild(outerdiv);

	var inputs = document.getElementById(idPrefix+"FormDiv").getElementsByTagName("input"); 
	for( var i in inputs ) {
		if ( inputs[i].getAttribute )
			var type = inputs[i].getAttribute("type");
		else
			continue;
        
		if (  type == "submit" )
		{
			var form = outerdiv.getElementsByTagName("form");
			form = form[0];
			form.addEventListener("submit", xhrForm, false);
		}
	}
	closeicon.addEventListener('click', closeElement, false);
	fade(idPrefix+"DivOuter");
}

function closeElement(e, element)
{
	if ( element !== undefined )
	{
		if ( !element || element == document.body )
			return false;
		else if ( !element.getAttribute || !element.getAttribute("class") )
			return closeElement(e, element.parentNode);
		else if ( element.getAttribute("class").search(/overlayOuter/i) === -1 )
			return closeElement(e, element.parentNode);
		else 
		{
			element.parentNode.removeChild(element);
			return true;
		}
	}
	else if ( e && e.target )
		return closeElement(e, e.target);
	else 
		return false;
}
