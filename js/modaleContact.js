console.log('yo!');
//début : popup de contact
function modaleContact(e) 
{
    el = document.getElementById("modaleContact");
    el.style.visibility = "visible";
}

function modaleContactClose(e) 
{
    e = window.event || e;
    el = document.getElementById("modaleContact");
    if (e.target == el)
        el.style.visibility = "hidden";
}

function rien()
{
    return true;
}
//fin : popup de contact


