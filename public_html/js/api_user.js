const BASE_API = "/taekwondo/";

class Api {
  async loadCategorias() {
    const query = await fetch(`${BASE_API}main/getAllCategorias`);
    const data = await query.json();
    return data;
  }
  async loadLibros(id) {
    const query = await fetch(`${BASE_API}gallery/getLibros?id=${id}`);
    const data = await query.json();
    return data;
  }
  async getOneLibro(id) {
    const query = await fetch(`${BASE_API}gallery/getOneLibro?id=${id}`);
    const data = await query.json();
    return data;
  }
}
