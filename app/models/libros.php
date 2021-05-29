<?php
include_once "app/models/db.class.php";
class Libros extends BaseDeDatos
{
	public function __construct()
	{
		parent::conectar();
	}

	public function getAll()
	{
		return $this->executeQuery("Select a.*, b.categoria,c.nombre from autores c inner join (categorias b inner join libros a on b.id_cate=a.id_cate) on c.id_autor=a.id_autor");
	}

	public function getLibrosByCategory($id)
	{
		return $this->executeQuery("Select a.*, b.categoria,c.nombre from autores c inner join (categorias b inner join libros a on b.id_cate=a.id_cate) on c.id_autor=a.id_autor where b.id_cate='$id'");
	}

	public function getOneLibroByID($id)
	{
		return $this->executeQuery("Select a.*, b.categoria,c.nombre, date_format(a.fecha_publicacion,'%d-%m-%Y') as fecha from autores c inner join (categorias b inner join libros a on b.id_cate=a.id_cate) on c.id_autor=a.id_autor where a.id_libro='$id'");
	}

	public function getAllCategorias()
	{
		return $this->executeQuery("Select * from categorias");
	}

	public function getAllAutores()
	{
		return $this->executeQuery("Select * from autores");
	}

	public function save($data, $imgP, $imgM, $imgG)
	{
		return $this->executeInsert("insert into libros set titulo='{$data['titulo']}', descripcion='{$data['descripcion']}', id_cate='{$data['id_cate']}', id_autor='{$data['id_autor']}', fotop='{$imgP}', fotom='$imgM', fotog='$imgG', fecha_publicacion='{$data['fecha_publicacion']}'");
	}

	public function update($data, $imgP, $imgM, $imgG)
	{
		return $this->executeUpdate("update libros set titulo='{$data['titulo']}', descripcion='{$data['descripcion']}', id_cate='{$data['id_cate']}', id_autor='{$data['id_autor']}', fotop=if('{$imgP}'='',fotop,'{$imgP}'), fotom=if('$imgM'='',fotom,'$imgM'), fotog=if('$imgG',fotog,'$imgG'), fecha_publicacion='{$data['fecha_publicacion']}' where id_libro='{$data['id_libro']}'");
	}

	public function getLibroByTitulo($titulo)
	{
		return $this->executeQuery("Select * from libros where titulo='$titulo'");
	}

	public function getLibroByTituloAndId($titulo, $id)
	{
		return $this->executeQuery("Select * from libros where titulo='$titulo' and id_libro<>'$id'");
	}

	public function getOneLibro($id)
	{
		return $this->executeQuery("Select * from libros where id_libro='$id'");
	}

	public function deleteLibro($id)
	{
		return $this->executeUpdate("delete from libros where id_libro='$id'");
	}

	public function getLibrosReporte($data)
	{
		$condicion = "";
		if ($data["idautor"] != "0") {
			$condicion .= " and c.id_autor='{$data['idautor']}'";
		}
		if ($data["idcate"] != "0") {
			$condicion .= " and b.id_cate='{$data['idcate']}'";
		}
		return $this->executeQuery("Select a.*, date_format(a.fecha_publicacion,'%d/%m/%Y') as fecha_pub, b.categoria, c.nombre from autores c inner join (categorias b inner join libros a on b.id_cate=a.id_cate) on c.id_autor=a.id_autor where 1=1 $condicion");
	}
}
