//Variables y Selectores
const tableContent=document.querySelector("#contentTable table tbody");
const pagination=document.querySelector(".pagination");
const searchText=document.querySelector("#txtSearch");
const btnNew=document.querySelector("#btnAgregar");
const panelDatos=document.querySelector("#panelDatos");
const panelFormulario=document.querySelector("#panelFormulario");
const divFoto=document.querySelector("#divFotoP");
const divFotoM=document.querySelector("#divFotoM");
const divFotoG=document.querySelector("#divFotoG");
const idCate=document.querySelector("#id_cate");
const idAutor=document.querySelector("#id_autor");
const inputFoto=document.querySelector("#fotop");
const inputFotoM=document.querySelector("#fotom");
const inputFotoG=document.querySelector("#fotog");
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
	btnNew.addEventListener("click",agregarLibro);
	divFoto.addEventListener("click",agregarFoto);
	divFotoM.addEventListener("click",agregarFotoM);
	divFotoG.addEventListener("click",agregarFotoG);
	inputFoto.addEventListener("change",actualizarFoto);
	inputFotoM.addEventListener("change",actualizarFotoM);
	inputFotoG.addEventListener("change",actualizarFotoG);
	miform.addEventListener("submit",guardarLibro);
	btnCancelar.addEventListener("click",cancelarLibro);
}

//Funciones

function cancelarLibro() {
	panelDatos.classList.remove("d-none");
	panelFormulario.classList.add("d-none");
	cargarDatos();
}

function guardarLibro(e) {
	e.preventDefault();
	const formdata=new FormData(miForm);
	API.saveLibro(formdata)
		.then(data=>{
			if (data.success) {
				cancelarLibro();
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

function actualizarFoto(el) {
	if (el.target.files && el.target.files[0]) {
		const reader = new FileReader();
		reader.onload=e=>{
			divFoto.innerHTML=`<img src="${e.target.result}" class="h-100 w-100" style="object-fit:contain;">`;
		}
		reader.readAsDataURL(el.target.files[0]);
	}
}

function actualizarFotoM(el) {
	if (el.target.files && el.target.files[0]) {
		const reader = new FileReader();
		reader.onload=e=>{
			divFotoM.innerHTML=`<img src="${e.target.result}" class="h-100 w-100" style="object-fit:contain;">`;
		}
		reader.readAsDataURL(el.target.files[0]);
	}
}

function actualizarFotoG(el) {
	if (el.target.files && el.target.files[0]) {
		const reader = new FileReader();
		reader.onload=e=>{
			divFotoG.innerHTML=`<img src="${e.target.result}" class="h-100 w-100" style="object-fit:contain;">`;
		}
		reader.readAsDataURL(el.target.files[0]);
	}
}

function agregarFoto() {
	inputFoto.click();
}

function agregarFotoM() {
	inputFotoM.click();
}

function agregarFotoG() {
	inputFotoG.click();
}

function agregarLibro() {
	panelDatos.classList.add("d-none");
	panelFormulario.classList.remove("d-none");
	limpiarForm();
}

function cargarDatos() {
	API.loadLibros().
	then(data=>{
				if (data.success) {
					objDatos.records=data.records;
					objDatos.currentPage=1;
					crearTabla();
					return API.loadCategorias();
				} else {
					mensaje.textContent=data.msg;
				}
			}
	).
	then(data=>{
		rellenarCategorias(data.records);
		return API.loadAutores();
	}).
	then(data=>{
		rellenarAutores(data.records);
	}).
	catch(error=>{
			console.error("Error:",error);
		}
	);
}

function rellenarAutores(records) {
	idAutor.innerHTML="";
	records.forEach(item=>{
		const {id_autor, nombre}=item;
		const optionAutor=document.createElement("option");
		optionAutor.value=id_autor;
		optionAutor.textContent=nombre;
		idAutor.append(optionAutor);
	});
}

function rellenarCategorias(records) {
	idCate.innerHTML="";
	records.forEach(item=>{
		const {id_cate, categoria}=item;
		const optionCate=document.createElement("option");
		optionCate.value=id_cate;
		optionCate.textContent=categoria;
		idCate.append(optionCate);
	});
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
			const {titulo, descripcion, categoria, nombre}=item;
			if ((titulo.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) || (descripcion.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) || (categoria.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) || (nombre.toUpperCase().search(objDatos.filter.toUpperCase())!=-1)) {
				return item;
			}
		});
	}
	const recordIni=(objDatos.currentPage*recordShow)-recordShow;
	const recordFin=recordIni+recordShow-1;
	let html="";
	objDatos.recordsFilter.forEach((item,index)=>{
		if ((index>=recordIni) && (index<=recordFin)) {
			const {titulo, descripcion, categoria, nombre, id_libro}=item;
			html+=`<tr>
			      <th scope="col">${index+1}</th>
			      <th scope="col">${titulo}</th>
			      <th scope="col">${descripcion}</th>
			      <th scope="col">${categoria}</th>
			      <th scope="col">${nombre}</th>
			      <th scope="col"><button class='btn btn-primary btn-xs' onclick='editarLibro("${id_libro}")'><i class='far fa-edit'></i></button>&nbsp;&nbsp;<button class='btn btn-danger btn-xs' onclick='eliminarLibro("${id_libro}")'><i class='fas fa-trash-alt'></i></button></th>
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

function editarLibro(id) {
	limpiarForm(1);
	panelDatos.classList.add("d-none");
	panelFormulario.classList.remove("d-none");
	API.getOneLibro(id).
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
	const {id_libro,titulo,fecha_publicacion,descripcion,fotop,fotom,fotog,id_cate,id_autor}=record;
	document.querySelector("#id_libro").value=id_libro;
	document.querySelector("#titulo").value=titulo;
	document.querySelector("#fecha_publicacion").value=fecha_publicacion;
	document.querySelector("#descripcion").value=descripcion;
	document.querySelector("#id_cate").value=id_cate;
	document.querySelector("#id_autor").value=id_autor;
	if (fotop!="") {
		divFoto.innerHTML=`<img src="${fotop}" class="h-100 w-100" style="object-fit:contain;">`;
	}
	if (fotom!="") {
		divFotoM.innerHTML=`<img src="${fotom}" class="h-100 w-100" style="object-fit:contain;">`;
	}
	if (fotog!="") {
		divFotoG.innerHTML=`<img src="${fotog}" class="h-100 w-100" style="object-fit:contain;">`;
	}
}

function eliminarLibro(id) {
	Swal.fire({
	  title: 'Esta seguro de eliminar el registro?',
	  showDenyButton: true,
	  confirmButtonText: `Si`,
	  denyButtonText: `No`,
	}).then((result) => {
	  if (result.isConfirmed) {
	    API.deleteLibro(id).
			then(data=>{
						if (data.success) {
							cancelarLibro();
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
	document.querySelector("#id_libro").value="0";
	divFoto.innerHTML="";
	divFotoM.innerHTML="";
	divFotoG.innerHTML="";
}