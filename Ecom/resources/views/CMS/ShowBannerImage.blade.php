@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
 $(document).ready(function(){
        $('.deletebannerimg').click(function(e){
            var bid=$(this).attr('bid');
            if(confirm("Delete Banner Image?")){
                $.ajax({
                    url:"{{url('/cms/deletebannerimage')}}",
                    method:'post',
                    data:{_token:'{{ csrf_token()}}',bid:bid},
                    success:function(response){
                        alert(response)
                        window.location.href="/cms/showbannerimage";
                    },
                    error: function (xhr) { console.log(xhr.responseText); }
                })
            }
        })
    })
</script>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Banner Image') }}
            <a href="/cms/addbannerimage" class="btn btn-warning float-right">Add Banner Image</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Image</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if(!empty($banner) && $banner->count())
                            <tr>
                            <td>
                                <img src="{{asset('/CMSImage/'.$banner[0]->image)}}" alt="Banner Image" width="800px" height="150px">
                                </td>
                                <td>
                                <a href="javascript:void(0)" bid="{{$banner[0]->id}}" class="btn btn-danger deletebannerimg"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                            </tr>
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
