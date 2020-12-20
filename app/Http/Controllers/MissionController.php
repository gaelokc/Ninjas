<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ninja;
use App\Models\Employer;
use App\Models\Mission;

class MisionController extends Controller
{
    //
    public function crearMision(Request $request){

		$respuesta = "";

		//Procesar los datos recibidos
		$datos = $request->getContent();

		//Verificar que hay datos
		$datos = json_decode($datos);

		if($datos){
			//TODO: validar los datos introducidos
			if(Employer::find($datos->employer)&&Ninja::find($datos->ninja)){
				//Crear la mision
				$mission = new Mission();


				//Valores obligatorios
				$mission->mission_date = $datos->date;
				$mission->description = $datos->description;
				$mission->ninjas_required = $datos->ninjas_required;
				$mission->priority = $datos->priority;
				$mission->payment = $datos->payment;
				$mission->status = $datos->status;
				$mission->mission_end_date = $datos->mission_end_date;
				$mission->ninja_id = $datos->ninja;
				$mission->employer_id = $datos->employer;
				
				
				//Guardar la mision
				try{

					$mision->save();

					$respuesta = "OK";
				}catch(\Exception $e){
					$respuesta = $e->getMessage();
				}

			}else{
				$respuesta = "Employer or Ninja incorrect";
			}

		}else{
			$respuesta = "Incorrect data";
		}
		


		return response($respuesta);
	}

	public function modificarMision(Request $request,$id){

		
		$respuesta = "";

		//Procesar los datos recibidos
		$datos = $request->getContent();

		//Verificar que hay datos
		$datos = json_decode($datos);

		if($mission){

			//Procesar los datos recibidos
			$datos = $request->getContent();

			//Verificar que hay datos
			$datos = json_decode($datos);

			if($datos){

				//TODO: validar los datos introducidos

				//Valores obligatorios
				if(isset($datos->mission_date))
					$employer->mission_date = $datos->mission_date;
				if(isset($datos->description))
					$employer->description = $datos->description;
				if(isset($datos->ninjas_required))
					$employer->ninjas_required = $datos->ninjas_required;
				if(isset($datos->priority))
					$employer->priority = $datos->priority;
				if(isset($datos->payment))
					$employer->payment = $datos->payment;
				if(isset($datos->status))
					$employer->status = $datos->status;
				if(isset($datos->mission_end_date))
					$employer->mission_end_date = $datos->mission_end_date;

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
			$response = "No mission found";
		}

		return response($respuesta);
	}

	public function verMision($id){

		$mission = Mission::find($id);

		return response()->json([
			"ninja" => $mission->ninja->number,
			"employer" => $mission->employer->secret_number,
			"status" => $mission->status,
			"payment" => $mission->payment
		]);

	}
}
