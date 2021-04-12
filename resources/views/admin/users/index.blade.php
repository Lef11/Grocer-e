<x-admin-master>
@section('content')
@if (session('user-deleted'))
   <div class="alert alert-danger">{{session('user-deleted')}}</div>
@endif

    <h1>Users</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Users</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Username</th>
                  <th>Avatar</th>
                  <th>Name</th>
                  <th>Registered date</th>
                  <th>Updated profile date</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Username</th>
                  <th>Avatar</th>
                  <th>Name</th>
                  <th>Registered date</th>
                  <th>Updated profile date</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->username}}</td>
                        <td>
                            <img height="50px" src="{{$user->avatar}}" alt="">
                        </td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->created_at->diffForhumans()}}</td>
                        <td>{{$user->updated_at->diffForhumans()}}</td>
                        <td>
                            <form method="post" action="{{route('users.destroy', $user->id)}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>

                @endforeach
              </tbody>


@endsection

@section('scripts')


<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

 Page level custom scripts
 <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

@endsection

</x-admin-master>
