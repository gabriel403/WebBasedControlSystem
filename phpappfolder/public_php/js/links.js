function linkInits() {

    var links = document.getElementById("topMenu").getElementsByTagName("a");
    var i = 0;
    for ( i = 0; i <links.length; i++ )
    {
        links[i].addEventListener("click", getForm, false);
    }
}
