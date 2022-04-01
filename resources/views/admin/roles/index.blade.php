@component('components.admin-master')

@section('content')

<h1>roles</h1>

<div class="row">
    <div class="col-sm-6">
        <form action="{{route('users.roles.store')}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <input type="text" name="name" id="name" placeholder="name or slug">
                @error('name')
                <span><strong>{{$message}}</strong></span>
                @enderror
            </div>
            <button class="btn btn-primary" type="submit">Create</button>

        </form>
    </div>
    <div class="col-cm-6">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <td>Slug</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>

           </thead>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <td>Slug</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
                </tfoot>
                <tbody>

                @foreach($roles as $role)

                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                    <td>{{$role->slug}}</td>
                    <td>
                        <form action="{{route('users.roles.edit' , $role->id)}}" method="post">
                            @csrf
                            <button class="btn btn-success">Edit</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{route('users.roles.destroy' , $role->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>

                </tr>
                    @endforeach


                </tbody>
            </table>
    </div>
</div>
</div>

@endsection

@endcomponent
