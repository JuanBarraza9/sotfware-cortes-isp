<?php

namespace App\Http\Controllers;

use SoapClient;


class adminbcmServerSoapClient extends Controller
{
    	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='https://190.104.210.138:7117/ws/index.php?WSDL';
	/**
	 * The PHP SoapClient object
	 *
	 * @var object
	 */
	public static $_Server=null;

	/**
	 * Send a SOAP request to the server
	 *
	 * @param string $method The method name
	 * @param array $param The parameters
	 * @return mixed The server response
	 */
	public static function _Call($method,$param){
		if(is_null(self::$_Server))
			self::$_Server=new SoapClient(self::$_WsdlUri);
		return self::$_Server->__soapCall($method,$param);
	}

	/**
	 * Obtener el codigo del usuario logueado
	 *
	 * @return int Codigo
	 */
	public function getUser(){
		return self::_Call('getUser',Array(
		));
	}

	/**
	 * @return string json de datos
	 */
	public function getPlantillaNotificaciones(){
		return self::_Call('getPlantillaNotificaciones',Array(
		));
	}

	/**
	 * Obtener datos plan cliente mediante la ip del cliente
	 *
	 * @param string $ip ip del usuario
	 * @return string json de datos
	 */
	public function datosClientePlan($ip){
		return self::_Call('datosClientePlan',Array(
			$ip
		));
	}

	/**
	 * Obtener los datos del plan del cliente mediante el numero del plan
	 *
	 * @param string $codClientePlan del usuario
	 * @return string json de datos
	 */
	public function datosPlanCliente($codClientePlan){
		return self::_Call('datosPlanCliente',Array(
			$codClientePlan
		));
	}

	/**
	 * Obtener los datos del plan del cliente mediante el numero de serie
	 *
	 * @param string $serialNumber
	 * @return string json de datos
	 */
	public function datosPlanClienteSn($serialNumber){
		return self::_Call('datosPlanClienteSn',Array(
			$serialNumber
		));
	}

	/**
	 * Funcion para obtener los planes con sus respectivos clientes bloqueados
	 *
	 * @return string json de datos
	 */
	public function clientesBloqueados(){
		return self::_Call('clientesBloqueados',Array(
		));
	}

	/**
	 * Funcion para obtener Listado de clientes
	 *
	 * @return string json de datos
	 */
	public function listadoClientes(){
		return self::_Call('listadoClientes',Array(
		));
	}

	/**
	 * Obtener codigo de planes y nombres de los planes del cliente
	 *
	 * @param string $codCliente Codigo unico que identifica al cliente
	 * @return string json de datos
	 */
	public function planesCliente($codCliente){
		return self::_Call('planesCliente',Array(
			$codCliente
		));
	}

	/**
	 * Funcion para eliminar un  cliente (Da error si tiene planes cargados para ver los planes del usuario usar la funcion planesCliente)
	 *
	 * @param string $codCliente Codigo unico que identifica al cliente
	 * @return int codigo de Error
	 */
	public function clienteBaja($codCliente){
		return self::_Call('clienteBaja',Array(
			$codCliente
		));
	}

	/**
	 * Funcion devuelve un bool (true o false) si un cliente tiene todos los planes bloqueados(cliente bloqueado)
	 *
	 * @param string $codCliente Codigo unico que identifica al cliente
	 * @return boolean
	 */
	public function obtenerBloqueado($codCliente){
		return self::_Call('obtenerBloqueado',Array(
			$codCliente
		));
	}

	/**
	 * Funcion para dar de alta un nuevo cliente ejemplo
	 * $codCliente = "1000";
	 * $indices=array("t_persona","nombre","apellido","telefono1","domicilio","id_ciudad","id_provincia","usuariocav","clavecav");
	 * $datos = array("1","Tester SOAP Aldta","asdasd","1234567d8","Humber2to 863","1","1","user_giammarino_test","passpppoe");
	 * clienteAlta($codCliente,$indice,$datos);
	 * Posibles Indices:
	 * indice['nombre']
	 * indice['apellido']
	 * indice['contacto']
	 * indice['dni']
	 * indice['fechaNac']
	 * indice['t_iva']
	 * indice['telefono1']
	 * indice['telefono2']
	 * indice['email']
	 * indice['desea_rec']
	 * indice['domicilio']
	 * indice['cp']
	 * indice['id_ciudad']
	 * indice['id_provincia']
	 * indice['obs']
	 * indice['activo']
	 * indice['essocio']
	 * indice['usuariocav']
	 * indice['clavecav']
	 *
	 * @param string $codCliente Codigo unico que identifica al cliente
	 * @param stringArray $indices Array de nombres de los datos del plan a cargar
	 * @param stringArray $datos Array de datos del plan a cargar
	 * @return int codigo de Error
	 */
	public function clienteAlta($codCliente,$indices,$datos){
		return self::_Call('clienteAlta',Array(
			$codCliente,
			$indices,
			$datos
		));
	}

	/**
	 * Funcion para modificar un cliente con los mismos campos que la funcion clienteAlta
	 *
	 * @param string $codCliente Codigo unico que identifica al cliente
	 * @param stringArray $indices Array de nombres de los datos del plan a cargar
	 * @param stringArray $datos Array de datos del plan a cargar
	 * @return int codigo de Error
	 */
	public function clienteMod($codCliente,$indices,$datos){
		return self::_Call('clienteMod',Array(
			$codCliente,
			$indices,
			$datos
		));
	}

	/**
	 * Funcion para Bloquear o Desbloquear un cliente Ejemplo clienteActualizarBloqueo ('1052',true);
	 *
	 * @param string $codCliente Id del cliente a modificar
	 * @param boolean $bloquear Bloquear o desbloquear el cliente
	 * @return int Response
	 */
	public function clienteActualizarBloqueo($codCliente,$bloquear){
		return self::_Call('clienteActualizarBloqueo',Array(
			$codCliente,
			$bloquear
		));
	}

	/**
	 * Funcion genera una notificacion en el bcm como por ejemplo dar de alta una orden de trabajo para que se de de alta un plan.
	 * $codCliente = "1000";
	 * $indices=array("plan","equipamiento","ubicacion" ...);
	 * $datos = array("3Mb","Caja 5,"San martin 500",...);
	 * generarOT($codCliente,$indices,$datos)
	 *
	 * @param string $codCliente Codigo unico que identifica al cliente
	 * @param stringArray $indices Array de nombres de los datos de la orden de trabajo
	 * @param stringArray $datos Array de datos de la orden de trabajo
	 * @return int codigo de Error
	 */
	public function generarOT($codCliente,$indices,$datos){
		return self::_Call('generarOT',Array(
			$codCliente,
			$indices,
			$datos
		));
	}

	/**
	 * Eliminar un plan de un  cliente
	 *
	 * @param string $codClientePlan Codigo unico que identifica al plan del cliente
	 * @return int codigo de Error
	 */
	public function planBaja($codClientePlan){
		return self::_Call('planBaja',Array(
			$codClientePlan
		));
	}

	/**
	 * Bloquear o Desbloquear un cliente
	 *
	 * @param string $codClientePlan Codigo unico del plan a modificar
	 * @param boolean $bloquear Bloquear o desbloquear el cliente
	 * @return int Response
	 */
	public function planActualizarBloqueo($codClientePlan,$bloquear){
		return self::_Call('planActualizarBloqueo',Array(
			$codClientePlan,
			$bloquear
		));
	}

	/**
	 * Bloquear o Desbloquear Catv de un Plan
	 *
	 * @param string $codClientePlan Codigo unico del plan a modificar
	 * @param boolean $bloquear Bloquear o desbloquear catv
	 * @return int Response
	 */
	public function planActualizarBloqueoCatv($codClientePlan,$bloquear){
		return self::_Call('planActualizarBloqueoCatv',Array(
			$codClientePlan,
			$bloquear
		));
	}

}
