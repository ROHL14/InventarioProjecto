//Variables y Selectores
const tableContent = document.querySelector("#contentTable table tbody");
const pagination = document.querySelector(".pagination");
const searchText = document.querySelector("#txtSearch");
const btnNew = document.querySelector("#btnAgregar");
const panelDatos = document.querySelector("#panelDatos");
const panelFormulario = document.querySelector("#panelFormulario");
const idPais = document.querySelector("#id_pais");
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
  btnNew.addEventListener("click", agregarTorneo);
  miform.addEventListener("submit", guardarTorneo);
  btnCancelar.addEventListener("click", cancelarTorneo);
}

//Funciones

function cancelarTorneo() {
  panelDatos.classList.remove("d-none");
  panelFormulario.classList.add("d-none");
  cargarDatos();
}

function guardarTorneo(e) {
  e.preventDefault();
  const formdata = new FormData(miForm);
  API.saveTorneo(formdata)
    .then((data) => {
      if (data.success) {
        cancelarTorneo();
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

function agregarTorneo() {
  panelDatos.classList.add("d-none");
  panelFormulario.classList.remove("d-none");
  limpiarForm();
}

function cargarDatos() {
  API.loadTorneos()
    .then((data) => {
      if (data.success) {
        objDatos.records = data.records;
        objDatos.currentPage = 1;
        crearTabla();
        return API.loadPaises();
      } else {
        mensaje.textContent = data.msg;
      }
    })
    .then((data) => {
      rellenarPaises(data.records);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function rellenarPaises(records) {
  idPais.innerHTML = "";
  records.forEach((item) => {
    const { id_pais, pais } = item;
    const optionCate = document.createElement("option");
    optionCate.value = id_pais;
    optionCate.textContent = pais;
    idPais.append(optionCate);
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
      const { nombre, pais } = item;
      if (
        nombre.toUpperCase().search(objDatos.filter.toUpperCase()) != -1 ||
        pais.toUpperCase().search(objDatos.filter.toUpperCase()) != -1
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
      const { id_torneo, nombre, fecha, estado, direccion, pais } = item;
      html += `<tr>
			      <th scope="col">${index + 1}</th>
			      <th scope="col">${nombre}</th>
			      <th scope="col">${fecha}</th>
			      <th scope="col">${estado}</th>
			      <th scope="col">${direccion}</th>
            <th scope="col">${pais}</th>
			      <th scope="col">
            <button class='btn btn-primary btn-xs' onclick='editarTorneo("${id_torneo}")'><i class='far fa-edit'></i></button>
            <button class='btn btn-danger btn-xs' onclick='eliminarTorneo("${id_torneo}")'><i class='fas fa-trash-alt'></i></button>
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

function editarTorneo(id) {
  limpiarForm(1);
  panelDatos.classList.add("d-none");
  panelFormulario.classList.remove("d-none");
  API.getOneTorneo(id)
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
  const { id_torneo, nombre, fecha, estado, direccion, id_pais } = record;
  document.querySelector("#id_torneo").value = id_torneo;
  document.querySelector("#nombre").value = nombre;
  document.querySelector("#fecha").value = fecha;
  document.querySelector("#estado").value = estado;
  document.querySelector("#direccion").value = direccion;
  document.querySelector("#id_pais").value = id_pais;
}

function eliminarTorneo(id) {
  Swal.fire({
    title: "Esta seguro de eliminar el registro?",
    showDenyButton: true,
    confirmButtonText: `Si`,
    denyButtonText: `No`,
  }).then((result) => {
    if (result.isConfirmed) {
      API.deleteTorneo(id)
        .then((data) => {
          if (data.success) {
            cancelarTorneo();
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
  document.querySelector("#id_torneo").value = "0";
}
