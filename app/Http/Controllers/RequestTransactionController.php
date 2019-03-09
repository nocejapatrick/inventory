<?php

namespace App\Http\Controllers;

use App\RequestTransaction;
use Illuminate\Http\Request;
use App\Request as UserRequest;

class RequestTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(RequestTransaction::with('user')->orderBy('id','DESC')->get());
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
        $transaction_id = RequestTransaction::create($request->all());
        
        return response()->json(['transaction_id'=>$transaction_id->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RequestTransaction  $requestTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(RequestTransaction $requestTransaction,$id)
    {
        //
        $request = $requestTransaction::where('id',$id)->with('request')->get();
        return response()->json($request);
    }
    
    public function sendToUserRequest(Request $request){
        $transaction = UserRequest::where('id',$request->input('id'))->first();
       if($request->input('action')){
        $transaction->status = 'Approve';
       }else{
        $transaction->status = 'Decline';
       }
       $transaction->save();
    }

    public function sendRemark(Request $request){
        $transaction = RequestTransaction::where('id',$request->input('id'))->first();
        $transaction->transaction_remarks = $request->input('remarks');
        $transaction->save();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RequestTransaction  $requestTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestTransaction $requestTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RequestTransaction  $requestTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestTransaction $requestTransaction,$id)
    {
        //
        $request1 = RequestTransaction::find($id);

        $request1->status = $request->input('status');
        $request1->save();
        return response()->json($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RequestTransaction  $requestTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestTransaction $requestTransaction)
    {
        //
    }
}
