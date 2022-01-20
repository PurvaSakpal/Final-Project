@extends('layouts.app')

@section('content')
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>Order Id</th>
                <td>{{ $useraddress->orderdetail->id }}</td>
            </tr>
            <tr>
                <th>Products</th>
                <td>
                    <table>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>quantity</th>
                            <th>total</th>
                        </tr>
                        @foreach ($products as $product)
                            @foreach ($useraddress->userorder as $userord)

                                <tr>
                                    @if ($userord->product_id == $product->id)
                                        <td><img src="{{ asset('/ProductImages/' . $product->images[0]->image) }}"
                                                class="card-img-top" alt="Asset_img" width=100 height=100>
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            {{ $userord->product_quantity }}
                                        </td>
                                        <td>{{ $product->price * $userord->product_quantity }}</td>
                                </tr>
                            @endif

                        @endforeach
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th>Cart Subtotal</th>
                            <td>{{ $useraddress->orderdetail->cart_sub_total }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th>Coupon Applied</th>
                            <td>
                                @if ($useraddress->couponused)
                                    @foreach ($coupons as $coupon)
                                        @if ($useraddress->couponused->coupon_id == $coupon->id)
                            <td> {{ $coupon->value }}</td>
                            <td>{{ $coupon->code }}</td>
                            @endif
                            @endforeach
                        @else
                            Not applied
                            @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <th>Shipping Cost</th>
                <td>{{ $useraddress->orderdetail->shipping_cost }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <th>Total</th>
                <td>{{ $useraddress->orderdetail->total }}</td>
            </tr>
        </table>
        </td>
        </tr>
        </table>

        <a href="/order/orderdetails" class="btn btn-warning my-4">Back</a>
    </div>
@endsection
