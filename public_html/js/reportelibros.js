//Variables y Selectores
const btnViewReport=document.querySelector("#btnViewReport");
const idAutor=document.querySelector("#id_autor");
const idCate=document.querySelector("#id_cate");
const frameReporte=document.querySelector("#framereporte");
const API= new Api();

//Eventos
eventListeners();

function eventListeners() {
	document.addEventListener("DOMContentLoaded",cargarDatos);
	btnViewReport.addEventListener("click",verReporte);
}

//Funciones

function cargarDatos() {
	API.loadCategorias().
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
	const optionAutor=document.createElement("option");
	optionAutor.value="0";
	optionAutor.textContent="Todos";
	idAutor.append(optionAutor);
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
	const optionCate=document.createElement("option");
	optionCate.value="0";
	optionCate.textContent="Todos";
	idCate.append(optionCate);
	records.forEach(item=>{
		const {id_cate, categoria}=item;
		const optionCate=document.createElement("option");
		optionCate.value=id_cate;
		optionCate.textContent=categoria;
		idCate.append(optionCate);
	});
}

function verReporte() {
	frameReporte.src=`${BASE_API}reportelibros/getReporte?idcate=${idCate.value}&idautor=${idAutor.value}`;
}