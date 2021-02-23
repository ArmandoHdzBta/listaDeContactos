<?php

namespace Models;

class Persona extends Conexion
{
	public $idpersona;
	public $nombre;
	//funcion contructor que nos ayudara a ejecutar el contructor de la clase conexion
	function __construct()
	{
		//se utiliza esto para que se pueda hacer uso de la clase Conexion
		//significa que tambien se va a correr el contructor padre
		parent::__construct();
	}
	//funcion que nos permite agregar un registro
	public function create()
	{
		//preparamos la consulta como primer parametro es la conexion a la BD y la consulta SQL
		$pre = mysqli_prepare($this->con, "INSERT INTO persona(nombre) VALUES (?)");
		//le mandamos los parametros con su respectivo tipo de dato
		$pre->bind_param('s', $this->nombre);
		//ejecutamos la consulta
		$res = $pre->execute();
		//devolvemos el valor de la consulta
		return $res;
	}
	static function all(){
		//objeto conexion a la BD
		$conexion = new Conexion();
		//preparamos la consulta como primer parametro es la conexion a la BD y la consulta SQL
		$pre = mysqli_prepare($conexion->con, "SELECT * FROM persona");
		//ejecutamos toda la consulta
		$pre->execute();
		//obtenemos todos los valores de la consulta
		$res = $pre->get_result();
		//recorremos todos los resultados y los guardamos en un array
		while ($y = mysqli_fetch_assoc($res)) {
			$t[] = $y;
		}
		//retornamos todo el array
		return $t;
	}
	static function select($idpersona)
	{
		//objeto conexion a la BD
		$conexion = new Conexion();
		//preparamos la consulta como primer parametro es la conexion a la BD y la consulta SQL
		$pre = mysqli_prepare($conexion->con, "SELECT * FROM persona WHERE idpersona = ?");
		//le mandamos los parametros con su respectivo tipo de dato
		$pre->bind_param('i', $idpersona);
		//ejecutamos toda la consulta
		$pre->execute();
		//obtenemos los resultados
		$res = $pre->get_result();
		//obtenemos las columnas
		$reg = mysqli_fetch_assoc($res);
		//retornamos los valores
		return $reg;
	}
	public function update()
	{
		//preparamos la consulta como primer parametro es la conexion a la BD y la consulta SQL
		$pre = mysqli_prepare($this->con, "UPDATE persona SET nombre = ? WHERE idpersona = ?");
		//le mandamos los parametros con su respectivo tipo de dato
		$pre->bind_param('si', $this->nombre, $this->idpersona);
		//ejecutamos la consulta
		$res = $pre->execute();
		//devolvemos el valor de la consulta
		return $res;
	}
	//funcion para borrar un registro
	static function delete($idpersona)
	{
		//objeto conexion a la BD
		$conexion = new Conexion();
		//preparamos la consulta como primer parametro es la conexion a la BD y la consulta SQL
		$pre = mysqli_prepare($conexion->con, "DELETE FROM persona WHERE idpersona = ?");
		//le mandamos los parametros con su respectivo tipo de dato
		$pre->bind_param('i', $idpersona);
		//ejecutamos toda la consulta
		$pre->execute();
	}
	static function contactosPersona($idpersona){
		//objeto conexion a la BD
		$conexion = new Conexion();
		//preparamos la consulta como primer parametro es la conexion a la BD y la consulta SQL
		$pre = mysqli_prepare($conexion->con, "SELECT contacto.nombre AS contacto_nombre, apellido_paterno, apellido_materno, telefono, alias FROM contacto INNER JOIN persona ON contacto.persona = persona.idpersona WHERE persona.idpersona = ?");
		//le mandamos los parametros con su respectivo tipo de dato
		$pre->bind_param('i', $idpersona);
		//ejecutamos toda la consulta
		$pre->execute();
		//obtenemos todos los valores de la consulta
		$res = $pre->get_result();
		//recorremos todos los resultados y los guardamos en un array
		while ($y = mysqli_fetch_assoc($res)) {
			$t[] = $y;
		}
		//retornamos todo el array
		return $t;
	}
}

?>