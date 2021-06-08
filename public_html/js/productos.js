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
  btnNew.addEventListener("click", agregarProducto);
  miform.addEventListener("submit", guardarProducto);
  btnCancelar.addEventListener("click", cancelarProducto);
}

//Funciones

function cancelarProducto() {
  panelDatos.classList.remove("d-none");
  panelFormulario.classList.add("d-none");
  document.querySelector("#cantidad").classList.remove("d-none");
  document.querySelector("#fecha_agregado").classList.remove("d-none");
  document.querySelector("#cantidadlabel").classList.remove("d-none");
  document.querySelector("#fechalabel").classList.remove("d-none");
  cargarDatos();
}

function guardarProducto(e) {
  e.preventDefault();
  const formdata = new FormData(miForm);
  API.saveProducto(formdata)
    .then((data) => {
      if (data.success) {
        document.querySelector("#cantidad").classList.remove("d-none");
        document.querySelector("#fecha_agregado").classList.remove("d-none");
        document.querySelector("#cantidadlabel").classList.remove("d-none");
        document.querySelector("#fechalabel").classList.remove("d-none");
        cancelarProducto();
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

function agregarProducto() {
  panelDatos.classList.add("d-none");
  panelFormulario.classList.remove("d-none");
  limpiarForm();
}

function cargarDatos() {
  API.loadProductos()
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
      const { nombre_producto, categoria } = item;
      if (
        nombre_producto.toUpperCase().search(objDatos.filter.toUpperCase()) !=
          -1 ||
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
      const {
        id_producto,
        nombre_producto,
        descripcion,
        precio,
        cantidad,
        fecha_agregado,
        categoria,
      } = item;
      html += `<tr>
			      <th scope="col">${index + 1}</th>
			      <th scope="col">${nombre_producto}</th>
            <th scope="col">${descripcion}</th>
            <th scope="col">$ ${precio}</th>
			      <th scope="col">${cantidad}</th>
            <th scope="col">${fecha_agregado}</th>
            <th scope="col">${categoria}</th>
			      <th scope="col">
            <button class='btn btn-primary btn-xs' onclick='editarProducto("${id_producto}")'><i class='far fa-edit'></i></button>
            <button class='btn btn-danger btn-xs' onclick='eliminarProducto("${id_producto}")'><i class='fas fa-trash-alt'></i></button>
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

function editarProducto(id) {
  limpiarForm(1);
  panelDatos.classList.add("d-none");
  panelFormulario.classList.remove("d-none");
  API.getOneProducto(id)
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
    id_producto,
    nombre_producto,
    descripcion,
    cantidad,
    precio,
    fecha_agregado,
    id_categoria,
  } = record;
  document.querySelector("#id_producto").value = id_producto;
  document.querySelector("#nombre_producto").value = nombre_producto;
  document.querySelector("#descripcion").value = descripcion;
  document.querySelector("#precio").value = precio;
  document.querySelector("#id_categoria").value = id_categoria;

  document.querySelector("#cantidad").classList.add("d-none");
  document.querySelector("#fecha_agregado").classList.add("d-none");
  document.querySelector("#cantidadlabel").classList.add("d-none");
  document.querySelector("#fechalabel").classList.add("d-none");
}

function eliminarProducto(id) {
  Swal.fire({
    title: "Esta seguro de eliminar el registro?",
    showDenyButton: true,
    confirmButtonText: `Si`,
    denyButtonText: `No`,
  }).then((result) => {
    if (result.isConfirmed) {
      API.deleteProducto(id)
        .then((data) => {
          if (data.success) {
            cancelarProducto();
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
  document.querySelector("#id_producto").value = "0";
}
