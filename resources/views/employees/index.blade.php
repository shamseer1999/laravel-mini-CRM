@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ 'Employees List' }}
                <a href="{{ route('employees.create')}}" class="btn btn-primary ms-2">Add Employee</a>
                </div>
                @if (session()->has('success'))
                    <br>
                    <div class="container">
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    </div> 
                @endif
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
                                        <td>
                                            <a href="{{route('employees.edit',encrypt($item->id))}}" class="btn btn-primary">Edit</a>
                                            <form action="{{route('employees.destroy',encrypt($item->id))}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="_method" value="delete">
                                                <br><button type="submit" onclick="return confirm('Are you sure you want to delete')" class="btn btn-primary">Delete</button>
                                            </form>
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
