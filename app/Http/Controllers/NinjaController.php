<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ninja;
use App\Models\Mission;

class NinjaController extends Controller
{
    //
    public function crearNinja(Request $request){

		$respuesta = "";

		//Procesar los datos recibidos
		$datos = $request->getContent();

		//Verificar que hay datos
		$datos = json_decode($datos);

		if($datos){
			if(Mission::find($datos->mission)){
				//Crear el ninja
				$ninja = new Ninja();


				//Valores obligatorios
				$ninja->name = $datos->name;
				$ninja->registration_date = $datos->date;
				$ninja->habilities = $datos->habilities;
				$ninja->rank = $datos->rank;
				$ninja->number = $datos->number;

				
					$ninja->mission_id = $datos->mission;
				
				//Guardar el ninja
				try{

					$ninja->save();

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

	public function modificarNinja(Request $request,$id){

		$respuesta = "";

		//Buscar si existe la nave
		$ninja = Ninja::find($id);

		if($ninja){

			//Procesar los datos recibidos
			$datos = $request->getContent();

			//Verificar que hay datos
			$datos = json_decode($datos);

			if($datos){

				//TODO: validar los datos introducidos

				//Valores obligatorios
				if(isset($datos->name))
					$ninja->name = $datos->name;
				if(isset($datos->date))
					$ninja->registration_dateatos->date;
				if(isset($datos->habilities))
					$ninja->habilities = $datos->habilities;
				if(isset($datos->rank))
					$ninja->rank = $datos->rank;
				if(isset($datos->number))
					$ninja->number = $datos->number;
				if(isset($datos->mission))
					$ninja->mission_id = $datos->mission;

				//Guardar el ninja
				try{

					$ninja->save();

					$respuesta = "OK";
				}catch(\Exception $e){
					$respuesta = $e->getMessage();
				}
			}else{
				$respuesta = "Incorrect Data";
			}
		}else{
			$response = "No ninja found";
		}


		return response($respuesta);
	}

	public function bajaNinja(Request $request,$id){

		$respuesta = "";

		//Buscar si existe la nave
		$ninja = Ninja::find($id);

		if($ninja){

			//Procesar los datos recibidos
			$datos = $request->getContent();

			//Verificar que hay datos
			$datos = json_decode($datos);

			if($datos){


				if(isset($datos->status))
					$ninja->status = $datos->status;

				//Modificar estado del ninja
				try{

					$ninja->save();

					$respuesta = "OK";
				}catch(\Exception $e){
					$respuesta = $e->getMessage();
				}
			}else{
				$respuesta = "Incorrect Data";
			}
		}else{
			$response = "No ninja found";
		}


		return response($respuesta);
	}

	public function verNinja($id){

		$ninja = Ninja::find($id);

		if($ninja){

			return response()->json(

				[
					"id" => $ninja->id,
					"name" => $ninja->name,
					"rank" => $ninja->rank,
					"number" => $ninja->number,
					"mission_id" => $ninja->mission_id,
					"habilities" => $ninja->nave->habilities,
					"registration_date" => $ninja->registration_date,
					"status" => $ninja->status
				]

			);
		}

		return response("ninja not found");

	}

	public function listarNinjasFiltro(Request $request){

		$ninjaClass = Ninja::class;

		if($request->request->get('name'))
			$ninjaClass = $ninjaClass::where('name',$request->request->get('name'));
		if($request->request->get('status'))
			$ninjaClass = $ninjaClass::where('status','like','%'.$request->request->get('status').'%');


		$ninjas = $ninjaClass->get();



		$resultado = [];

		foreach ($ninjas as $ninja) {
			
			$resultado[] = [

				"id" => $ninja->id,
				"name" => $ninja->name,
				"status" => $ninja->status

			];

		}

		return response()->json($resultado);

	}
}