<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class DataProviderController extends Controller
{

    public function provider(Request $request)
    {
        if (method_exists($this, 'get' . $request->provider)) {
            return $this->{'get' . $request->provider}($request);
        }
        return response(
            [
                'message' => 'Opps! No data found.',
            ],
            406
        );
    }

    public function getEmployee(Request $request)
    {
      
        return Employee::all();
    }
}
