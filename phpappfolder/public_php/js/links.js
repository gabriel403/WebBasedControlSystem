function linkInits() {

	var links = document.getElementById("topMenu").getElementsByTagName("a");
	var i = 0;
	for ( i = 0; i <links.length; i++ )
	{
		if( links[i] && links[i].getAttribute && links[i].getAttribute("class") && links[i].getAttribute("class") == "formlink" )
			links[i].addEventListener("click", getForm, false);
	}
}
