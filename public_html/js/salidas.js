//Variables y Selectores
const tableContent = document.querySelector("#contentTable table tbody");
const pagination = document.querySelector(".pagination");
const searchText = document.querySelector("#txtSearch");
const btnNew = document.querySelector("#btnAgregar");
const panelDatos = document.querySelector("#panelDatos");
const panelFormulario = document.querySelector("#panelFormulario");
const divFoto = document.querySelector("#divFotoP");
const divFotoM = document.querySelector("#divFotoM");
const divFotoG = document.querySelector("#divFotoG");
const idAlumno = document.querySelector("#id_alumno");
const idEquipo = document.querySelector("#id_equipo");
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
  btnNew.addEventListener("click", agregarPrestamo);
  miform.addEventListener("submit", guardarPrestamo);
  btnCancelar.addEventListener("click", cancelarPrestamo);
}

//Funciones

function cancelarPrestamo() {
  panelDatos.classList.remove("d-none");
  panelFormulario.classList.add("d-none");
  cargarDatos();
}

function guardarPrestamo(e) {
  e.preventDefault();
  const formdata = new FormData(miForm);
  API.savePrestamo(formdata)
    .then((data) => {
      if (data.success) {
        cancelarPrestamo();
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

function agregarPrestamo() {
  panelDatos.classList.add("d-none");
  panelFormulario.classList.remove("d-none");
  limpiarForm();
}

function cargarDatos() {
  API.loadPrestamos()
    .then((data) => {
      if (data.success) {
        console.log(data);
        objDatos.records = data.records;
        objDatos.currentPage = 1;
        crearTabla();
        return API.loadAlumnos();
      } else {
        mensaje.textContent = data.msg;
      }
    })
    .then((data) => {
      rellenarAlumnos(data.records);
      return API.loadEquipo();
    })
    .then((data) => {
      rellenarEquipo(data.records);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function rellenarEquipo(records) {
  idEquipo.innerHTML = "";
  records.forEach((item) => {
    const { id_equipo, equipo, stock, id_categoria } = item;
    const optionEquipo = document.createElement("option");
    optionEquipo.value = id_equipo;
    optionEquipo.textContent = equipo;
    idEquipo.append(optionEquipo);
  });
}

function rellenarAlumnos(records) {
  idAlumno.innerHTML = "";
  records.forEach((item) => {
    const {
      id_alumno,
      nombre,
      apellido,
      dui,
      fechanac,
      email,
      telefono,
      direccion,
      id_cinta,
    } = item;
    const optionAlumno = document.createElement("option");
    optionAlumno.value = id_alumno;
    optionAlumno.textContent = nombre + " " + apellido;
    idAlumno.append(optionAlumno);
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
      const { nombre, apellido, equipo } = item;
      if (
        nombre.toUpperCase().search(objDatos.filter.toUpperCase()) != -1 ||
        apellido.toUpperCase().search(objDatos.filter.toUpperCase()) != -1 ||
        equipo.toUpperCase().search(objDatos.filter.toUpperCase()) != -1
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
        id_prestamo,
        id_alumno,
        id_equipo,
        nombre,
        apellido,
        equipo,
        estado_prestamo,
      } = item;
      html += `<tr>
			      <th scope="col">${index + 1}</th>
			      <th scope="col">${nombre} ${apellido}</th>
			      <th scope="col">${equipo}</th>
            <th scope="col">${estado_prestamo}</th>
			      <th scope="col"><button class='btn btn-primary btn-xs' onclick='editarPrestamo("${id_prestamo}")'><i class='far fa-edit'></i></button>&nbsp;&nbsp;<button class='btn btn-danger btn-xs' onclick='eliminarPrestamo("${id_prestamo}")'><i class='fas fa-trash-alt'></i></button></th>
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

function editarPrestamo(id) {
  limpiarForm(1);
  panelDatos.classList.add("d-none");
  panelFormulario.classList.remove("d-none");
  API.getOnePrestamo(id)
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
  const {
    id_prestamo,
    id_alumno,
    id_equipo,
    nombre,
    apellido,
    equipo,
    estado_prestamo,
  } = record;
  document.querySelector("#id_prestamo").value = id_prestamo;
  document.querySelector("#id_alumno").value = id_alumno;
  document.querySelector("#id_equipo").value = id_equipo;
}

function eliminarPrestamo(id) {
  Swal.fire({
    title: "Esta seguro de eliminar el registro?",
    showDenyButton: true,
    confirmButtonText: `Si`,
    denyButtonText: `No`,
  }).then((result) => {
    if (result.isConfirmed) {
      API.deletePrestamo(id)
        .then((data) => {
          if (data.success) {
            cancelarPrestamo();
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
  document.querySelector("#id_prestamo").value = "0";
}
