//Variables y Selectores
const btnViewReportUser = document.querySelector("#btnViewReportUser");
const btnViewReportProduct = document.querySelector("#btnViewReportProduct");
const btnViewReportMov = document.querySelector("#btnViewReportMov");
const rolUser = document.querySelector("#rol");
const idCate = document.querySelector("#id_categoria");
const tipoMov = document.querySelector("#tipo_mov");
const idUser = document.querySelector("#id");
const idProd = document.querySelector("#id_producto");
const frameReporteUser = document.querySelector("#framereporteUser");
const frameReporteProduct = document.querySelector("#framereporteProduct");
const frameReporteMov = document.querySelector("#framereporteMov");
const API = new Api();

//Eventos
eventListeners();

function eventListeners() {
  document.addEventListener("DOMContentLoaded", cargarDatos);
  btnViewReportUser.addEventListener("click", verReporteUsuario);
  btnViewReportProduct.addEventListener("click", verReporteProduct);
  btnViewReportMov.addEventListener("click", verReporteMov);
}

//Funciones

function cargarDatos() {
  API.loadCategorias()
    .then((data) => {
      rellenarCategorias(data.records);
      return API.loadData();
    })
    .then((data) => {
      rellenarUsuarios(data.records);
      return API.loadProductos();
    })
    .then((data) => {
      rellenarProductos(data.records);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function rellenarCategorias(records) {
  idCate.innerHTML = "";
  const optionCate = document.createElement("option");
  optionCate.value = "0";
  optionCate.textContent = "Todos";
  idCate.append(optionCate);
  records.forEach((item) => {
    const { id_categoria, categoria } = item;
    const optionCate = document.createElement("option");
    optionCate.value = id_categoria;
    optionCate.textContent = categoria;
    idCate.append(optionCate);
  });
}

function rellenarUsuarios(records) {
  idUser.innerHTML = "";
  const optionCate = document.createElement("option");
  optionCate.value = "0";
  optionCate.textContent = "Todos";
  idUser.append(optionCate);
  records.forEach((item) => {
    const { id, username } = item;
    const optionCate = document.createElement("option");
    optionCate.value = id;
    optionCate.textContent = username;
    idUser.append(optionCate);
  });
}

function rellenarProductos(records) {
  idProd.innerHTML = "";
  const optionCate = document.createElement("option");
  optionCate.value = "0";
  optionCate.textContent = "Todos";
  idProd.append(optionCate);
  records.forEach((item) => {
    const { id_producto, nombre_producto } = item;
    const optionCate = document.createElement("option");
    optionCate.value = id_producto;
    optionCate.textContent = nombre_producto;
    idProd.append(optionCate);
  });
}

function verReporteUsuario() {
  frameReporteUser.src = `${BASE_API}reportes/getReporteUsuarios?rol=${rolUser.value}`;
}

function verReporteProduct() {
  frameReporteProduct.src = `${BASE_API}reportes/getReporteProductos?id_categoria=${idCate.value}`;
}
function verReporteMov() {
  frameReporteMov.src = `${BASE_API}reportes/getReporteMovimientos?tipo_mov=${tipoMov.value}&id=${idUser.value}&id_producto=${idProd.value}`;
}
