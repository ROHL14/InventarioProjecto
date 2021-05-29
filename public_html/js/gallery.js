//Variables y Selectores
const contenedor=document.querySelector("#contenedor");

//Eventos
eventListeners();

function eventListeners() {
	document.addEventListener("DOMContentLoaded",cargarDatos);
}

//Funciones

function cargarDatos() {
	API.loadLibros(ID).
	then(data=>{
				if (data.success) {
					mostrarGallery(data.records);
				}
			}
	).
	catch(error=>{
			console.error("Error:",error);
		}
	);
}

function mostrarGallery(records) {
	let html="<div class='row'>";
	records.forEach(item=>{
		const {fotop,titulo,descripcion,id_libro}=item;
		html+=`<div class="col-md-4 text-center"><img src="${fotop}" style="height:150px;" class="center-block" /> <br><h4 class="text-center">${titulo}</h4><p class="text-success text-center">${descripcion}</p><button class="btn btn-primary pull-right" onclick='window.location="${BASE_API}gallery/verlibro?id=${id_libro}"'>Ver</button></div>`;
	});
	html+="</div>";
	contenedor.innerHTML=html;
}