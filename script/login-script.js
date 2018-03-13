

window.onclick = function(event) {
    if (event.target == document.getElementById("login-start")) 
        document.body.style.overflow = "hidden";

    else if (event.target == document.getElementById("login-stop"))
        document.body.style.overflow = "auto";
}