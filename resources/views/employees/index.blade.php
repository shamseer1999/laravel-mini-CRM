@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ 'Employees List' }}
                <a href="{{ route('employees.create')}}" class="btn btn-primary ms-2">Add Employee</a>
                </div>
                
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Sl.No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Company</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @if ((sizeof($results) >0))
                                @foreach ($results as $item)
                                    <tr>
                                        <td>{{ $results->firstItem()+$loop->index }}</td>
                                        <td>{{$item->first_name.' '.$item->last_name}}</td>
                                        <td>{{$item->companies->company_name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->phone}}</td>
                                        
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
