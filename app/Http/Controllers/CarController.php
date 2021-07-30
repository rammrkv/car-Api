<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarDetails;
use Log;
use Illuminate\Support\Facades\Auth;
use Validator;

class CarController extends Controller
{
	public function addCar(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'brand' => 'required|string',
			'model' => 'required|string',
			'model_year' => 'required',
			'colour' => 'required|string',
			'registration_no' => 'required|string|unique:car_details',
			'mileage_drove' => 'required',
			'status' => 'required|string',
			'is_published' => 'required|string',
        ]);
		
		if ($validator->fails()) {
           return response()->json(['Status' => 'Failed','Msg' => $validator->messages()->first()], 200);
        }

		try {

			$car = new CarDetails;
			$car->user_id = Auth::user()->user_id;
			$car->brand = $request->input('brand');
			$car->model = $request->input('model');
			$car->model_year = $request->input('model_year');
			$car->colour = $request->input('colour');
			$car->registration_no = $request->input('registration_no');
			$car->mileage_drove = $request->input('mileage_drove');
			$car->status = $request->input('status');
			$car->is_published = $request->input('is_published');
			$car->created_at = date('Y-m-d H:i:s');
			$car->updated_at = date('Y-m-d H:i:s');
			$car->save();

			//return successful response
			return response()->json(['Status' => 'Success','CarDetails' => $car, 'Msg' => 'Car Added Sussesfully'], 200);

		} catch (\Exception $e) {
			//return error message
			Log::info($e);
			return response()->json(['Status' => 'Failed','Msg' => 'Unable To Add The Details!'], 200);
		}

	}
  
	public function getCar($carId)
    {
		try {
			
            $car = CarDetails::findOrFail($carId);
            
            if($car->user_id == Auth::user()->user_id){
				return response()->json(['Status' => 'Sucess','CarDetails' => $car], 200);
			}
			else{
				return response()->json(['Status' => 'Failed','Msg' => 'Car Info Not Unauthorized !'], 200);
			}
            

        } catch (\Exception $e) {

            return response()->json(['Status' => 'Failed','Msg' => 'Car Info Not Found!'], 200);
        }
    }
	
	public function updateCarInfo(Request $request)
    {
		$validator = Validator::make($request->all(), [
            'car_id' => 'required',
			'brand' => 'required|string',
			'model' => 'required|string',
			'model_year' => 'required',
			'colour' => 'required|string',
			'registration_no' => 'required|unique:car_details,registration_no,'.$request->input('car_id').',car_id',
			'mileage_drove' => 'required',
			'status' => 'required|string',
			'is_published' => 'required|string',
        ]);
        
        #Log::info(print_r($request->all(),true));
        
		if ($validator->fails()) {
           return response()->json(['Status' => 'Failed','Msg' => $validator->messages()->first()], 200);
        }

        try {

            $car = CarDetails::find($request->input('car_id'));
            
            if($car->car_id == $request->input('car_id') && $car->user_id == Auth::user()->user_id){
				
				$car->brand = $request->input('brand');
				$car->model = $request->input('model');
				$car->model_year = $request->input('model_year');
				$car->colour = $request->input('colour');
				$car->registration_no = $request->input('registration_no');
				$car->mileage_drove = $request->input('mileage_drove');
				$car->status = $request->input('status');
				$car->is_published = $request->input('is_published');
				$car->updated_at = date('Y-m-d H:i:s');
				$car->save();

				//return successful response
				return response()->json(['Status' => 'Success','Car' => $car, 'Msg' => 'Car Updated Sussesfully'], 200);
			}
			else{
				return response()->json(['Status' => 'Failed','Msg' => 'Invalid Car Info!'], 200);
			}

        } catch (\Exception $e) {
            //return error message
            //Log::info($e);
            return response()->json(['Status' => 'Failed','Msg' => 'Unable To Update!'], 200);
        }
    }
    
	public function updateCarStatus(Request $request)
    {
		
		$validator = Validator::make($request->all(), [
            'car_id' => 'required',
			'status' => 'required|string',
        ]);
        
		if ($validator->fails()) {
           return response()->json(['Status' => 'Failed','Msg' => $validator->messages()->first()], 200);
        }

        try {

            $car = CarDetails::find($request->input('car_id'));
            
            if($car->car_id == $request->input('car_id') && $car->user_id == Auth::user()->user_id){
				
				$car->status = $request->input('status');
				$car->updated_at = date('Y-m-d H:i:s');
				$car->save();

				//return successful response
				return response()->json(['Status' => 'Success', 'Msg' => 'Car Updated Sussesfully'], 200);
			}
			else{
				return response()->json(['Status' => 'Failed','Msg' => 'Invalid Car Info!'], 200);
			}

        } catch (\Exception $e) {
            //return error message
            //Log::info($e);
            return response()->json(['Status' => 'Failed','Msg' => 'Unable To Update!'], 200);
        }
    }
    
	public function deleteCar($carId)
    {
        try {

            $car = CarDetails::find($carId);
            
            if($car->car_id == $carId && $car->user_id == Auth::user()->user_id){
				
				$car->delete();

				//return successful response
				return response()->json(['Status' => 'Success', 'Msg' => 'Car Removed Sussesfully'], 200);
			}
			else{
				return response()->json(['Status' => 'Failed','Msg' => 'Invalid Car Info!'], 200);
			}

        } catch (\Exception $e) {
            //return error message
            //Log::info($e);
            return response()->json(['Status' => 'Failed','Msg' => 'Unable To Remove!'], 200);
        }
    }
    
	public function getCarList()
    {
        try {

            $car = CarDetails::where('user_id',Auth::user()->user_id)->where('status','!=','D')->get();
            
            return response()->json(['Status' => 'Success','Car' => $car], 201);

        } catch (\Exception $e) {
            //return error message
            //Log::info($e);
            return response()->json(['Status' => 'Failed','Msg' => 'No Cars Found!'], 200);
        }
    }
    
	public function getAvblCarList()
    {
        try {

            $car = CarDetails::with('user')->where('status','=','A')->where('is_published','=','Y')->orderBy('updated_at','DESC')->get();
            
            return response()->json(['Status' => 'Success','Car' => $car], 201);

        } catch (\Exception $e) {
            //return error message
            //Log::info($e);
            return response()->json(['Status' => 'Failed','Msg' => 'Unable To Remove!'], 200);
        }
    }
}
