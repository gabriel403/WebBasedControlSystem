function getForm(link)
{
    var idprefix = null;
    var href = link.getAttribute("href");
    if( href.split(/\//).length > 0)
        idprefix = href.split(/\//).pop();
    else 
        return true;
    xhrPost({
        action:href, 
        onload: function(data){showForm(data, idprefix)}
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
            onload: function(data){console.log(data);}
        });
//    else
//        this.submit();

}

function fadeinmenu(  )
{

    setTimeout("fade('topTitle')", 1000);
    setTimeout("fade('topMenu')", 1000);
}