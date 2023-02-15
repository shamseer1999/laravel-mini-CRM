<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result=Company::where('status','=',1)->paginate(10);
        $data['results']=$result;
       return view('companies.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.add');
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
        ]);

        $filename='';
        if(request()->hasFile('logo'))
        {
            $exe=request('logo')->extension();
            $filename='Logo_'.time().'.'.$exe;
            request('logo')->storeAs('public',$filename);
        }


        $company = new Company;
        $company->company_name=$validate['name'];
        $company->email=$request->email;
        $company->compay_logo=$filename;
        $company->website=$request->website;
        $company->save();

        return redirect()->route('companies.index');

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
        $company_id=decrypt($id);
        $company=Company::find($company_id);
        $data['edit_data']=$company;
        return view('companies.edit',$data);
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
        $company_id=decrypt($id);
        $company=Company::find($company_id);

        $validate=$request->validate([
            'name'=>'required',
        ]);

        $filename='';
        if(request()->hasFile('logo'))
        {
            $exe=request('logo')->extension();
            $filename='Logo_'.time().'.'.$exe;
            request('logo')->storeAs('public',$filename);
        }

        if($filename=='')
        {
            $filename=$company->compay_logo;
        }

        $company->company_name=$validate['name'];
        $company->email=$request->email;
        $company->compay_logo=$filename;
        $company->website=$request->website;
        $company->update();

        return redirect()->route('companies.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
