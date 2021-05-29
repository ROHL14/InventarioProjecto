<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="<?php echo URL ?>public_html/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript" src="<?php echo URL; ?>public_html/js/api_user.js"></script>
<script type="text/javascript">
	const gallery = document.querySelector("#gallery");
	const API = new Api();

	//Eventos
	eventListeners();

	function eventListeners() {
		document.addEventListener("DOMContentLoaded", cargarGallery);
	}

	//Funciones

	function cargarGallery() {
		API.loadCategorias().
		then(data => {
			if (data.success) {
				mostrarOpciones(data.records);
			}
		}).catch(error => {
			console.error("Error:", error);
		});
	}

	function mostrarOpciones(records) {
		records.forEach(item => {
			const el = document.createElement("a");
			el.classList.add("dropdown-item");
			el.href = `<?php echo URL ?>gallery?id=${item.id_cate}`;
			el.textContent = item.categoria;
			gallery.append(el);
		});
	}
</script>