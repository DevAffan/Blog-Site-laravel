<x-admin-master>


    @section('content')

        <h1>User Profile for : {{$user->name}}</h1>


       <div class="row">

               <div class="col-sm-6">

                       <form method="post" action="{{route('user.profile.update', $user->id)}}" enctype="multipart/form-data">
                        @method('PUT')
                               @csrf

                               <div class="mb-4">
                                       <img height="100px" width="100px" class="img-profile rounded-circle" src="{{$user->avatar}}">
                               </div>

                               <div class="form-group">
                                       <input type="file" name="avatar" id="avatar">
                               </div>


                               <div class="form-group">
                                       <label for="username">Username</label>
                                       <input type="text"
                                              name="user_name"
                                              class="form-control @error('user_name') is-invalid @enderror"


                                              id="user_name"
                                              value="{{$user->user_name}}"

                                       >
                                       @error('user_name')
                                       <div class="invalid-feedback">{{$message}}</div>
                                       @enderror
                               </div>



                               <div class="form-group">
                                       <label for="name">Name</label>
                                       <input type="text"
                                              name="name"
                                              class="form-control @error('name') is-invalid @enderror"


                                              id="name"
                                              value="{{$user->name}}"

                                       >

                                       @error('name')
                                       <div class="alert alert-danger">{{$message}}</div>
                                       @enderror
                               </div>


                               <div class="form-group">
                                       <label for="email">Email</label>
                                       <input type="text"
                                              name="email"
                                              class="form-control @error('email') is-invalid @enderror"
                                              id="email"
                                              value="{{$user->email}}"

                                       >

                                       @error('email')
                                       <div class="alert alert-danger">{{$message}}</div>
                                       @enderror
                               </div>

                               <div class="form-group">
                                       <label for="password">Password</label>
                                       <input type="password"
                                              name="password"
                                              class="form-control @error('password') is-invalid @enderror"
                                              id="password"
                                       >

                                       @error('password')
                                       <div class="alert alert-danger">{{$message}}</div>
                                       @enderror
                               </div>


                               <div class="form-group">
                                       <label for="password-confirmation">Confirm Password</label>
                                       <input type="password"
                                              name="password_confirmation"
                                              class="form-control @error('password_confirmation') is-invalid @enderror"
                                              id="password-confirmation"


                                       >

                                       @error('password_confirmation')
                                       <div class="alert alert-danger">{{$message}}</div>
                                       @enderror
                               </div>



                               <button type="submit" class="btn btn-primary">Submit</button>
                       </form>

               </div>

       </div>

       <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Option</th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <td>Attach</td>
                        <td>Detach</td>
                    </tr>

               </thead>
                    <tfoot>
                    <tr>
                        <th>Option</th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <td>Attach</td>
                        <td>Detach</td>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach($roles as $role)

                    <tr>
                        <td><input type="checkbox" name="option" id=""

                            @foreach ($user->roles as $user_role )

                                @if ($user_role->slug == $role->slug)
                                    checked
                                @endif

                            @endforeach
                            ></td>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td>{{$role->slug}}</td>
                        <td>
                            <form action="{{route('user.role.attach' , $user)}}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="role" value="{{$role->id}}">
                                <button class="btn btn-primary"
                                @if ($user->roles->contains($role))
                                disabled
                                @endif
                                >Attach</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{route('user.role.detach' , $user)}}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="role" value="{{$role->id}}">

                                <button class="btn btn-danger"
                                    @if (!$user->roles->contains($role))
                                        disabled
                                    @endif
                                >Detach</button>

                            </form>
                        </td>
                    </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
       </div>
    @endsection
</x-admin-master>
