<?php
require 'app/models/Conexion.php';
require 'app/models/Persona.php';

use Models\Conexion;
use Models\Persona;

class PersonaController
{
	//funcion para insertar recibimos por metodo post
	public function insert()
	{
		//se verifica que la variable no este vacia
		if ($_POST['nombre'] != "") {
			$persona = new Persona();
			$persona->nombre = $_POST['nombre'];
			echo ($persona->create()) ? "Persona agregada" : "error";
		}else{
			echo "Campo vacio";
		}
	}
	//funcion que nos devuele todos los registros
	public function mostrarTodo()
	{
		$result = Persona::all();
		//se muestran en formato JSON
		echo json_encode($result);
	}
	//funcion que nos devuele 1 registro
	public function mostrarUno()
	{
		//verificamos que la variable no este vacia
		if (($_POST['idpersona'] != "")){
			$result = Persona::select($_POST['idpersona']);
			//mostramos el resultado en formato JSON
			echo json_encode($result);
		}else{
			echo "No hay regristros";
		}
	}
	//funcion que nos permite actualizar los datos
	public function actualizar()
	{
		//verificamos que ninguno de las dos variables esten vacias
		if (($_POST['idpersona'] != "") || ($_POST['nombre'] != "")) {
			$persona = new Persona();
			$persona->idpersona = $_POST['idpersona'];
			$persona->nombre = $_POST['nombre'];
			echo ($persona->update()) ? "Persona actualizada" : "error";
		}
	}
	//funcion que nos permite borrar el registro
	public function borrar()
	{
		//se verifica que la variable no este vacia
		if ($_POST['idpersona'] != "") {
			$result = Persona::delete($_POST['idpersona']);
			//si se hizo correctamente mostrara un mensaje al igual si fallo
			echo ($result) ? "Persona borrada" : "error";
		}
	}
	//funcion que nos muestra todos los contactos de tal persona
	public function contactos()
	{
		$idpersona = $_POST['idpersona'];
		$result = Persona::contactosPersona($idpersona);
		//se muestran en formato JSON
		echo json_encode($result);
	}
}

?>