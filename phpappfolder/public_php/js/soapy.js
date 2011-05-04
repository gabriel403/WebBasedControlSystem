window.onload = soapyonload;

function soapyonload() {
	var divs = document.getElementById("soapyDiv").getElementsByTagName("div");
	for ( var i = 0; i < divs.length; i++){
		if(divs[i].getAttribute("class") && divs[i].getAttribute("class").search("fakebutton") >= 0){
			divs[i].addEventListener("click", sendemail, false);
		}
	}
	fadeinmenu();
	setTimeout(getupdates, 30000);
}

function getupdates() {
		xhrPost({
		action:"/p07224405/index.php/soapy/soapyupdate/",
		handleAs: "json",
		onload: function(data){
			for ( var i = 0; i < data.length; i++ )
				document.getElementById("soapyDiv").innerHTML += data[i];
		}
	});
}

function sendemail(e) {
	var sendarray = [];
	var daddy = findthedaddy(e.target);
	if (!daddy)
		return;
	var daddydivs = daddy.getElementsByTagName("div");
	if ( !daddydivs )
		return;
	var mummydivs = document.getElementById("statusHeaders").getElementsByTagName("div");
	if ( !mummydivs )
		return;
	if ( daddydivs.length != mummydivs.length )
		return;
	for ( var i = 0; i < daddydivs.length; i++ )
	{
		var mymum = mummydivs[i].innerHTML;
		var mydad = daddydivs[i].innerHTML;
		sendarray.push(mymum+"="+mydad);//daddydivs[i];
	}
	if ( sendarray.length == 0 )
		return;
	var newone = [];
	newone.push("data="+sendarray.join(", "));
	xhrPost({
		action:"/p07224405/index.php/soapy/email/",
		data: newone,
		handleAs: "json",
		onload: emailSent
	});
	//		console.log(mummydivs[i].innerHTML.replace(" ", "_"));
	//		
}

function emailSent(data) {
	if ( false == data )
		alert("There was a problems sending your email. Probably due to no mail server being installed.");
}

function findthedaddy(element) {
	if( element.getAttribute("class") && element.getAttribute("class").search("statusgroup") >= 0 )
		return element;
	else if ( element == document.body )
		return null;
	else
		return findthedaddy(element.parentNode);
}