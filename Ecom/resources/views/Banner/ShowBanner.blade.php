@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
 $(document).ready(function(){
        $('.deletebanner').click(function(e){
            var bid=$(this).attr('bid');
            if(confirm("Delete Banner?")){
                $.ajax({
                    url:"{{url('/banner/deletebanner')}}",
                    method:'patch',
                    data:{_token:'{{ csrf_token()}}',bid:bid},
                    success:function(response){
                        alert(response)
                        window.location.href="/banner/showbanner";
                    },
                    error: function (xhr) { console.log(xhr.responseText); }
                })
            }
        })
    })
</script>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Banners') }}</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Sr No.</th>
                        <th scope="col">Heading</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if(!empty($banners) && $banners->count())
                            @foreach($banners as $banner)
                            <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$banner->heading}}</td>
                            <td>{{$banner->description}}</td>
                            <td><img src="{{asset('/BannerImages/'.$banner->image)}}" alt="Banner Image" width="150px" height="150px">
                                </td>
                                <td><a href="/banner/editbanner/{{$banner->id}}" class="btn btn-success">Edit</a>|
                                <a href="javascript:void(0)" bid="{{$banner->id}}" class="btn btn-danger deletebanner">Delete</a></td>
                            </tr>
                            @endforeach
                             @else
                            <tr>
                                <td colspan="5">There is no data.</td>
                            </tr>
                        @endif
                    </tbody>
                  </table>

            </div>
        </div>
    </div>
</div>
@endsection
