<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
    *{
        font-family:'Montserrat';
    }
    .page-break {
        page-break-after: always;
    }
    table{
        text-align:left;
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    h1,h3{
        color:#6b6b6b;
    }
    td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    }

    tr:nth-child(even) {
    background-color: #dddddd;
    }

    .text-bold{
        font-weight:bold;
    }

    .name{
        display:inline;
        border-top:2px solid black;
        margin-top:30px;
        padding-top:10px;
    }
    .right{
        float:right;
    }
    .left{
        float:left;
    }
    .text-success{
        color:green;
    }
    .text-danger{
        color:red;
    }
    .display-relative{
        position:relative;
        height:50px;
    }
    .display-absolute{
        position:absolute;
        
    }
    
    </style>
</head>
<body>
    <h1>ITEM REQUESTS</h1>
    <h3>Transaction ID: {{$id}}</h3>
    <div class="display-relative">
        <div class="display-absolute">
            <h5>Transaction Created At: {{date('M-j-Y',strtotime($created_at)).' | '. date('g:i a',strtotime($created_at))}}</h5>
        </div>
        <div class="display-absolute" style="right:0%">
             <h5>Date Approved: {{date('M-j-Y',strtotime($date_approved)).' | '. date('g:i a',strtotime($date_approved))}}</h5>
        </div>
    </div>
    <table style="width:100%">
    <tr>
        <th class="text-bold">Item ID</th>
        <th class="text-bold">Item Description</th>
        <th class="text-bold">Item Quantity</th>
        <th class="text-bolf">Item Status</th>
    </tr>
    @foreach($requests as $request)
    <tr>
        <td>{{$request->item->item_id}}</td>
        <td>{{$request->item->item_name}}</td>
        <td>{{$request->request_qty .' '. $request->item->item_unit}}</td>
        @if($request->status=='Approve')
        <td class="text-success">{{$request->status}}</td>
        @else
        <td class="text-danger">{{$request->status}}</td>
        @endif
    </tr>
    @endforeach
    </table>
    @if($remarks != null)
    <div class="remarks">
        <h3 style="margin:5px 0px; color:black;">Remarks</h3>
        <p style="margin:0px;">{{$remarks}}</p>
    </div>
    @endif
    <br>
    <div class="flex">
        <div class="name left">
            <span>{{$username}}</span>
        </div>
        <div class="name right">
            <span>Sr. Jun Santuyo</span>
        </div>
    </div>
</body>
</html>

