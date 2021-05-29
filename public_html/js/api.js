const BASE_API = "/inventarioprojecto/";

class Api {
  async validarLogin(form) {
    const query = await fetch(`${BASE_API}login/validar`, {
      method: "POST",
      body: form,
    });
    const data = await query.json();
    return data;
  }

  // Load
  async loadData() {
    const query = await fetch(`${BASE_API}usuarios/getAll`);
    const data = await query.json();
    return data;
  }

  async loadCategorias() {
    const query = await fetch(`${BASE_API}categorias/getAll`);
    const data = await query.json();
    return data;
  }

  async loadProductos() {
    const query = await fetch(`${BASE_API}productos/getAll`);
    const data = await query.json();
    return data;
  }

  async loadClientes() {
    const query = await fetch(`${BASE_API}clientes/getAll`);
    const data = await query.json();
    return data;
  }

  async loadSalidas() {
    const query = await fetch(`${BASE_API}salidas/getAll`);
    const data = await query.json();
    return data;
  }

  // Save
  async saveUser(form) {
    const query = await fetch(`${BASE_API}usuarios/save`, {
      method: "POST",
      body: form,
    });
    const data = await query.json();
    return data;
  }

  async saveCategoria(form) {
    const query = await fetch(`${BASE_API}categorias/save`, {
      method: "POST",
      body: form,
    });
    const data = await query.json();
    return data;
  }

  async saveProducto(form) {
    const query = await fetch(`${BASE_API}productos/save`, {
      method: "POST",
      body: form,
    });
    const data = await query.json();
    return data;
  }

  async saveCliente(form) {
    const query = await fetch(`${BASE_API}clientes/save`, {
      method: "POST",
      body: form,
    });
    const data = await query.json();
    return data;
  }

  async saveSalida(form) {
    const query = await fetch(`${BASE_API}salidas/save`, {
      method: "POST",
      body: form,
    });
    const data = await query.json();
    return data;
  }

  // GET one
  async getOneUser(id) {
    const query = await fetch(`${BASE_API}usuarios/getOneUser?id=${id}`);
    const data = await query.json();
    return data;
  }

  async getOneCategoria(id) {
    const query = await fetch(`${BASE_API}categorias/getOneCategoria?id=${id}`);
    const data = await query.json();
    return data;
  }

  async getOneProducto(id) {
    const query = await fetch(`${BASE_API}productos/getOneProducto?id=${id}`);
    const data = await query.json();
    return data;
  }

  async getOneCliente(id) {
    const query = await fetch(`${BASE_API}clientes/getOneCliente?id=${id}`);
    const data = await query.json();
    return data;
  }

  async getOneSalida(id) {
    const query = await fetch(`${BASE_API}salidas/getOneSalida?id=${id}`);
    const data = await query.json();
    return data;
  }

  // Delete
  async deleteUser(id) {
    const query = await fetch(`${BASE_API}usuarios/deleteUser?id=${id}`);
    const data = await query.json();
    return data;
  }

  async deleteCategoria(id) {
    const query = await fetch(`${BASE_API}categorias/deleteCategoria?id=${id}`);
    const data = await query.json();
    return data;
  }

  async deleteProducto(id) {
    const query = await fetch(`${BASE_API}productos/deleteProducto?id=${id}`);
    const data = await query.json();
    return data;
  }

  async deleteCliente(id) {
    const query = await fetch(`${BASE_API}clientes/deleteCliente?id=${id}`);
    const data = await query.json();
    return data;
  }

  async deleteSalida(id) {
    const query = await fetch(`${BASE_API}salidas/deleteSalidas?id=${id}`);
    const data = await query.json();
    return data;
  }
}
