<?php

namespace App\Http\Controllers;

use App\Request as UserRequest;
use Illuminate\Http\Request;
use App;
use Illuminate\Http\Response;
use PDF;
use App\RequestTransaction;

class RequestController extends Controller
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
       UserRequest::create($request->all());
        return response()->json("Success");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {   
        //
        $userRequest = UserRequest::where('request_transaction_id',$id)->with('item')->get();
        return response()->json($userRequest);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserRequest $userRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }

    public function pdf(Request $request,$id){
        $userRequest = UserRequest::where('request_transaction_id',$id)->with('item')->get();
        $transcation = RequestTransaction::where('id',$id)->with('user')->first();
        // return response()->json($userRequest);
        $data = ['username'=>$transcation->user->name,'id'=>$userRequest[0]->request_transaction_id,'requests'=>$userRequest,'created_at'=>$transcation->created_at,'date_approved'=>$userRequest[0]->updated_at,'remarks'=>$transcation->transaction_remarks];
        $pdf = PDF::loadView('pdf.invoice', $data);
        return $pdf->download('invoice.pdf');
    
    }
}
