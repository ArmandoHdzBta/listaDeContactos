<?php

namespace Models;

class Contacto extends Conexion
{
	public $idcontacto;
	public $nombre;
	public $apellidoPaterno;
	public $apellidoMaterno;
	public $telefono;
	public $alias;
	public $persona;
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
		//preparamos la consulta como primer parametro es la conexion y el segundo es la consulta
		$pre = mysqli_prepare($this->con, "INSERT INTO contacto(nombre,apellido_paterno,apellido_materno,telefono,alias,persona) VALUES(?,?,?,?,?,?)");
		//agregamos los parametros a la consulta con su respectivo tipo de dato
		$pre->bind_param('sssssi',$this->nombre,$this->apellidoPaterno,$this->apellidoMaterno,$this->telefono,$this->alias,$this->persona);
		//guardamos el resultado de la consulta
		$res = $pre->execute();
		//retonamos el valor de la variable
		return $res;
	}
	static function all()
	{
		//objeto conexion a la BD
		$conexion = new Conexion();
		//preparamos la consulta como primer parametro es la conexion y el segundo es la consulta
		$pre = mysqli_prepare($conexion->con, "SELECT * FROM contacto");
		//ejecutamos la consulta
		$pre->execute();
		//obtenemos los valores
		$res = $pre->get_result();
		//recorremos todos los registros y los guardamos en un array
		while ($y = mysqli_fetch_assoc($res)) {
			$t[] = $y;
		}
		//devolvemos todos los datos
		return $t;
	}
	static function select($idcontacto)
	{
		//objeto conexion a la BD
		$conexion = new Conexion();
		//preparamos la consulta como primer parametro es la conexion y el segundo es la consulta
		$pre = mysqli_prepare($conexion->con, "SELECT * FROM contacto WHERE idcontacto=?");
		//agregamos los parametros a la consulta con su respectivo tipo de dato
		$pre->bind_param('i',$idcontacto);
		//ejecutamos la consulta
		$pre->execute();
		//obtenemos los valores
		$res = $pre->get_result();
		//obtenemos los valores de los campos
		$reg = mysqli_fetch_assoc($res);
		//retornamos el resultado
		return $reg;
	}
	public function update()
	{
		//preparamos la consulta como primer parametro es la conexion y el segundo es la consulta
		$pre = mysqli_prepare($this->con, "UPDATE contacto SET nombre=?,apellido_paterno=?,apellido_materno=?,telefono=?,alias=?,persona=? WHERE idcontacto=?");
		//agregamos los parametros a la consulta con su respectivo tipo de dato
		$pre->bind_param('sssssii',$this->nombre,$this->apellidoPaterno,$this->apellidoMaterno,$this->telefono,$this->alias,$this->persona,$this->idcontacto);
		//guardamos el resultado de la consulta
		$res = $pre->execute();
		//retonamos el valor de la variable
		return $res;
	}
	static function delete($idcontacto)
	{
		//objeto conexion a la BD
		$conexion = new Conexion();
		//preparamos la consulta como primer parametro es la conexion y el segundo es la consulta
		$pre = mysqli_prepare($conexion->con, "DELETE FROM contacto WHERE idcontacto = ?");
		//agregamos los parametros a la consulta con su respectivo tipo de dato
		$pre->bind_param('i',$idcontacto);
		//guardamos el resultado de la consulta
		$res = $pre->execute();
		//retonamos el valor de la variable
		return $res;
	}
}

?>