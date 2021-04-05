<x-admin-master>

@section('content')
<h1>User Profile for : {{$user->name}}</h1>

<div class="row">

    <div class="col-sm-6">

        <form method="post" action="" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                    <img height="150px" width="175px" class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
            </div>

            <div class="form-group">
                    <input type="file">
            </div>

            <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text"
                        name="username"
                        class="form-control"
                        id="username"
                        value="{{$user->username}}">

            <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text"
                            name="name"
                            class="form-control"
                            id="name"
                            value="{{$user->name}}">

                <div class="form-group">
                        <label for="email">email</label>
                        <input type="text"
                        name="email"
                        class="form-control"
                        id="email"
                        value="{{$user->email}}">
                </div>
                <div class="form-group">
                        <label for="password">password</label>
                        <input type="password"
                        name="password"
                        class="form-control"
                        id="password">

                </div>
                <div class="form-group">
                        <label for="password-confirm">Confirm Password</label>
                        <input type="password"
                        name="password_confirmation"
                        class="form-control"
                        id="password-confirmation">

                </div>

            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>


</div>

@endsection
</x-admin-master>
