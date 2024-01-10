<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerObserver
{

    public function saved(Customer $customer)
    {   

        if($customer->status == 'trash'){
            $operacion = "DELETE";
        }else{
            $operacion = "CREATE";
        }
        
        Log::create([
            'id_usuario' => Auth::user()->id,
            'operacion' => $operacion,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'parametros' => $customer->dni,
        ]);

    }    
}