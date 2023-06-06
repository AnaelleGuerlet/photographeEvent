console.log('yo!');

function monModale(e) 
{
    el = document.getElementById("monModale");
    el.style.visibility = "visible";
}

function monModaleClose(e) 
{
    e = window.event || e;
    el = document.getElementById("monModale");
    if (e.target == el)
        el.style.visibility = "hidden";
}

function rien()
{
    return true;
}