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
    </style>
</head>
<body>
    <h1>ITEM REQUESTS</h1>
    <h3>Transaction ID: {{$id}}</h3>
    <table style="width:100%">
    <tr>
        <th class="text-bold">Item ID</th>
        <th class="text-bold">Item Name</th>
        <th class="text-bold">Item Quantity</th>
    </tr>
    @foreach($requests as $request)
    <tr>
        <td>{{$request->item->item_id}}</td>
        <td>{{$request->item->item_name}}</td>
        <td>{{$request->request_qty .' '. $request->item->item_unit}}</td>
    </tr>
    @endforeach
    </table>
    <br>
    <br>
    <div class="flex">
        <div class="name left">
            <span>Patrick Neil E. Noceja</span>
        </div>
        <div class="name right">
            <span>Sr. Jun Santuyo</span>
        </div>
    </div>
</body>
</html>
