<x-admin-master>
    @section('content')
        {{--  Updated Message  --}}
        @if (session()->has('permission-updated'))
            <div class="alert alert-success">
                {{ session('permission-updated') }}
            </div>
        @endif
        <div class="row">
            <div class="col-sm-3">
                <h3>Edit permission: {{ $permission->name }}</h3>
                    <form method="post" action="{{ route('permissions.update', $permission->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $permission->name }}">
                        </div>
                        <button class="btn btn-primary">Update</button>
                    </form>
            </div>
        </div>
        {{--  Permission Table  --}}
        <div class="row">
            <div class="col-lg-12">
                @if ($roles->isNotEmpty())
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="rolesTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Options</th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Attach</th>
                                <th>Detach</th>
                                </tr>
                            </thead>
                                <tfoot>
                                    <tr>
                                    <th>Options</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                    </tr>
                                </tfoot>
                            <tbody>
                                @foreach ($roles as $role)


                                <tr>
                                    <td><input type="checkbox"
                                        @foreach ($permission->roles as $permission_role)
                                    @if($permission_role->slug == $role->slug)
                                        checked
                                    @endif
                            @endforeach
                                        ></td>

                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->slug}}</td>
                                    <td><form method="post" action="{{route('permission.role.attach', $permission)}}">
                                        @method('PUT')
                                        @csrf

                                        <input type="hidden" name="role" value="{{$role->id}}">

                                        <button class="btn btn-primary"
                                            @if ($permission->roles->contains($role))
                                            disabled
                                            @endif
                                            >Attach
                                        </button>

                                    </form>
                                </td>
                                <td><form method="post" action="{{route('permission.role.detach', $permission)}}">
                                    @method('PUT')
                                    @csrf

                                    <input type="hidden" name="role" value="{{$role->id}}">

                                    <button class="btn btn-danger"
                                        @if (!$permission->roles->contains($role))
                                        disabled
                                        @endif
                                        >Detach
                                    </button>

                                </form>
                            </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                @endif
                </div>
            </div>
        </div>

    @endsection
</x-admin-master>
