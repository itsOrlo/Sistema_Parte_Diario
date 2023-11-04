function controlLetras(e) {
  tecla = document.all ? e.keyCode : e.which;
  if (tecla == 8) return true;
  patron = /[0-9]/;
  tecla_final = String.fromCharCode(tecla);
  return patron.test(tecla_final);
}

function controlNumeros(e) {
  tecla = document.all ? e.keyCode : e.which;
  if (tecla == 8) return true; // permite la tecla de retroceso
  patron = /[A-Za-zñÑ\s]/; // permite letras mayúsculas, minúsculas y espacios
  tecla_final = String.fromCharCode(tecla);
  return patron.test(tecla_final); // devuelve true si la tecla es una letra, de lo contrario, devuelve false
}

function copyToClipboard(text) {
  var input = document.createElement("input");
  input.setAttribute("value", text);
  document.body.appendChild(input);
  input.select();
  document.execCommand("copy");
  document.body.removeChild(input);

  toastr.options = {
    closeButton: true,
    progressBar: false,
    positionClass: "toast-top-right",
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "5000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
  };

  toastr["success"]("Cédula copiada: " + text);
}

function registro() {
  // Espera 2 segundos (2000 milisegundos) antes de ejecutar el código
  setTimeout(function () {
    toastr.options = {
      closeButton: true,
      progressBar: false,
      positionClass: "toast-bottom-left",
      showDuration: "300",
      hideDuration: "1000",
      timeOut: "5000",
      extendedTimeOut: "1000",
      showEasing: "swing",
      hideEasing: "linear",
      showMethod: "fadeIn",
      hideMethod: "fadeOut",
    };

    toastr["info"]("Registrado correctamente");
  }, 1000); // Espera 2 segundos (2000 milisegundos)
}


// Completar campos de acuerdo a la cédula
function buscaTres() {
  cedula = document.getElementById("cedula").value;

  var parametros = {
    buscar: 1,
    cedula: cedula,
  };

  $.ajax({
    type: "POST",
    url: "../controlador/controladorBuscarCedula.php",
    data: parametros,
    dataType: "json",
    success: function (data) {
      if (data && Object.keys(data).length !== 0) {
        if (data.nombres && data.unidad) {
          document.getElementById("nombres").value = data.nombres;
          document.getElementById("unidad").value = data.unidad;

          // Establecer el estado del campo de radio
          if (data.estado === "Activo") {
            document.getElementsByName("situacion")[0].checked = true;
          } else if (data.estado === "Pasivo") {
            document.getElementsByName("situacion")[1].checked = true;
          } else {
            console.error("Valor de situación desconocido");
          }
        } else {
          console.error("La respuesta JSON está incompleta");
        }
      } else {
        console.error("La respuesta JSON está vacía");
      }
    },

    error: function (jqXHR, textStatus, errorThrown) {
      console.error("Error en la solicitud AJAX: " + textStatus);
    },
  });
}
