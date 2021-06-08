//Variables y Selectores
const tableContent = document.querySelector("#contentTable table tbody");
const pagination = document.querySelector(".pagination");
const searchText = document.querySelector("#txtSearch");
const panelDatos = document.querySelector("#panelDatos");
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
}

//Funciones

function cargarDatos() {
  API.loadMovimientos()
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
      const { nombre_producto, categoria, username, tipo_mov } = item;
      if (
        nombre_producto.toUpperCase().search(objDatos.filter.toUpperCase()) !=
          -1 ||
        categoria.toUpperCase().search(objDatos.filter.toUpperCase()) != -1 ||
        username.toUpperCase().search(objDatos.filter.toUpperCase()) != -1 ||
        tipo_mov.toUpperCase().search(objDatos.filter.toUpperCase()) != -1
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
        precio,
        categoria,
        cantidad_inicial,
        cantidad_final,
        precio_inicial,
        precio_final,
        tipo_mov,
        fecha_movimiento,
        username,
      } = item;
      html += `
          <tr>
			      <th scope="col">${index + 1}</th>
			      <th scope="col">${nombre_producto}</th>
            <th scope="col">$${precio}</th>
            <th scope="col">${categoria}</th>
			      <th scope="col">${cantidad_inicial}</th>
            <th scope="col">${cantidad_final}</th>
            <th scope="col">${precio_inicial}</th>
            <th scope="col">${precio_final}</th>
            <th scope="col">${tipo_mov}</th>
            <th scope="col">${fecha_movimiento}</th>
            <th scope="col">${username}</th>
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
