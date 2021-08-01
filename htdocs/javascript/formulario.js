function obtenerPalabrotas(){
  var respuesta="";
  var chain="";
  var respuestaAsterisco=[];
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(this.readyState == 4 && this.status == 200) {
      respuesta = JSON.parse(this.responseText);
      // respuesta = respuesta.split(',');
      document.getElementById("palabrotas").innerHTML = respuesta;
      const tam = respuesta.length;
      for(var i=0;i<tam;i++){
        for(var j=0;j< respuesta[i].length;j++){
          chain = chain + '*';
        }
        respuestaAsterisco.push(chain);
        chain = "";
      }
      document.getElementById("palabrotas_asteriscos").innerHTML = respuestaAsterisco;
    }
  }
  xhttp.open("GET", "/obtenerPalabrotas.php", true);
  xhttp.send();
}


function comprobarPalabras(){
  var palabras_prohibidas = document.getElementById("palabrotas").innerHTML;
  palabras_prohibidas = palabras_prohibidas.split(',');
  var asteriscos_prohibidos = document.getElementById("palabrotas_asteriscos").innerHTML;
  asteriscos_prohibidos = asteriscos_prohibidos.split(',');
  var comentario_field = document.getElementById("comentario");
  const tam = palabras_prohibidas.length;
  for(var i=0;i<tam;i++){
    comentario_field.value = comentario_field.value.replace(palabras_prohibidas[i], asteriscos_prohibidos[i]);
  }
}

/* Submit and validate form */
function validarForm(){
    var name = document.getElementById("nombre").innerHTML;
    var comm = document.getElementById("comentario").value;
    var evento = document.getElementById("sendEvento").innerHTML;
    
    /* Validate mail using a regular expression */
    var problema = false;
    var mensajeProblema = "";

    if (comm == "") {
      problema = true;
      mensajeProblema += "El comentario no puede estar vacio.\n";
    }

    
    if(problema){
        alert("Problema validando: \n" + mensajeProblema);
    } else {
      // Actualizar los campos de la página
      document.getElementById("fill-name").innerHTML = name;
      document.getElementById("fill-comment").innerHTML = comm;
  
      // Enviamos los datos a la bd
      var form = [name, comm, evento];
      var formJSON = JSON.stringify(form);
      var xhttp = new XMLHttpRequest();
      xhttp.open("POST", "/checkForm.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("obj=" + formJSON);
    }
}