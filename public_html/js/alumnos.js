//Variables y Selectores
const tableContent = document.querySelector("#contentTable table tbody");
const pagination = document.querySelector(".pagination");
const searchText = document.querySelector("#txtSearch");
const btnNew = document.querySelector("#btnAgregar");
const panelDatos = document.querySelector("#panelDatos");
const panelFormulario = document.querySelector("#panelFormulario");
const idCinta = document.querySelector("#id_cinta");
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
  btnNew.addEventListener("click", agregarAlumno);
  miform.addEventListener("submit", guardarAlumno);
  btnCancelar.addEventListener("click", cancelarAlumno);
}

//Funciones

function cancelarAlumno() {
  panelDatos.classList.remove("d-none");
  panelFormulario.classList.add("d-none");
  cargarDatos();
}

function guardarAlumno(e) {
  e.preventDefault();
  const formdata = new FormData(miForm);
  API.saveAlumno(formdata)
    .then((data) => {
      if (data.success) {
        cancelarAlumno();
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

function agregarAlumno() {
  panelDatos.classList.add("d-none");
  panelFormulario.classList.remove("d-none");
  limpiarForm();
}

function cargarDatos() {
  API.loadAlumnos()
    .then((data) => {
      if (data.success) {
        objDatos.records = data.records;
        objDatos.currentPage = 1;
        crearTabla();
        return API.loadCintas();
      } else {
        mensaje.textContent = data.msg;
      }
    })
    .then((data) => {
      rellenarCintas(data.records);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function rellenarCintas(records) {
  idCinta.innerHTML = "";
  records.forEach((item) => {
    const { id_cinta, color } = item;
    const optionCate = document.createElement("option");
    optionCate.value = id_cinta;
    optionCate.textContent = color;
    idCinta.append(optionCate);
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
      const { nombre, color } = item;
      if (
        nombre.toUpperCase().search(objDatos.filter.toUpperCase()) != -1 ||
        color.toUpperCase().search(objDatos.filter.toUpperCase()) != -1
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
        id_alumno,
        nombre,
        apellido,
        dui,
        fechanac,
        email,
        telefono,
        estado,
        color,
      } = item;
      html += `<tr>
			      <th scope="col">${index + 1}</th>
			      <th scope="col">${nombre}</th>
            <th scope="col">${apellido}</th>
            <th scope="col">${dui}</th>
			      <th scope="col">${fechanac}</th>
            <th scope="col">${email}</th>
            <th scope="col">${telefono}</th>
			      <th scope="col">${estado}</th>
            <th scope="col">${color}</th>
			      <th scope="col">
            <button class='btn btn-primary btn-xs' onclick='editarAlumno("${id_alumno}")'><i class='far fa-edit'></i></button>
            <button class='btn btn-danger btn-xs' onclick='eliminarAlumno("${id_alumno}")'><i class='fas fa-trash-alt'></i></button>
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

function editarAlumno(id) {
  limpiarForm(1);
  panelDatos.classList.add("d-none");
  panelFormulario.classList.remove("d-none");
  API.getOneAlumno(id)
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
    id_alumno,
    nombre,
    apellido,
    dui,
    fechanac,
    email,
    telefono,
    estado,
    id_cinta,
  } = record;
  document.querySelector("#id_alumno").value = id_alumno;
  document.querySelector("#nombre").value = nombre;
  document.querySelector("#apellido").value = apellido;
  document.querySelector("#dui").value = dui;
  document.querySelector("#fechanac").value = fechanac;
  document.querySelector("#email").value = email;
  document.querySelector("#telefono").value = telefono;
  document.querySelector("#estado").value = estado;
  document.querySelector("#id_cinta").value = id_cinta;
}

function eliminarAlumno(id) {
  Swal.fire({
    title: "Esta seguro de eliminar el registro?",
    showDenyButton: true,
    confirmButtonText: `Si`,
    denyButtonText: `No`,
  }).then((result) => {
    if (result.isConfirmed) {
      API.deleteAlumno(id)
        .then((data) => {
          if (data.success) {
            cancelarAlumno();
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
  document.querySelector("#id_alumno").value = "0";
}
