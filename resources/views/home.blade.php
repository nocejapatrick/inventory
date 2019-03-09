@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        @if(Auth::user()->role == 'Admin')
            <admin-component></admin-component>
        @endif
        <item-list></item-list>
        @if(Auth::user()->role == 'User')
             <div class="col-md-12">
                <h2 class="mt-4">Request Lists</h2>
                     <request-lists-container></request-lists-container>
             </div>
        @endif
        <!-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }} 
                        </div>
                    @endif
                    You are logged in!
                </div>
            </div>
        </div> -->
    </div>
</div>
@endsection
