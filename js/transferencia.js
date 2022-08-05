
function formula() {
    var CantidadT = parseInt(document.getElementById('cantidad').value);
    var Cantidad1 = parseInt(document.getElementById('cuenta1').value);
    var Cantidad2 = parseInt(document.getElementById('cuenta2').value);
    document.getElementById('cuenta1').value = (Cantidad1 - CantidadT);
    document.getElementById('cuenta2').value = (Cantidad2 + CantidadT);
}
