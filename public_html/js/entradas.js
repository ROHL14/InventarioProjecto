//Variables y Selectores
const tableContent = document.querySelector("#contentTable table tbody");
const pagination = document.querySelector(".pagination");
const searchText = document.querySelector("#txtSearch");
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
  miform.addEventListener("submit", guardarEntrada);
  btnCancelar.addEventListener("click", cancelarEntrada);
}

//Funciones

function cancelarEntrada() {
  panelDatos.classList.remove("d-none");
  panelFormulario.classList.add("d-none");
  cargarDatos();
}

function cargarDatos() {
  API.loadProdEntradas()
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
        categoria,
      } = item;
      html += `
          <tr>
			      <th scope="col">${index + 1}</th>
			      <th scope="col">${nombre_producto}</th>
            <th scope="col">${categoria}</th>
            <th scope="col">$ ${precio}</th>
			      <th scope="col">${cantidad}</th>
			      <th scope="col">
              <button class='btn btn-dark btn-xs' onclick='agregarCantidad("${id_producto}")'>
                <i class='far fa-edit'></i>
                Agregar al stock
              </button>
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

function agregarCantidad(id) {
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
  fecha = new Date();
  hoy =
    fecha.getFullYear() + "-" + (fecha.getMonth() + 1) + "-" + fecha.getDate();
  const { id_producto, cantidad, precio } = record;
  document.querySelector("#id_producto").value = id_producto;

  document.querySelector("#tipo_movimiento").value = "entrada";
  document.querySelector("#cantidad_inicial").value = cantidad;
  document.querySelector("#precio_inicial").value = precio * cantidad;
  document.querySelector("#precio").value = precio;
  document.querySelector("#fecha_movimiento").value = hoy;
}

function guardarEntrada(e) {
  e.preventDefault();
  const formdata = new FormData(miForm);
  API.saveProdEntradaCantidad(formdata)
    .then((data) => {
      if (data.success) {
        cancelarEntrada();
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

function limpiarForm(op) {
  miForm.reset();
  document.querySelector("#id_producto").value = "0";
}
