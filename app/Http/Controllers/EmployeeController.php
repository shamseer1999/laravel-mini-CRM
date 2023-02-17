<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;

use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['results']=Employee::with('companies')->paginate(10);
        return view('employees.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['companies']=Company::where('status',1)->get();
        return view('employees.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate=$request->validate([
            'name'=>'required',
            'lname'=>'required',
            
        ]);

        $employee = new Employee;
        $employee->first_name=$validate['name'];
        $employee->last_name=$validate['lname'];
        $employee->email=$request->email;
        $employee->company_id=$request->company;
        $employee->phone=$request->phone;
        $employee->save();

        return redirect()->route('employees.index')->with('success','Employee added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee_id=decrypt($id);
        $employee=Employee::find($employee_id);
        $data['companies']=Company::where('status',1)->get();
        $data['edit_data']=$employee;
        
        return view('employees.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee_id=decrypt($id);
        $employee=Employee::find($employee_id);

        $validate=$request->validate([
            'name'=>'required',
            'lname'=>'required',
            
        ]);

        $employee->first_name=$validate['name'];
        $employee->last_name=$validate['lname'];
        if(!empty($request->email))
        {
            $employee->email=$request->email;
        }

        if(!empty($request->phone))
        {
            $employee->phone=$request->phone;
        }
        
        $employee->company_id=$request->company;
        
        $employee->save();

        return redirect()->route('employees.index')->with('sucess','Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee_id=decrypt($id);
        $employee=Employee::find($employee_id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success','Employee deleted successfully');
    }
}
