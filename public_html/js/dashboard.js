totalProdSection = document.querySelector("#productosTotales");
distintosProdSection = document.querySelector("#productosDistintos");
valInvSection = document.querySelector("#valorInventario");
userRegSection = document.querySelector("#usuariosRegistrados");
const API = new Api();

//Eventos
eventListeners();

function eventListeners() {
  document.addEventListener("DOMContentLoaded", cargarDatos);
}

//Funciones

function cargarDatos() {
  API.loadMovimientos()
    .then((data) => {
      if (data.success) {
        crearStats(data.records);
        return API.loadProductos();
      } else {
        mensaje.textContent = data.msg;
      }
    })
    .then((data) => {
      contarProductos(data.records);
      return API.loadData();
    })
    .then((data) => {
      contarUsuarios(data.records);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function crearStats(records) {
  countSalidas = 0;
  countEntradas = 0;
  totalProductos = 0;

  records.forEach((item, index) => {
    const { id_movimiento, tipo_mov, cantidad_final, precio_final } = item;
    if (tipo_mov == "salida") {
      countSalidas += 1;
    } else {
      countEntradas += 1;
    }
    totalProductos += parseInt(cantidad_final);
  });
  totalProdSection.innerText = totalProductos;
}

function contarProductos(records) {
  totalProductosDistintios = 0;
  totalValor = 0;

  records.forEach((item, index) => {
    const { cantidad, precio } = item;
    totalProductosDistintios += 1;
    totalValor += parseFloat(cantidad * precio);
  });
  distintosProdSection.innerText = totalProductosDistintios;
  valInvSection.innerText = "$" + totalValor;
}

function contarUsuarios(records) {
  countUsuarios = 0;

  records.forEach((item, index) => {
    countUsuarios += 1;
  });
  userRegSection.innerText = countUsuarios;
}
