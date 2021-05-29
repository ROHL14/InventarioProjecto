//Variables y Selectores
const tableContent=document.querySelector("#contentTable table tbody");
const pagination=document.querySelector(".pagination");
const searchText=document.querySelector("#txtSearch");
const btnNew=document.querySelector("#btnAgregar");
const panelDatos=document.querySelector("#panelDatos");
const panelFormulario=document.querySelector("#panelFormulario");
const miForm=document.querySelector("#miform");
const btnCancelar=document.querySelector("#btnCancelar");
const recordShow=4;
const API= new Api();
const objDatos={
	records:[],
	recordsFilter:[],
	currentPage:1,
	filter:""
};
//Eventos
eventListeners();

function eventListeners() {
	document.addEventListener("DOMContentLoaded",cargarDatos);
	searchText.addEventListener("input",aplicarFiltro);
	btnNew.addEventListener("click",agregarAutor);
	miform.addEventListener("submit",guardarAutor);
	btnCancelar.addEventListener("click",cancelarAutor);
}

//Funciones

function cancelarAutor() {
	panelDatos.classList.remove("d-none");
	panelFormulario.classList.add("d-none");
	cargarDatos();
}

function guardarAutor(e) {
	e.preventDefault();
	const formdata=new FormData(miForm);
	API.saveAutor(formdata)
		.then(data=>{
			if (data.success) {
				cancelarAutor();
				Swal.fire({
				  icon: 'info',
				  text: data.msg
				});
			} else {
				Swal.fire({
				  icon: 'error',
				  title: 'Error',
				  text: data.msg
				});
			}
		})
		.catch(error=>{
			console.error("Error",error);
		})
}


function agregarAutor() {
	panelDatos.classList.add("d-none");
	panelFormulario.classList.remove("d-none");
	limpiarForm();
}

function cargarDatos() {
	API.loadAutores().
	then(data=>{
				if (data.success) {
					objDatos.records=data.records;
					objDatos.currentPage=1;
					crearTabla();
				} else {
					mensaje.textContent=data.msg;
				}
			}
	).catch(error=>{
			console.error("Error:",error);
		}
	);
}

function aplicarFiltro(e) {
	e.preventDefault();
	objDatos.filter=this.value;
	crearTabla();
}

function crearTabla() {
	if (objDatos.filter=="") {
		objDatos.recordsFilter=objDatos.records.map(item=>item);
	} else {
		objDatos.recordsFilter=objDatos.records.filter(item=>{
			const {nombre}=item;
			if ((nombre.toUpperCase().search(objDatos.filter.toUpperCase())!=-1)) {
				return item;
			}
		});
	}
	const recordIni=(objDatos.currentPage*recordShow)-recordShow;
	const recordFin=recordIni+recordShow-1;
	let html="";
	objDatos.recordsFilter.forEach((item,index)=>{
		if ((index>=recordIni) && (index<=recordFin)) {
			const {id_autor, nombre}=item;
			html+=`<tr>
			      <th scope="col">${index+1}</th>
			      <th scope="col">${nombre}</th>
			      <th scope="col"><button class='btn btn-primary btn-xs' onclick='editarAutor("${id_autor}")'><i class='far fa-edit'></i></button>&nbsp;&nbsp;<button class='btn btn-danger btn-xs' onclick='eliminarAutor("${id_autor}")'><i class='fas fa-trash-alt'></i></button></th>
			    </tr>`;
		}
	});
	tableContent.innerHTML=html;
	crearPaginacion();
}


function crearPaginacion() {
	while (pagination.firstElementChild) {
		pagination.removeChild(pagination.firstElementChild);
	}
	const elAnterior=document.createElement("li");
	elAnterior.classList.add("page-item");
	elAnterior.innerHTML=`<a class="page-link" href="#">Anterior</a>`;
	elAnterior.onclick=()=>{
		objDatos.currentPage=(objDatos.currentPage== 1 ? 1 : --objDatos.currentPage);
		crearTabla();
	};
	pagination.append(elAnterior);
	const totalPage=Math.ceil(objDatos.recordsFilter.length/recordShow);
	for (let i=1; i<=totalPage;i++) {
		const el=document.createElement("li");
		el.classList.add("page-item");
		el.innerHTML=`<a class="page-link" href="#">${i}</a>`;
		el.onclick=()=>{
			objDatos.currentPage=i;
			crearTabla();
		}
		pagination.append(el);
	}
	const elSiguiente=document.createElement("li");
	elSiguiente.classList.add("page-item");
	elSiguiente.innerHTML='<a class="page-link" href="#">Siguiente</a>';
	elSiguiente.onclick=()=>{
		objDatos.currentPage=(objDatos.currentPage== totalPage ? totalPage : ++objDatos.currentPage);
		crearTabla();
	};
	pagination.append(elSiguiente);
}

function editarAutor(id) {
	limpiarForm();
	panelDatos.classList.add("d-none");
	panelFormulario.classList.remove("d-none");
	API.getOneAutor(id).
	then(data=>{
				if (data.success) {
					mostrarDatosForm(data.records[0]);
				} else {
					Swal.fire({
					  icon: 'error',
					  title: 'Error',
					  text: data.msg
					});
				}
			}
	).catch(error=>{
			console.error("Error:",error);
		}
	);
}

function mostrarDatosForm(record) {
	const {id_autor,nombre}=record;
	document.querySelector("#id_autor").value=id_autor;
	document.querySelector("#nombre").value=nombre;
}

function eliminarAutor(id) {
	Swal.fire({
	  title: 'Esta seguro de eliminar el registro?',
	  showDenyButton: true,
	  confirmButtonText: `Si`,
	  denyButtonText: `No`,
	}).then((result) => {
	  if (result.isConfirmed) {
	    API.deleteAutor(id).
			then(data=>{
						if (data.success) {
							cancelarAutor();
						} else {
							Swal.fire({
							  icon: 'error',
							  title: 'Error',
							  text: data.msg
							});
						}
					}
			).catch(error=>{
					console.error("Error:",error);
				}
			);
	  }
	});
}

function limpiarForm(op) {
	miForm.reset();
	document.querySelector("#id_autor").value="0";
}