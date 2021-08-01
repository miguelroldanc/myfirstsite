/* 
 * Copyright (C) 2020 migue
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// Set the width of the sidebar to 250px (show it)
function openSide(){
    document.getElementById("mySidePanel").style.width = "100%";
}

// Set the width of the sidebar to 0 (hide it)
function closeSide(){
    document.getElementById("mySidePanel").style.width = "0px";
}

// Edit a comment on the forum
function editarComentario(){
    var idComentario = document.getElementsByName("idComentario");
    var nuevoComentario = document.getElementsByName("nuevoComentario");

    // Enviamos los datos a la bd
    var form = [idComentario, nuevoComentario];
    var formJSON = JSON.stringify(form);
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "/editarComentario.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("obj=" + formJSON);
}

// Delete a comment on the forum
function eliminarComentario(){
    var idComentario = document.getElementsByName("idComentario");

    // Enviamos los datos a la bd
    var formJSON = JSON.stringify(idComentario);
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "/editarComentario.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("obj=" + formJSON);
}

// Abrir el panel
function abrirLista(){
    document.getElementsByClassName("contenido-lista").style.display = block;
}