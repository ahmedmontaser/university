@extends("layout")

@section("content")
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route("profile.update", $student->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <!-- Name -->
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name: </label>
                            <div class="col-sm-10">
                                <input class="form-control @error("name") is-invalid @enderror"
                                       type="text" id="name" name="name"
                                       value="{{ old("name", $student->name) }}">
                                @error("name")
                                <span class="error">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password: </label>
                            <div class="col-sm-10">
                                <input class="form-control @error("password") is-invalid @enderror"
                                       type="password" id="password" name="password">
                                @error("password")
                                <span class="error">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cpassword" class="col-sm-2 col-form-label">Confirm Password: </label>
                            <div class="col-sm-10">
                                <input class="form-control @error("cpassword") is-invalid @enderror"
                                       type="password" id="cpassword" name="cpassword">
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email: </label>
                            <div class="col-sm-10">
                                <input class="form-control @error("email") is-invalid @enderror"
                                       type="text" id="email" name="email" value="{{ old("email", $student->email) }}">
                                @error("email")
                                <span class="error">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">Phone: </label>
                            <div class="col-sm-10">
                                <input class="form-control @error("phone") is-invalid @enderror"
                                       type="text" id="phone" name="phone" value="{{ old("phone", $student->phone) }}">
                                @error("phone")
                                <span class="error">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Department -->
                        <div class="form-group row">
                            <label for="department" class="col-sm-2 col-form-label">Department: </label>
                            <div class="col-sm-10">
                                <select class="form-control" id="department" name="department">
                                    @foreach( $departments as $department )
                                        <option value="{{ $department->id }}"
                                                @if( $department->id == old("department" , $student->department_id) )
                                                selected
                                                @endif>
                                            {{ $department->department }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Level -->
                        <div class="form-group row">
                            <label for="level" class="col-sm-2 col-form-label">Level: </label>
                            <div class="col-sm-10">
                                <input class="form-control @error("level") is-invalid @enderror"
                                       type="text" id="level" name="level" value="{{ old("level" , $student->level) }}">
                                @error("level")
                                <span class="error">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="filestyle @error("level") is-invalid @enderror"
                                       id="image" name="image" data-buttonname="btn-secondary">
                                @error("level")
                                <span class="error">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <input type="submit" class="btn btn-outline-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script src="{{ asset("assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js") }}"></script>
@endsection
