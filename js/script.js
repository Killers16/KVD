function changeMode() {
    var element = document.body;
    element.classList.toggle("dark-mode");
}
function change() // no ';' here
{
    var elem = document.getElementById("Mode");
    if (elem.value=="Night Mode") elem.value = "Light Mode";
    else elem.value = "Night Mode";
}