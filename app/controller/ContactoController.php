<?php
require 'app/models/Conexion.php';
require 'app/models/Contacto.php';

use Models\Conexion;
use Models\Contacto;

class ContactoController
{
	//funcion que nos ayuda a insertar un registro
	public function insert()
	{
		//verificamos que ninguna de las variables este vacia
		if ($_POST['nombre']!="" || $_POST['tel']!="" || $_POST['alias']!="" || $_POST['persona']!="") {
			$contacto = new Contacto();
			$contacto->nombre = $_POST['nombre'];
			$contacto->apellidoPaterno = $_POST['app'];
			$contacto->apellidoMaterno = $_POST['apm'];
			$contacto->telefono = $_POST['tel'];
			$contacto->alias = $_POST['alias'];
			$contacto->persona = $_POST['persona'];
			echo ($contacto->create()) ? "Contacto guardado" : "Contacto no guardado";
		}
	}
	//funcion que nos permite visualisar todos los datos
	public function mostrarTodo()
	{
		$result = Contacto::all();
		//se muestran en formato JSON
		echo json_encode($result);
	}
	//funcion que nos permite visualizar solo 1 registro
	public function mostrarUno()
	{
		if ($_POST['idcontacto']!="") {
			$result = Contacto::select($_POST['idcontacto']);
			//se muestran en formato JSON
			echo json_encode($result);
		}
	}
	//funcion que nos permite actualizar los datos
	public function editar()
	{
		//verificamos que ninguna de las variables este vacia
		if ($_POST['nombre']!="" || $_POST['app']!="" || $_POST['apm']!="" || $_POST['tel']!="" || $_POST['alias']!="" || $_POST['persona']!="" || $_POST['idcontacto']!="") {
			$contacto = new Contacto();
			$contacto->idcontacto = $_POST['idcontacto'];
			$contacto->nombre = $_POST['nombre'];
			$contacto->apellidoPaterno = $_POST['app'];
			$contacto->apellidoMaterno = $_POST['apm'];
			$contacto->telefono = $_POST['tel'];
			$contacto->alias = $_POST['alias'];
			$contacto->persona = $_POST['persona'];
			echo ($contacto->update()) ? "Contacto actualizado" : "Contacto no actualizado";
		}
	}
	//funcion que nos permite borrar el registro
	public function borrar()
	{
		//se verifica que la variable no este vacia
		if ($_POST['idcontacto'] != "") {
			$result = Contacto::delete($_POST['idcontacto']);
			//si se hizo correctamente mostrara un mensaje al igual si fallo
			echo ($result) ? "Contacto borrado" : "error";
		}
	}
}

?>