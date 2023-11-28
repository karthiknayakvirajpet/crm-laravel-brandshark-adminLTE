<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $companies = Company::all();

        if ($request->ajax()) {
            return response()->json(['data' => $companies]);
        }
        
        return view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyCreateRequest $request)
    {
        // Validation has passed - CompanyCreateRequest

        $company = new Company();
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');

        if($request->file('logo'))
        {
            $company->logo = $request->file('logo')->store('logos','public');
        }
        $company->save();

        if($company && $company->email) //Email Notification
        {
            $email = $company->email;
            //$email = 'karthiknykb@gmail.com';

            try
            {
                $data = array('company_name' => $company->name, );

                \Mail::send('emails.company_created', $data, function ($message) use($email)
                {
                    $message->to($email)->subject('Welcome!!');
                });

                \Log::debug('Email sent successfully : '. $email);
            }
            catch (\Exception $e) 
            {
                \Log::error("Error while sending email : ". $e->getMessage());
            }
        }

        return redirect()->route('company.index')->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        // Validation has passed - CompanyUpdateRequest

        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');

        if($request->file('logo'))
        {
            $company->logo = $request->file('logo')->store('logos','public');
        }
        $company->save();

        return redirect()->route('company.index')->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Company::where('id', $id)->delete();
        Employee::where('company_id', $id)->delete();
        return response()->json(['success'=>'Company and related Employees deleted successfully.']);
    }
}
