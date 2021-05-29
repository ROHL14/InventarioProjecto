//Variables y Selectores
const tableContent = document.querySelector("#contentTable table tbody");
const pagination = document.querySelector(".pagination");
const searchText = document.querySelector("#txtSearch");
const btnNew = document.querySelector("#btnAgregar");
const panelDatos = document.querySelector("#panelDatos");
const panelFormulario = document.querySelector("#panelFormulario");
const miForm = document.querySelector("#miform");
const btnCancelar = document.querySelector("#btnCancelar");
const recordShow = 4;
const API = new Api();
const objDatos = {
  records: [],
  recordsFilter: [],
  currentPage: 1,
  filter: "",
};
//Eventos
eventListeners();

function eventListeners() {
  document.addEventListener("DOMContentLoaded", cargarDatos);
  searchText.addEventListener("input", aplicarFiltro);
  btnNew.addEventListener("click", agregarEncargado);
  miform.addEventListener("submit", guardarEncargado);
  btnCancelar.addEventListener("click", cancelarEncargado);
}

//Funciones

function cancelarEncargado() {
  panelDatos.classList.remove("d-none");
  panelFormulario.classList.add("d-none");
  cargarDatos();
}

function guardarEncargado(e) {
  e.preventDefault();
  const formdata = new FormData(miForm);
  API.saveEncargado(formdata)
    .then((data) => {
      if (data.success) {
        cancelarEncargado();
        Swal.fire({
          icon: "info",
          text: data.msg,
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: data.msg,
        });
      }
    })
    .catch((error) => {
      console.error("Error", error);
    });
}

function agregarEncargado() {
  panelDatos.classList.add("d-none");
  panelFormulario.classList.remove("d-none");
  limpiarForm();
}

function cargarDatos() {
  API.loadEncargados()
    .then((data) => {
      if (data.success) {
        objDatos.records = data.records;
        objDatos.currentPage = 1;
        crearTabla();
      } else {
        mensaje.textContent = data.msg;
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function aplicarFiltro(e) {
  e.preventDefault();
  objDatos.filter = this.value;
  crearTabla();
}

function crearTabla() {
  if (objDatos.filter == "") {
    objDatos.recordsFilter = objDatos.records.map((item) => item);
  } else {
    objDatos.recordsFilter = objDatos.records.filter((item) => {
      const { nombres, apellidos } = item;
      if (nombres.toUpperCase().search(objDatos.filter.toUpperCase()) != -1) {
        return item;
      } else if (
        apellidos.toUpperCase().search(objDatos.filter.toUpperCase()) != -1
      ) {
        return item;
      }
    });
  }
  const recordIni = objDatos.currentPage * recordShow - recordShow;
  const recordFin = recordIni + recordShow - 1;
  let html = "";
  objDatos.recordsFilter.forEach((item, index) => {
    if (index >= recordIni && index <= recordFin) {
      const {
        id_encargado,
        nombres,
        apellidos,
        telefono,
        email,
        direccion,
        dui,
      } = item;
      html += `<tr>
			      <th scope="col">${index + 1}</th>
			      <th scope="col">${nombres}</th>
            <th scope="col">${apellidos}</th>
            <th scope="col">${telefono}</th>
            <th scope="col">${email}</th>
            <th scope="col">${direccion}</th>
            <th scope="col">${dui}</th>
			      <th scope="col">
						<button class='btn btn-primary btn-xs' onclick='editarEncargado(${id_encargado})'><i class='far fa-edit'></i></button>
						<button class='btn btn-danger btn-xs' onclick='eliminarEncargado(${id_encargado})'><i class='fas fa-trash-alt'></i></button>
						</th>
			    </tr>`;
    }
  });
  tableContent.innerHTML = html;
  crearPaginacion();
}

function crearPaginacion() {
  while (pagination.firstElementChild) {
    pagination.removeChild(pagination.firstElementChild);
  }
  const elAnterior = document.createElement("li");
  elAnterior.classList.add("page-item");
  elAnterior.innerHTML = `<a class="page-link" href="#">Anterior</a>`;
  elAnterior.onclick = () => {
    objDatos.currentPage =
      objDatos.currentPage == 1 ? 1 : --objDatos.currentPage;
    crearTabla();
  };
  pagination.append(elAnterior);
  const totalPage = Math.ceil(objDatos.recordsFilter.length / recordShow);
  for (let i = 1; i <= totalPage; i++) {
    const el = document.createElement("li");
    el.classList.add("page-item");
    el.innerHTML = `<a class="page-link" href="#">${i}</a>`;
    el.onclick = () => {
      objDatos.currentPage = i;
      crearTabla();
    };
    pagination.append(el);
  }
  const elSiguiente = document.createElement("li");
  elSiguiente.classList.add("page-item");
  elSiguiente.innerHTML = '<a class="page-link" href="#">Siguiente</a>';
  elSiguiente.onclick = () => {
    objDatos.currentPage =
      objDatos.currentPage == totalPage ? totalPage : ++objDatos.currentPage;
    crearTabla();
  };
  pagination.append(elSiguiente);
}

function editarEncargado(id) {
  limpiarForm();
  panelDatos.classList.add("d-none");
  panelFormulario.classList.remove("d-none");
  API.getOneEncargado(id)
    .then((data) => {
      if (data.success) {
        mostrarDatosForm(data.records[0]);
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: data.msg,
        });
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function mostrarDatosForm(record) {
  const { id_encargado, nombres, apellidos, telefono, email, direccion, dui } =
    record;
  document.querySelector("#id_encargado").value = id_encargado;
  document.querySelector("#nombres").value = nombres;
  document.querySelector("#apellidos").value = apellidos;
  document.querySelector("#telefono").value = telefono;
  document.querySelector("#email").value = email;
  document.querySelector("#direccion").value = direccion;
  document.querySelector("#dui").value = dui;
}

function eliminarEncargado(id) {
  Swal.fire({
    title: "Esta seguro de eliminar el registro?",
    showDenyButton: true,
    confirmButtonText: `Si`,
    denyButtonText: `No`,
  }).then((result) => {
    if (result.isConfirmed) {
      API.deleteEncargado(id)
        .then((data) => {
          if (data.success) {
            cancelarEncargado();
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: data.msg,
            });
          }
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    }
  });
}

function limpiarForm(op) {
  miForm.reset();
  document.querySelector("#id_encargado").value = "0";
}
