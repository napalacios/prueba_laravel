<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Commune;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\CustomerSearchRequest;
use App\Http\Requests\CustomerDeleteRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {

        try {
            
            $data = $request->validated();

            $commune = Commune::where('communes.id_com', '=', $data['id_com'])
            ->where('communes.id_reg', '=', $data['id_reg'])
            ->rightJoin('regions', 'regions.id_reg', '=', 'communes.id_reg')
            ->where('communes.status', '=', 'A')
            ->where('regions.status', '=', 'A');

            if (is_null($commune)) {

                return response(['success' => false], 400);    
            
            }
            
            $customer = new Customer();
            $customer->dni = $data['dni'];
            $customer->id_reg = $data['id_reg'];
            $customer->id_com = $data['id_com'];
            $customer->email = $data['email'];
            $customer->name = $data['name'];
			$customer->last_name = $data['last_name'];
            $customer->adress = $data['adress'];
            $customer->date_reg =  Carbon::now();
            $customer->status = 'A';

            if (!$customer->save()) {
                return response(['success' => false], 400);  
            }else{
                return response(['success' => true], 201);  
            }            

        } catch (\Exception $e) {

            return response(['success' => false], 400);  

        }
    }

    /**
     * Display a filtered resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(CustomerSearchRequest $request)
    {

        try {
            
            $data = $request->validated();
            
            $customers = Customer::query()->where(function ($query) use ($data) {
                $query->where('dni', '=',  $data['search'])
                ->orWhere('email', '=', $data['search']);
            })
            ->where('status', '=', 'A');


            if(env('APP_DEBUG')){

                Log::create([
                    'id_usuario' => Auth::user()->id,
                    'operacion' => 'SEARCH',
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'parametros' => $data['search'],
                ]);

            }

            return CustomerResource::collection($customers);

        } catch (\Exception $e) {
            return response('', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerDeleteRequest $request)
    {
        
        try {
            
            $data = $request->validated();            

            $customer = Customer::where('dni', '=', $data['dni'])
            ->where('status', '=', 'A');

            if (is_null($customer)) {

                return response(['success' => false, 'message' => 'Registro no existe'], 400);    
            
            }
        
            $customer->status = 'trash';

            if (!$customer->save()) {
                return response(['success' => false], 400);  
            }
            
            return response(['success' => true], 204);

        } catch (\Exception $e) {
            return response(['success' => false], 400);  
        }
    }
}