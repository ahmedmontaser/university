@extends("layout")

@section("content")
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route("students.create") }}" class="btn btn-success">Add New Student</a>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            @admin
                            <th>Faculty</th>
                            @endadmin
                            <th>Department</th>
                            <th>Level</th>
                            <th>Manage</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach( $students as $student )
                            <tr>
                                <td><img class="img-fluid avatar-md rounded" alt="{{ $student->name }}" src="{{ asset("images/students/" . $student->image) }}"></td>
                                <td><a style="color: inherit" href="{{ route("students.show", $student->id) }}">{{ $student->name }}</a></td>
                                <td>{{ $student->email  }}</td>
                                <td>{{ $student->phone  }}</td>
                                @admin
                                <td>{{ $student->faculty->faculty }}</td>
                                @endadmin
                                <td>{{ $student->department->department }}</td>
                                <td>{{ $student->level }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route("students.edit", $student->id ) }}">Edit</a>
                                    <form method="post" action="{{ route("students.destroy", $student->id) }}" style="display: inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script src="{{ asset("assets/js/pages/datatables.init.js") }}"></script>
@endsection
