@extends('layout.admin')

@section('title')
    <title>Order</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.contentHeader',['name'=>'Order','key'=>'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-12">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Order Code</th>
                                <th scope="col">Phone number</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order as $i)
                                <tr>
                                    <td>{{$i->code_order}}</td>
                                    <td>{{ $i->phone_number }}</td>
                                    <td><span
                                            class="
                                        @if($i->status=='success')
                                        text-success
                                        @elseif($i->status=='on the way')
                                        text-primary
                                        @elseif($i->status=='preparing')
                                        text-primary
                                        @else
                                        text-warning
                                         @endif
                                     ">{{ $i->status }}</span></td>
                                    <td>
                                        <a href="{{route('order.view',['id'=>$i->id])}}" class="btn btn-primary">View</a>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>

                    </div>
                    <div class=" col-lg-12">
                        {{$order->links()}}
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection



