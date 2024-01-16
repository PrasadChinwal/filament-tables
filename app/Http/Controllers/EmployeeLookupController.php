<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeLookup;
use App\Http\Resources\EmployeeLookup as EmployeeLookupResource;


class EmployeeLookupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$employee_lookup = EmployeeLookup::where('uin','like','%'.$request->search_filter.'%')->orwhere('lname','like','%'.$request->search_filter.'%')->orderBy('lname', 'asc')->orderBy('fname', 'asc')->get();
	$employee_lookup = EmployeeLookup::where('uin','like','%'.$request->search_filter.'%')->orwhereRaw("UPPER(lname) LIKE '" . strtoupper($request->search_filter) . "'")->orderBy('lname', 'asc')->orderBy('fname', 'asc')->get();
        return EmployeeLookupResource::collection($employee_lookup);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
