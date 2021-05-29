const BASE_API = "/inventario/";

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
  async loadLibros() {
    const query = await fetch(`${BASE_API}libros/getAll`);
    const data = await query.json();
    return data;
  }
  async loadAutores() {
    const query = await fetch(`${BASE_API}libros/getAllAutores`);
    const data = await query.json();
    return data;
  }
  /*async loadCategorias() {
    const query = await fetch(`${BASE_API}libros/getAllCategorias`);
    const data = await query.json();
    return data;
  }
  async loadPaises() {
    const query = await fetch(`${BASE_API}libros/getAllPaises`);
    const data = await query.json();
    return data;
  }*/
  async loadCategorias() {
    const query = await fetch(`${BASE_API}categorias/getAll`);
    const data = await query.json();
    return data;
  }
  async loadPaises() {
    const query = await fetch(`${BASE_API}paises/getAll`);
    const data = await query.json();
    return data;
  }
  async loadCintas() {
    const query = await fetch(`${BASE_API}cintas/getAll`);
    const data = await query.json();
    return data;
  }
  async loadHorarios() {
    const query = await fetch(`${BASE_API}horarios/getAll`);
    const data = await query.json();
    return data;
  }
  async loadEncargados() {
    const query = await fetch(`${BASE_API}encargados/getAll`);
    const data = await query.json();
    return data;
  }
  async loadTorneos() {
    const query = await fetch(`${BASE_API}torneos/getAll`);
    const data = await query.json();
    return data;
  }
  async loadEquipo() {
    const query = await fetch(`${BASE_API}equipo/getAll`);
    const data = await query.json();
    return data;
  }
  async loadAlumnos() {
    const query = await fetch(`${BASE_API}alumnos/getAll`);
    const data = await query.json();
    return data;
  }
  async loadParticipantes() {
    const query = await fetch(`${BASE_API}participantes/getAll`);
    const data = await query.json();
    return data;
  }
  async loadPrestamos() {
    const query = await fetch(`${BASE_API}prestamos/getAll`);
    const data = await query.json();
    return data;
  }
  async loadAsistencia() {
    const query = await fetch(`${BASE_API}asistencia/getAll`);
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
  async saveLibro(form) {
    const query = await fetch(`${BASE_API}libros/save`, {
      method: "POST",
      body: form,
    });
    const data = await query.json();
    return data;
  }
  async saveAutor(form) {
    const query = await fetch(`${BASE_API}autores/save`, {
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
  async savePais(form) {
    const query = await fetch(`${BASE_API}paises/save`, {
      method: "POST",
      body: form,
    });
    const data = await query.json();
    return data;
  }
  async saveCinta(form) {
    const query = await fetch(`${BASE_API}cintas/save`, {
      method: "POST",
      body: form,
    });
    const data = await query.json();
    return data;
  }
  async saveHorario(form) {
    const query = await fetch(`${BASE_API}horarios/save`, {
      method: "POST",
      body: form,
    });
    const data = await query.json();
    return data;
  }
  async saveEncargado(form) {
    const query = await fetch(`${BASE_API}encargados/save`, {
      method: "POST",
      body: form,
    });
    const data = await query.json();
    return data;
  }
  async saveTorneo(form) {
    const query = await fetch(`${BASE_API}torneos/save`, {
      method: "POST",
      body: form,
    });
    const data = await query.json();
    return data;
  }
  async saveEquipo(form) {
    const query = await fetch(`${BASE_API}equipo/save`, {
      method: "POST",
      body: form,
    });
    const data = await query.json();
    return data;
  }
  async saveAlumno(form) {
    const query = await fetch(`${BASE_API}alumnos/save`, {
      method: "POST",
      body: form,
    });
    const data = await query.json();
    return data;
  }
  async saveParticipante(form) {
    const query = await fetch(`${BASE_API}participantes/save`, {
      method: "POST",
      body: form,
    });
    const data = await query.json();
    return data;
  }
  async savePrestamo(form) {
    const query = await fetch(`${BASE_API}prestamos/save`, {
      method: "POST",
      body: form,
    });
    const data = await query.json();
    return data;
  }
  async saveAsistencia(form) {
    const query = await fetch(`${BASE_API}asistencia/save`, {
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
  async getOneAutor(id) {
    const query = await fetch(`${BASE_API}autores/getOneAutor?id=${id}`);
    const data = await query.json();
    return data;
  }
  async getOneLibro(id) {
    const query = await fetch(`${BASE_API}libros/getOneLibro?id=${id}`);
    const data = await query.json();
    return data;
  }
  async getOneCategoria(id) {
    const query = await fetch(`${BASE_API}categorias/getOneCategoria?id=${id}`);
    const data = await query.json();
    return data;
  }
  async getOnePais(id) {
    const query = await fetch(`${BASE_API}paises/getOnePais?id=${id}`);
    const data = await query.json();
    return data;
  }
  async getOneCinta(id) {
    const query = await fetch(`${BASE_API}cintas/getOneCinta?id=${id}`);
    const data = await query.json();
    return data;
  }
  async getOneHorario(id) {
    const query = await fetch(`${BASE_API}horarios/getOneHorario?id=${id}`);
    const data = await query.json();
    return data;
  }
  async getOneEncargado(id) {
    const query = await fetch(`${BASE_API}encargados/getOneEncargado?id=${id}`);
    const data = await query.json();
    return data;
  }
  async getOneTorneo(id) {
    const query = await fetch(`${BASE_API}torneos/getOneTorneo?id=${id}`);
    const data = await query.json();
    return data;
  }
  async getOneEquipo(id) {
    const query = await fetch(`${BASE_API}equipo/getOneEquipo?id=${id}`);
    const data = await query.json();
    return data;
  }
  async getOneAlumno(id) {
    const query = await fetch(`${BASE_API}alumnos/getOneAlumno?id=${id}`);
    const data = await query.json();
    return data;
  }
  async getOneParticipante(id) {
    const query = await fetch(
      `${BASE_API}participantes/getOneParticipante?id=${id}`
    );
    const data = await query.json();
    return data;
  }
  async getOnePrestamo(id) {
    const query = await fetch(`${BASE_API}prestamos/getOnePrestamo?id=${id}`);
    const data = await query.json();
    return data;
  }
  async getOneAsistencia(id) {
    const query = await fetch(
      `${BASE_API}asistencia/getOneAsistencia?id=${id}`
    );
    const data = await query.json();
    return data;
  }

  // Delete
  async deleteUser(id) {
    const query = await fetch(`${BASE_API}usuarios/deleteUser?id=${id}`);
    const data = await query.json();
    return data;
  }
  async deleteLibro(id) {
    const query = await fetch(`${BASE_API}libros/deleteLibro?id=${id}`);
    const data = await query.json();
    return data;
  }
  async deleteAutor(id) {
    const query = await fetch(`${BASE_API}autores/deleteAutor?id=${id}`);
    const data = await query.json();
    return data;
  }
  async deleteCategoria(id) {
    const query = await fetch(`${BASE_API}categorias/deleteCategoria?id=${id}`);
    const data = await query.json();
    return data;
  }
  async deletePais(id) {
    const query = await fetch(`${BASE_API}paises/deletePais?id=${id}`);
    const data = await query.json();
    return data;
  }
  async deleteCinta(id) {
    const query = await fetch(`${BASE_API}cintas/deleteCinta?id=${id}`);
    const data = await query.json();
    return data;
  }
  async deleteHorario(id) {
    const query = await fetch(`${BASE_API}horarios/deleteHorario?id=${id}`);
    const data = await query.json();
    return data;
  }
  async deleteEncargado(id) {
    const query = await fetch(`${BASE_API}encargados/deleteEncargado?id=${id}`);
    const data = await query.json();
    return data;
  }
  async deleteTorneo(id) {
    const query = await fetch(`${BASE_API}torneos/deleteTorneo?id=${id}`);
    const data = await query.json();
    return data;
  }
  async deleteEquipo(id) {
    const query = await fetch(`${BASE_API}equipo/deleteEquipo?id=${id}`);
    const data = await query.json();
    return data;
  }
  async deleteAlumno(id) {
    const query = await fetch(`${BASE_API}alumnos/deleteAlumno?id=${id}`);
    const data = await query.json();
    return data;
  }
  async deleteParticipante(id) {
    const query = await fetch(
      `${BASE_API}participantes/deleteParticipante?id=${id}`
    );
    const data = await query.json();
    return data;
  }
  async deletePrestamo(id) {
    const query = await fetch(`${BASE_API}prestamos/deletePrestamo?id=${id}`);
    const data = await query.json();
    return data;
  }
  async deleteAsistencia(id) {
    const query = await fetch(
      `${BASE_API}asistencia/deleteAsistencia?id=${id}`
    );
    const data = await query.json();
    return data;
  }
}
