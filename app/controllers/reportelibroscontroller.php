<?php
include_once "app/models/libros.php";
include_once "vendor/autoload.php";
class ReporteLibrosController extends Controller{
	private $libro;
	public function __construct($param) {
		$this->libro=new Libros();
		parent::__construct("reportelibros",$param,true);
	}
	public function getReporte() {
		$resultado=$this->libro->getLibrosReporte($_GET);
		$htmlheader="<h1>Book Store Online</h1>";
		$htmlheader.="<h3>Listado general de libros</h3>";
		$html="<table width='100%' border='1'><thead><tr>";
		$html.="<th>Corr</th>";
		$html.="<th>Titulo</th>";
		$html.="<th>Descripcion</th>";
		$html.="<th>Categoria</th>";
		$html.="<th>Autor</th>";
		$html.="<th>Fecha de publicación</th>";
		$html.="</tr></thead><tbody>";
		foreach ($resultado as $key => $value) {
			$html.="<tr>";
			$html.="<td>".($key+1)."</td>";
			$html.="<td>{$value['titulo']}</td>";
			$html.="<td>{$value['descripcion']}</td>";
			$html.="<td>{$value['categoria']}</td>";
			$html.="<td>{$value['nombre']}</td>";
			$html.="<td>{$value['fecha_pub']}</td>";
			$html.="</tr>";
		}
		$html.="</tbody></table>";
		$mpdfConfig=array(
				'mode'=>'utf-8',
				'format'=>'Letter',
				'default_font_size'=>0,
				'default_font'=>'',
				'margin_left'=>10,
				'margin_right'=>10,
				'margin_header'=>10,
				'margin_footer'=>20,
				'margin_top'=>40,
				'orientation'=>'P'
		);
		$mpdf= new \Mpdf\Mpdf($mpdfConfig);
		$mpdf->SetHTMLHeader($htmlheader);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}
}
