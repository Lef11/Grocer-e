<x-admin-master>
@section('content')

@if (session()->has('role-updated'))
    <div class="alert alert-success">
        {{session('role-updated')}}
    </div>
@endif

<div class="col-sm-6">
    <h1>Edit Role: {{$role->name}}</h1>

    <form method="post" action="{{route('roles.update', $role->id)}}">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{$role->name}}">
    </div>
    <button class="btn btn-primary">Update</button>
</form>
</div>
@endsection
</x-admin-master>
