let datos = {
  nombre: "",
  empresa: "",
  telefono: "",
};
let Buscador = document.querySelector('.buscador');
let numContacto = document.querySelector('.num-contacto');
let params = new URLSearchParams(location.search);
let id = params.get("id");

document.addEventListener("DOMContentLoaded", function () {
  eventListener();

  
  
});


function eventListener() {
  validaFormulario();
  eliminarRegistro();
  buscador();
  numeroContacto();
}

function eliminarRegistro() {
  let iconEliminar = document.querySelectorAll(".eliminar");

  iconEliminar.forEach((a) => {
    a.addEventListener("click", eliminarBD);
 });

}

function eliminarBD(e){

  e.preventDefault();

  let elemento;

  if (e.target.tagName == "I") {
    elemento = e.target.parentElement;
  } else {
    elemento = e.target;
  }



  Swal.fire({
    title: "¿estas seguro?",
    text: "Estas a punto de eliminar de un contacto",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Borrar",
  }).then((result) => {
    if (result.isConfirmed) {
      //crear el objeto
      let xhttp = new XMLHttpRequest();
     
    
      //abrir la conexion
      let id = elemento.getAttribute('data-set');
      let url = `models/eliminar?id=${id}`;
      xhttp.open("GET", url, true);
      //obtener respuesta
      xhttp.onload = function () {
        if (this.status == 200) {
          let respuesta = JSON.parse(xhttp.responseText);
  
          console.log(respuesta);
           if(respuesta.respuesta == "eliminado"){


        
            Swal.fire(
              'Eliminado!',
              'Tu contacto ha sido eliminado',
              'success'
            );

            elemento.parentElement.parentElement.parentElement.remove();
           

            numeroContacto();
           }
        }
      }

      xhttp.send();
    }
  })
}


function validaFormulario() {

  
  let inputs = document.querySelectorAll("input[type='text']");

  let submit = document.querySelector("#submit");
  let accion = submit.value;
  submit.addEventListener("click", function (e) {
    e.preventDefault();

    let nombre = document.querySelector("#nombre").value;
    let empresa = document.querySelector("#empresa").value;
    let telefono = document.querySelector("#telefono").value;

    let datos = {
      nombre,
      empresa,
      telefono,
    };

    console.log(datos);

    if (datos.nombre == "" || datos.empresa == "" || datos.telefono == "") {
      mensaje("Todos los campos son obligatorios", "error");
    } else {
      let { nombre, empresa, telefono } = datos;

      let contacto = new FormData();

      contacto.append("nombre", nombre);
      contacto.append("empresa", empresa);
      contacto.append("telefono", telefono);
      contacto.append("accion", accion);

      if (accion == "crear") {
        insertarBD(contacto);
      } else {
        actualizarBD(contacto);
      }
    }
  });
}

function insertarBD(contacto) {
  //crear el objeto

  let xhttp = new XMLHttpRequest();

  //abrir la conexion

  xhttp.open("POST", "models/contacto", true);

  //obtener respuesta

  xhttp.onload = function () {
    if (this.status == 200) {
      let respuesta = JSON.parse(xhttp.responseText);

      console.log(respuesta);

      if (respuesta.respuesta == "correcto") {
        let cuerpoTabla = document.querySelector("#registro_contacto");
        let tr = document.createElement("tr");
        tr.innerHTML = `
         
         <td>${respuesta.nombre}</td>
         <td>${respuesta.empresa}</td>
         <td>${respuesta.telefono}</td>
         
         `;

        let td = document.createElement("td");
        let divIconos = document.createElement("div");
        divIconos.classList.add("flex-icon");

        let enlaceActualizar = document.createElement("a");
        enlaceActualizar.href = `models/actualizar?id=${respuesta.id}`;

        let iconoActualizar = document.createElement("i");
        iconoActualizar.classList.add("fas", "fa-pencil-alt");

        let enlaceEliminar = document.createElement("a");
        enlaceEliminar.classList.add('eliminar');
        enlaceEliminar.setAttribute('data-set', respuesta.id);

        id = respuesta.id;

        let iconoEliminar = document.createElement("i");
        iconoEliminar.classList.add("fas", "fa-trash-alt");

        enlaceActualizar.appendChild(iconoActualizar);
        enlaceEliminar.appendChild(iconoEliminar);

        divIconos.appendChild(enlaceActualizar);
        divIconos.appendChild(enlaceEliminar);

        td.appendChild(divIconos);

        tr.appendChild(td);

        cuerpoTabla.appendChild(tr);

        document.querySelector('form').reset();

        mensaje("Se ha creado correctamente", "exito");

        eliminarRegistro();

        numeroContacto()
      }
    }
  };

  //enviar los datos
  xhttp.send(contacto);
}

function actualizarBD(contacto) {
  //crear el objeto

  let xhttp = new XMLHttpRequest();

  //abrir la conexion

  $url = `actualizar?id=${id}`;

  xhttp.open("POST", $url, true);

  //obtener respuesta

  xhttp.onload = function () {
    if (this.status == 200) {
      let respuesta = JSON.parse(xhttp.responseText);

      if (respuesta.respuesta == "actualizado") {
        mensaje("Se actualizado correctamente", "exito");
        setTimeout(() => {
        }, 2000);
      }
    }
  };

  xhttp.send(contacto);
}

function mensaje(texto, tipo) {
  let formContacto = document.querySelector("#form-contacto");

  let divMensaje = document.createElement("div");
  divMensaje.classList.add("mensaje", tipo);

  let cuerpoMensaje = document.createElement("div");
  cuerpoMensaje.classList.add("contenido-mensaje");

  cuerpoMensaje.innerHTML = `<p>${texto}</p>`;
  divMensaje.appendChild(cuerpoMensaje);

  formContacto.appendChild(divMensaje);

  setTimeout(() => {
    divMensaje.remove();
  }, 3000);
}

function buscador(){

  Buscador.addEventListener('input', search);

}

function search(e){

  let exp = new RegExp(e.target.value , "i");
  
  let registros = document.querySelectorAll('tbody tr');

  registros.forEach( registro =>{

    registro.style.display = 'none';

    if(registro.childNodes[1].textContent.replace(/\s/g, " ").search(exp) != -1 ){
      registro.style.display = 'table-row';
  
    }
    numeroContacto();
  })

}


function numeroContacto(){

  let registros = document.querySelectorAll('tbody tr');

  let total = 0; 
  registros.forEach(registro =>{

    console.log(registro.style.display )

    if(registro.style.display == '' ||  registro.style.display == 'table-row' ){

      total++;
    }

  })
  numContacto.textContent = total;


}