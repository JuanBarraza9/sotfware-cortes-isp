<?php

namespace App\Http\Controllers;
use SoapClient;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use App\Http\Controllers\adminbcmServerSoapClient;


class ApiController extends Controller
{
    
    public function generarActive() {

        return view('api.generar-activacion');
    } //* end method

    public function generarActivePost() {
        $client = new Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'api-key' => env('API_ISPCUBE_APIKEY'),
            'client-id' => env('API_ISPCUBE_CLIENTID'),
            'login-type' => env('API_ISPCUBE_LOGINTYPE'),
            'username' => env('API_ISPCUBE_USERNAME'),
            'Authorization' => env('API_ISPCUBE_AUTHORIZATION')
        ];
    
        $request = new Request('GET', 'https://online11.ispcube.com/api/customers/customers_list', $headers);
        
        $response = $client->sendAsync($request)->wait();
        // Puedes trabajar con los datos de respuesta en $responseData
        $responseBody = json_decode($response->getBody(), true);
        
        $userDebts = array(); // Array donde se guardarán los usuarios con deuda mayor a cero

        foreach ($responseBody as $res) {
            if ($res['duedebt'] <= 0) {
                // Si el usuario tiene deuda igual a cero, se agrega al arreglo $userDebts
                $userDebts[] = $res['code'];
            }
        }

        $arrayEnteros = array_map('intval', $userDebts);

        $gruposDeUsuarios = array_chunk($arrayEnteros, 500);

        //* Conexion a la api de Sopnet

        $user = env('API_SOPNET_USER'); // Usuario
        $pass = env('API_SOPNET_PASSWORD'); // Contraseña
        $url = env('API_SOPNET_URL');
    
        ini_set('soap.wsdl_cache_enabled',0);
    
        $soapOptions = array(
            'cache_wsdl' => WSDL_CACHE_NONE,
            'trace'          => 1,
            'stream_context' => stream_context_create(
                [
                    'ssl' => [
                        'verify_peer'       => false,
                        'verify_peer_name'  => false,
                        'allow_self_signed' => true
                    ]
                ]
                    ),
            'soap_version' => SOAP_1_2,
            'login' => $user,
            'password' => $pass,
        );
    
        // Crear instancia de SoapClient
        $class = adminbcmServerSoapClient::$_Server=new SoapClient(adminbcmServerSoapClient::$_WsdlUri,$soapOptions);
    
        foreach ($gruposDeUsuarios as $grupo) {

            // Llamar método en servidor SOAP para cada usuario en $grupo
            // true = cortar
            // false = activar
            foreach ($grupo as $id) {
                $bloqueo = $class->clienteActualizarBloqueo($id, false);
                sleep(1); // Agregar una pausa de 1 segundo entre cada consulta
            }

        }
        $notification = array(
            'message' => 'Activación realizada Correctamente!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //* end method


    public function generarCortes() {

        return view('api.generar-cortes');
    } //* end method

    public function generarCortesPost(){
        $client = new Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'api-key' => env('API_ISPCUBE_APIKEY'),
            'client-id' => env('API_ISPCUBE_CLIENTID'),
            'login-type' => env('API_ISPCUBE_LOGINTYPE'),
            'username' => env('API_ISPCUBE_USERNAME'),
            'Authorization' => env('API_ISPCUBE_AUTHORIZATION')
        ];
    
        $request = new Request('GET', 'https://online11.ispcube.com/api/customers/customers_list', $headers);
        
        $response = $client->sendAsync($request)->wait();
        // Puedes trabajar con los datos de respuesta en $responseData
        $responseBody = json_decode($response->getBody(), true);
        
        $userDebts = array(); // Array donde se guardarán los usuarios con deuda mayor a cero

        foreach ($responseBody as $res) {
            if ($res['duedebt'] > 0) {
                // Si el usuario tiene deuda igual a cero, se agrega al arreglo $userDebts
                $userDebts[] = $res['code'];
            }
        }

        $arrayEnteros = array_map('intval', $userDebts);

        $gruposDeUsuarios = array_chunk($arrayEnteros, 500);

        //* Conexion a la api de Sopnet

        $user = env('API_SOPNET_USER'); // Usuario
        $pass = env('API_SOPNET_PASSWORD'); // Contraseña
        $url = env('API_SOPNET_URL');
    
        ini_set('soap.wsdl_cache_enabled',0);
    
        $soapOptions = array(
            'cache_wsdl' => WSDL_CACHE_NONE,
            'trace'          => 1,
            'stream_context' => stream_context_create(
                [
                    'ssl' => [
                        'verify_peer'       => false,
                        'verify_peer_name'  => false,
                        'allow_self_signed' => true
                    ]
                ]
                    ),
            'soap_version' => SOAP_1_2,
            'login' => $user,
            'password' => $pass,
        );
    
        // Crear instancia de SoapClient
        $class = adminbcmServerSoapClient::$_Server=new SoapClient(adminbcmServerSoapClient::$_WsdlUri,$soapOptions);
    
        foreach ($gruposDeUsuarios as $grupo) {
            // Llamar método en servidor SOAP para cada usuario en $grupo
            // true = cortar
            // false = activar
            foreach ($grupo as $id) {
                $bloqueo = $class->clienteActualizarBloqueo($id, true);
                sleep(1); // Agrega una pausa de 1 segundo entre cada consulta
            }

        }


        $notification = array(
            'message' => 'Cortes realizados Correctamente!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //* end method
}
