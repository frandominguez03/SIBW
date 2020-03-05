function Comentar(element) {
    document.getElementById('comentarios').style.display = 'block'
}

function required() {
    var nombre = document.forms["formulario"]["nombre"].value
    var email = document.forms["formulario"]["email"].value
    var comen = document.forms["formulario"]["comentario"].value

    if(nombre == null || nombre == ""){
        alert("Es necesario rellenar el campo del nombre")
        return false
    }

    if(email === null || email == ""){
        alert("Es necesario rellenar el campo del email")
        return false
    }

    if(comen === null || comen === ""){
        alert("Es necesario rellenar el campo del comentario")
        return false
    }
}