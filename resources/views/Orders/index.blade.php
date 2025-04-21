@extends('shopify-app::layouts.default')

@php
    $shop = auth()->user();
    $orders = $shop->api()->rest('GET', '/admin/api/2025-01/orders.json');
    $orders = $orders['body']['container']['orders'];

    // dd($orders);
@endphp

@section('content')
    <div class="card bg-dark text-light">
        <div class="card-body">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-md-12 text-center">
                        <h2 class="display-4 fw-bold"> Orders List Of {{ Auth::user()->name }} </h2>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="card bg-dark text-light">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 bg-dark text-light">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-dark" id="orders">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="select_all">
                                                    </div>
                                                </th>
                                                <th scope="col">Order</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Customer Name</th>
                                                <th scope="col">Customer Email</th>
                                                <th scope="col">Customer Phone</th>
                                                <th scope="col">Shipping Address 1</th>
                                                <th scope="col">Shipping Address 2</th>
                                                <th scope="col">Shipping Phone</th>
                                                <th scope="col">Shipping Country</th>
                                                <th scope="col">Shipping City</th>
                                                <th scope="col">Shipping Province</th>
                                                <th scope="col">Shipping Country Code</th>
                                                <th scope="col">Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                @php
                                                    $datetime = \Carbon\Carbon::parse($order['created_at']);

                                                    $date = $datetime->format('Y-m-d');
                                                    $time = $datetime->format('g:i A');
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input each_select" type="checkbox"
                                                                value="{{ $order['id'] }}">
                                                        </div>
                                                    </td>
                                                    <th scope="row">{{ $order['name'] }}</th>
                                                    <td> {{ $date }} - {{ $time }} </td>
                                                    <td>
                                                        {{ $order['customer']['first_name'] ?? '-' }}
                                                        {{ $order['customer']['last_name'] ?? '' }}
                                                    </td>
                                                    <td>{{ $order['customer']['email'] ?? '-' }}</td>
                                                    <td>{{ $order['customer']['phone'] ?? '-' }}</td>

                                                    <td> {{ $order['shipping_address']['address1'] ?? '-' }} </td>
                                                    <td> {{ $order['shipping_address']['address2'] ?? '-' }} </td>
                                                    <td> {{ $order['shipping_address']['phone'] ?? '-' }} </td>
                                                    <td> {{ $order['shipping_address']['country'] ?? '-' }} </td>
                                                    <td> {{ $order['shipping_address']['city'] ?? '-' }} </td>
                                                    <td> {{ $order['shipping_address']['province'] ?? '-' }} </td>
                                                    <td> {{ $order['shipping_address']['country_code'] ?? '-' }} </td>

                                                    <td>
                                                        {{ $order['current_total_price_set']['shop_money']['amount'] ?? '-' }}
                                                        -
                                                        {{ $order['current_total_price_set']['shop_money']['currency_code'] ?? '-' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent

    <script>
        actions.TitleBar.create(app, {
            title: 'Welcome'
        });
    </script>
@endsection
