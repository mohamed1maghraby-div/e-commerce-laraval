@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Order {{ $order->ref_id }}</h6>
            <div class="ml-auto">
                <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-row align-items-center">
                        <label class="sr-only" for="inlineFormInputGroupUsername">Order Status</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Order Status</div>
                            </div>
                            <select class="form-control" name="order_status" style="outline-style: none;" onchange="this.form.submit()">
                                <option value="">Choose Your action</option>
                                @foreach ($order_status_array as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="d-flex">
            <div class="col-8">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Ref. Id</th>
                            <th>{{ $order->ref_id }}</th>
                            <th>Customer</th>
                            <th><a href="{{ route('admin.customers.show', $order->user_id) }}">{{ $order->user->full_name }}</a></th>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <th><a href="{{ route('admin.customer_addresses.show', $order->user_address_id) }}">{{ $order->user_address->address_title }}</a></th>
                            <th>Shipping Company</th>
                            <th>{{ $order->shipping_company->name . '('. $order->shipping_company->code . ')' }}</th>
                        </tr>
                        <tr>
                            <th>Created date</th>
                            <th>{{ $order->created_at->format('d-m-Y h:i a') }}</th>
                            <th>Order Status</th>
                            <th>{!! $order->statusWithLable() !!}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Subtotal</th>
                                <th>{{ $order->currency . $order->subtotal }}</th>
                            </tr>
                            <tr>
                                <th>Discount code</th>
                                <th>{{ $order->discount_code }}</th>
                            </tr>
                            <tr>
                                <th>Discount</th>
                                <th>{{ $order->currency . $order->discount }}</th>
                            </tr>
                            <tr>
                                <th>Shipping</th>
                                <th>{{ $order->currency . $order->shipping }}</th>
                            </tr>
                            <tr>
                                <th>Tax</th>
                                <th>{{ $order->currency . $order->tax }}</th>
                            </tr>
                            <tr>
                                <th>Amount</th>
                                <th>{{ $order->currency . $order->total }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transactions</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Transaction</th>
                        <th>Payment method</th>
                        <th>Transaction number</th>
                        <th>Payment result</th>
                        <th>Action date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($order->transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->status() }}</td>
                            <td>{{ $transaction->transaction == 0 ? $order->payment_method->name : null }}</td>
                            <td>{{ $transaction->transaction_number }}</td>
                            <td>{{ $transaction->payment_result }}</td>
                            <td>{{ $transaction->created_at->format('Y-m-d h:i a') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No transactions found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Details</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($order->products as $product)
                        <tr>
                            <td> <a href="{{ route('admin.products.show', $product->id) }}">{{ $product->name }}</a> </td>
                            <td>{{ $product->pivot->quantity }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">No products found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection