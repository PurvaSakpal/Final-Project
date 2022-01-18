@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.deletecoupon').click(function(e){
            var cid=$(this).attr('cid');
            if(confirm("Delete Coupon?")){
                $.ajax({
                    url:"{{url('/coupons/deletecoupon')}}",
                    method:'post',
                    data:{_token:'{{ csrf_token()}}',cid:cid},
                    success:function(response){
                        alert(response)
                        window.location.href="/coupons/showcoupons";
                    },
                    error: function (xhr) { console.log(xhr.responseText); }
                })
            }
        })
    })
</script>
<div class="container">
    <a href="/coupons/addcoupon" class="btn btn-warning">Add Coupon</a>
    <h1>Coupon</h1>
    @if (Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    <table class="table table-success table-striped" id="mytable">
        <thead>
          <tr>
            <th scope="col">Sr No.</th>
            <th scope="col">Coupon Code</th>
            <th scope="col">Coupon Type</th>
            <th scope="col">Coupon value</th>
            <th scope="col">Cart Value</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($coupons as $coupon)
               <tr>
                   <td>{{$loop->iteration}}</td>
                   <td>{{$coupon->code}}</td>
                   <td>{{$coupon->type}}</td>
                   <td>{{$coupon->value}}</td>
                   <td>{{$coupon->cart_value}}</td>
                   <td>
                       <a href="/coupons/editcoupon/{{$coupon->id}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                       <a href="javascript:void(0)" cid={{$coupon->id}} class="btn btn-danger deletecoupon"><i class="fa fa-trash" aria-hidden="true"></i></a>
                   </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
</div>
@endsection
