<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
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

    /**
     * Show the form for request services.
     *
     * @return \Illuminate\Http\Response
     */
    public function requestServices()
    {
        return view('clients.services');
    }

    /**
     * Show the list of orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function myOrders()
    {
        return view('clients.orders');
    }

    /**
     * Show the terms and conditions.
     *
     * @return \Illuminate\Http\Response
     */
    public function termsAndConditions()
    {
        return view('clients.terms');
    }

    /**
     * Show the frequent questions.
     *
     * @return \Illuminate\Http\Response
     */
    public function frequentQuestions()
    {
        return view('clients.questions');
    }

    /**
     * Show the privacy policies.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacyPolicies()
    {
        return view('clients.privacy');
    }
}
