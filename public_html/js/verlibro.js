//Variables y Selectores
const contenedor=document.querySelector("#contenedor");

//Eventos
eventListeners();

function eventListeners() {
	document.addEventListener("DOMContentLoaded",cargarDatos);
}

//Funciones

function cargarDatos() {
	API.getOneLibro(ID).
	then(data=>{
				if (data.success) {
					verLibro(data.records[0]);
				}
			}
	).
	catch(error=>{
			console.error("Error:",error);
		}
	);
}

function verLibro(record) {
	let html="<div class='row'>";
	const {fotom,titulo,descripcion,id_libro,nombre,fecha}=record;
	html+=`<div class="col-md-6 text-center"><img src="${fotom}" class="w-100 h-100" style="object-fit:contain;"/></div><div class="col-md-6"><h4 class="text-center">${titulo}</h4><p>Autor:${nombre}</p><p>Fecha de publicacion:${fecha}</p><p class="text-success">${descripcion}</p></div>`;
	html+="</div>";
	contenedor.innerHTML=html;
}