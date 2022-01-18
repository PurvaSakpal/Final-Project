@extends('layouts.app')

@section('content')
<div class="table-responsive">
    <table class="table">
        @foreach ($useraddress as $useradd)
        <tr>
            <th>Order Id</th>
            <td>{{$useradd->orderdetail->id}}</td>
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
                    @foreach ($useradd->userorder as $userord)

                    <tr>
                        @if ($userord->product_id == $product->id)
                        <td><img src="{{asset('/ProductImages/'.$product->images[0]->image)}}" class="card-img-top" alt="Asset_img" width=100 height=100>
                        </td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->price}}</td>
                        <td>
                            {{$userord->product_quantity}}
                        </td>
                        <td>{{$product->price * $userord->product_quantity}}</td>
                    </tr>
                            @endif

                            @endforeach
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th>Cart Subtotal</th>
                                <td>{{$useradd->orderdetail->cart_sub_total}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th>Coupon Applied</th>
                                <td>
                                    @if ($useradd->couponused->id)
                                        yes
                                    @else
                                    No
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th>Coupon value & Name</th>
                                @foreach ($coupons as $coupon)
                                @if ($useradd->couponused->coupon_id==$coupon->id)
                                <td> {{$coupon->value}}</td>
                                <td>{{$coupon->code}}</td>
                                @endif
                                @endforeach
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th>Shipping Cost</th>
                                <td>{{$useradd->orderdetail->shipping_cost}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th>Total</th>
                                <td>{{$useradd->orderdetail->total}}</td>
                            </tr>
                </table>
            </td>
        </tr>

        @endforeach

    </table>

    <a href="/order/orderdetails" class="btn btn-warning my-4">Back</a>
  </div>
@endsection
