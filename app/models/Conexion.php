<?php
//definimos el nombre del espacio de trabajo
namespace Models;

class Conexion
{
	//variable publica para poder ocuparla en otras clases
	public $con;
	//contructor de la clase
	function __construct()
	{
		//declaramos la variables
		$host = "localhost";
		$usuario = "root";
		$pass = "";
		$bd = "lista_contactos";
		//conexion con mysqli_connect y se envian por parametro el host, el usuario, la contraseña y la base de datos que se va a ocupar
		$this->con = mysqli_connect($host, $usuario, $pass, $bd);
		//con esto le decimos que va a permitir la insercion de caracteres especiales
		mysqli_query($this->con,"SET NAMES utf8");
	}
}

?>