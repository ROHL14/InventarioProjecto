//Variables y Selectores
const btnNew = document.querySelector("#btnAgregar");
const panelDatos = document.querySelector("#panelDatos");
const panelFormulario = document.querySelector("#panelFormulario");
const mensaje = document.querySelector("#mensaje");
const tableContent = document.querySelector("#contentTable table tbody");
const searchText = document.querySelector("#txtSearch");
const pagination = document.querySelector(".pagination");
const btnCancelar = document.querySelector("#btnCancelar");
const miForm = document.querySelector("#miform");
const recordShow = 5;
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
  btnNew.addEventListener("click", agregarUsuario);
  btnCancelar.addEventListener("click", cancelarUsuario);
  miForm.addEventListener("submit", guardarUsuario);
}

//Funciones

function guardarUsuario(e) {
  e.preventDefault();
  const formdata = new FormData(miForm);
  API.saveUser(formdata)
    .then((data) => {
      if (data.success) {
        cancelarUsuario();
        Swal.fire({
          icon: "infor",
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

function cancelarUsuario() {
  panelDatos.classList.remove("d-none");
  panelFormulario.classList.add("d-none");
  cargarDatos();
}

function cargarDatos() {
  API.loadData()
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

function agregarUsuario() {
  panelDatos.classList.add("d-none");
  panelFormulario.classList.remove("d-none");
  limpiarForm();
}

function crearTabla() {
  if (objDatos.filter === "") {
    objDatos.recordsFilter = objDatos.records.map((item) => item);
  } else {
    objDatos.recordsFilter = objDatos.records.filter((item) => {
      const { username, nombre, email, rol } = item;
      if (
        username.toUpperCase().search(objDatos.filter.toUpperCase()) != -1 ||
        nombre.toUpperCase().search(objDatos.filter.toUpperCase()) != -1 ||
        email.toUpperCase().search(objDatos.filter.toUpperCase()) != -1 ||
        rol.toUpperCase().search(objDatos.filter.toUpperCase()) != -1
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
      const { id, username, nombre, email, rol } = item;
      html += `<tr>
				  <th scope="col">${index + 1}</th>
				  <th scope="col">${username}</th>
				  <th scope="col">${nombre}</th>
				  <th scope="col">${email}</th>
				  <th scope="col">${rol}</th>
				  <th scope="col">
				  <button class="btn btn-primary btn-xs" onclick="editarUsuario(${id})"><i class="far fa-edit"></i></button>
				  <button class="btn btn-danger btn-xs" onclick="eliminarUsuario(${id})"><i class="fas fa-trash-alt"></i></button>
				  </th>
				  </tr>
			`;
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
  elSiguiente.innerHTML = `<a class="page-link" href="#">Siguiente</a>`;
  elSiguiente.onclick = () => {
    objDatos.currentPage =
      objDatos.currentPage == totalPage ? totalPage : ++objDatos.currentPage;
    crearTabla();
  };
  pagination.append(elSiguiente);
}

function editarUsuario(id) {
  limpiarForm(1);
  panelDatos.classList.add("d-none");
  panelFormulario.classList.remove("d-none");
  API.getOneUser(id)
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
      console.error("Error", error);
    });
}

function mostrarDatosForm(record) {
  const { id, username, nombre, email, rol } = record;
  document.querySelector("#id").value = id;
  document.querySelector("#username").value = username;
  document.querySelector("#nombre").value = nombre;
  document.querySelector("#email").value = email;
  document.querySelector("#rol").value = rol;
}

function eliminarUsuario(id) {
  Swal.fire({
    title: "Esta seguro de eliminar el registro?",
    showDenyButton: true,
    confirmButtonText: "Si",
    denyButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      API.deleteUser(id)
        .then((data) => {
          if (data.success) {
            cancelarUsuario();
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
  });
}

function aplicarFiltro(e) {
  e.preventDefault();
  objDatos.filter = this.value;
  crearTabla();
}

function limpiarForm(op) {
  miForm.reset();
  document.querySelector("#id").value = "0";
  document.querySelector("#rol").value = "administrador";

  if (op) {
    document.querySelector("#password").removeAttribute("required");
  } else {
    document.querySelector("#password").setAttribute("required", "true");
  }
}
