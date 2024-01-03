<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    //

    public function action(Request $request)
    {
        if (method_exists($this, 'for' . $request->action)) {
            return $this->{'for' . $request->action}($request);
        }
        return response(
            [
                'message' => 'Opps! action not found.',
            ],
            406
        );
    }

    protected function forEmployeeDataEntry(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
        ]);
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone_number = $request->phone_number;
        $employee->address = $request->address;
        $employee->save();
        return response(
            [
                'message' => 'Employee added successfully.',
            ],
            200
        );
    }

    public function forEmployeeDataUpdate(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('employees')->ignore($request->id),
            ],
            'phone_number' => [
                'required',
                Rule::unique('employees')->ignore($request->id),
            ],
            'address' => 'required',
        ]);
        $employee = Employee::find($request->id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone_number = $request->phone_number;
        $employee->address = $request->address;
        $employee->save();
        return response(
            [
                'message' => 'Employee updated successfully.',
            ],
            200
        );
    }
}
