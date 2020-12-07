@extends('cms.cms_master')
@section('cms_content')
@include('utils.cms_header', ['title' => 'Orders'])

<div class="row">
    <div class="col-12 mt-4">
    <div  class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#ID</th>
                <th>User</th>
                <th>Order</th>
                <th>Total</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->name }}</td>
                <td>
                    <ul class="list-group">
                        @foreach (unserialize($order->data) as $item)
                          <li class="list-group-item border-primary">
                              <b>{{ $item['name'] }}</b><br>
                              Quantity: {{ $item['quantity'] }} <br>
                              Price: ${{ $item['price'] }} 
                         </li>
                        @endforeach
                    </ul>
                </td>
                <td>${{ $order->total }}</td>
                <td>{{ date('d/m/Y H:i:s', strtotime($order->created_at)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
     </div>
    </div>
</div>

@endsection