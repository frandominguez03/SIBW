/* Función que muestra los comentarios y el formulario para comentar */
function CajaComentarios() {
    document.getElementById('comentarios').style.display = 'block'
}

/* Función para comentar */
function Comentar() {
    /* Llamamos a la función para comprobar los campos, y si cualquiera de ellos está vacío, no se sigue con la ejecución de la función */
    var r = required()

    if(r === false){
        return false
    }

    /* Lo mismo para el email, si no es válido, no se sigue con la ejecución */
    var e = ValidarEmail(document.forms["formulario"]["email"].value)
    
    if(e === false){
        return false
    }

    /* Las variables que nos hacen falta para añadir al cajón de comentarios */
    var nombre = document.forms["formulario"]["nombre"].value
    var comen = document.forms["formulario"]["comentario"].value

    /* Creamos una variable fecha con la fecha actual */
    var fecha = new Date()

    /* Formateamos el año como queremos para después usarlo */
    var ano = new Intl.DateTimeFormat('es', { year: 'numeric'}).format(fecha)

    /* Lo mismo para el día y la hora */
    var dia = new Intl.DateTimeFormat('es', { day: '2-digit'}).format(fecha)
    var hora = new Intl.DateTimeFormat('es', { hour: 'numeric', minute: 'numeric'}).format(fecha)

    /* Hay que hacer algo de magia para que la primera letra del mes la saque en mayúscula. Por defecto no lo hace.
    Lo que estoy haciendo es, crear una variable mes que simplemente contiene el mes formateado al español y en formato largo.
    Luego creo una variable mesUpper que lo que hace es poner en mayúsculas el primer caracter de la variable mes.
    A esa nueva variable le tengo que concatenar el resto de la variable mes, y eso se hace usando la función slice() que parte
    la variable mes a partir del primer caracter. Un ejemplo:
    mes = marzo
    mesUpper = M + arzo = Marzo */
    var mes = new Intl.DateTimeFormat('es', { month: 'long'}).format(fecha)
    var mesUpper = mes[0].toUpperCase() + mes.slice(1)

    /* Ahora lo que hacemos es obtener el elemtno con la ID de nuestra caja de comentarios y le añadimos (por eso el operador +=) a su HTML
    el comentario que nos acaban de enviar, que ya sabemos que está validado */
    document.getElementById("defaultcomm").innerHTML += '<div id="comen3"> <p><strong> ' + nombre + '</strong></p> <p><em>' + dia + ' de ' + mesUpper + ' de ' + ano + ', ' + hora + '</em></p> <p> ' + comen + '</p></div><hr>'
}

/* Función para mostrar alertas si uno de los campos se queda sin rellenar */
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

/* Función para la validación del campo de correo electrónico */
function ValidarEmail(mail) 
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
  {
    return true
  }
    alert("La dirección de correo electrónico no sigue un formato válido: nombre@mail.com")
    return false
}

/* Función para la censura de palabras a la vez que se escribe */
function censura() {
    const CENSURA = '*'
    var palabras = document.getElementById("palabras").value.match(/[a-z'\-]+/gi)
    var fraseNormal = document.forms["formulario"]["comentario"].value
    var frase = document.forms["formulario"]["comentario"].value.match(/[a-z'\-]+/gi)
    var separadas = []
    var frasefinal = fraseNormal

    for(i = 0; i < frase.length; i++){
        separadas.push(String(frase[i]))
    }

    for(j = 0; j < palabras.length; j++){
        var encontrada = separadas.indexOf(String(palabras[j]))

        if(encontrada != -1){
            frasefinal = fraseNormal.replace(separadas[encontrada], CENSURA.repeat(separadas[encontrada].length))
        }
    }

    document.forms["formulario"]["comentario"].value = frasefinal
}