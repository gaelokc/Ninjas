<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Employer;
use App\Models\Mission;

class ClienteController extends Controller
{
    //
    public function crearCliente(Request $request){

		$respuesta = "";

		//Procesar los datos recibidos
		$datos = $request->getContent();

		//Verificar que hay datos
		$datos = json_decode($datos);

		if($datos){
			if(Mission::find($datos->mission)){
				//Crear el cliente
				$employer = new Employer();


				//Valores obligatorios
				$employer->firts_mission_date = $datos->date;
				$employer->vip_client = $datos->vip_client;
				$employer->secret_number = $datos->number;

				
					$employer->mission_id = $datos->mission;
				
				//Guardar el cliente
				try{

					$employer->save();

					$respuesta = "OK";
				}catch(\Exception $e){
					$respuesta = $e->getMessage();
				}

			}else{
				$respuesta = "Incorrect mission identifier";
			}

		}else{
			$respuesta = "Incorrect Data";
		}
		


		return response($respuesta);
	}

	public function modificarCliente(Request $request,$id){

		$respuesta = "";

		//Buscar si existe la nave
		$employer = Employer::find($id);

		if($employer){

			//Procesar los datos recibidos
			$datos = $request->getContent();

			//Verificar que hay datos
			$datos = json_decode($datos);

			if($datos){

				//TODO: validar los datos introducidos

				//Valores obligatorios
				if(isset($datos->vip_client))
					$employer->vip_client = $datos->vip_client;
				if(isset($datos->secret_number))
					$employer->secret_number = $datos->secret_number;

				//Guardar el cliente
				try{

					$employer->save();

					$respuesta = "OK";
				}catch(\Exception $e){
					$respuesta = $e->getMessage();
				}
			}else{
				$respuesta = "Incorrect Data";
			}
		}else{
			$response = "No employer found";
		}


		return response($respuesta);
	}

	public function verCliente($id){

		$employer = Employer::find($id);

		if($employer){

			return response()->json(

				[
					"id" => $employer->id,
					"secret_number" => $employer->secret_number,
					"mission_id" => $employer->mission_id,
					"firts_mission_date" => $employer->firts_mission_date,
					"vip_client" => $employer->vip_client
				]

			);
		}

		return response("Employer not found");

	}

}