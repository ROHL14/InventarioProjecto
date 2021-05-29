//Variables y Selectores
const tableContent = document.querySelector("#contentTable table tbody");
const pagination = document.querySelector(".pagination");
const searchText = document.querySelector("#txtSearch");
const btnNew = document.querySelector("#btnAgregar");
const panelDatos = document.querySelector("#panelDatos");
const panelFormulario = document.querySelector("#panelFormulario");
const idCategoria = document.querySelector("#id_categoria");
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
  btnNew.addEventListener("click", agregarEquipo);
  miform.addEventListener("submit", guardarEquipo);
  btnCancelar.addEventListener("click", cancelarEquipo);
}

//Funciones

function cancelarEquipo() {
  panelDatos.classList.remove("d-none");
  panelFormulario.classList.add("d-none");
  cargarDatos();
}

function guardarEquipo(e) {
  e.preventDefault();
  const formdata = new FormData(miForm);
  API.saveEquipo(formdata)
    .then((data) => {
      if (data.success) {
        cancelarEquipo();
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

function agregarEquipo() {
  panelDatos.classList.add("d-none");
  panelFormulario.classList.remove("d-none");
  limpiarForm();
}

function cargarDatos() {
  API.loadEquipo()
    .then((data) => {
      if (data.success) {
        objDatos.records = data.records;
        objDatos.currentPage = 1;
        crearTabla();
        return API.loadCategorias();
      } else {
        mensaje.textContent = data.msg;
      }
    })
    .then((data) => {
      rellenarCategorias(data.records);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function rellenarCategorias(records) {
  idCategoria.innerHTML = "";
  records.forEach((item) => {
    const { id_categoria, categoria } = item;
    const optionCate = document.createElement("option");
    optionCate.value = id_categoria;
    optionCate.textContent = categoria;
    idCategoria.append(optionCate);
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
      const { nombre, categoria } = item;
      if (
        nombre.toUpperCase().search(objDatos.filter.toUpperCase()) != -1 ||
        categoria.toUpperCase().search(objDatos.filter.toUpperCase()) != -1
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
      const { id_equipo, nombre, stock, categoria } = item;
      html += `<tr>
			      <th scope="col">${index + 1}</th>
			      <th scope="col">${nombre}</th>
			      <th scope="col">${stock}</th>
            <th scope="col">${categoria}</th>
			      <th scope="col">
            <button class='btn btn-primary btn-xs' onclick='editarEquipo("${id_equipo}")'><i class='far fa-edit'></i></button>
            <button class='btn btn-danger btn-xs' onclick='eliminarEquipo("${id_equipo}")'><i class='fas fa-trash-alt'></i></button>
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

function editarEquipo(id) {
  limpiarForm(1);
  panelDatos.classList.add("d-none");
  panelFormulario.classList.remove("d-none");
  API.getOneEquipo(id)
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
  const { id_equipo, nombre, stock, id_categoria } = record;
  document.querySelector("#id_equipo").value = id_equipo;
  document.querySelector("#nombre").value = nombre;
  document.querySelector("#stock").value = stock;
  document.querySelector("#id_categoria").value = id_categoria;
}

function eliminarEquipo(id) {
  Swal.fire({
    title: "Esta seguro de eliminar el registro?",
    showDenyButton: true,
    confirmButtonText: `Si`,
    denyButtonText: `No`,
  }).then((result) => {
    if (result.isConfirmed) {
      API.deleteEquipo(id)
        .then((data) => {
          if (data.success) {
            cancelarEquipo();
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
  document.querySelector("#id_equipo").value = "0";
}
