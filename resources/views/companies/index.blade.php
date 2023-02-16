@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ 'Companies List' }}
                <a href="{{ route('companies.create')}}" class="btn btn-primary btn-md ms-2">Add Company</a>
                </div>
                    
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Sl.No</th>
                            <th scope="col">Comapny Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Website</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @if ((sizeof($results) >0))
                                @foreach ($results as $item)
                                    <tr>
                                        <td>{{ $results->firstItem()+$loop->index }}</td>
                                        <td>{{$item->company_name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->website}}</td>
                                        <td><img src="{{asset('storage/'.$item->compay_logo)}}" style="width:80px;height:80px;" alt=""></td>
                                        <td>
                                            <a href="{{route('companies.edit',encrypt($item->id))}}" class="btn btn-primary">Edit</a>
                                        </td>
                                    </tr> 
                                @endforeach
                            @endif
                          
                        </tbody>
                      </table>
                      <div>
                        {{$results->links()}}
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
