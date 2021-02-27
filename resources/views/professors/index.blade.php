@extends("layout")

@section("content")
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route("professors.create") }}" class="btn btn-success">Add New professor</a>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Faculty</th>
                            <th>Manage</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach( $professors as $professor )
                            <tr>
                                <td><a style="color: inherit" href="{{ route("professors.show", $professor->id) }}">{{ $professor->name }}</a></td>
                                <td>{{ $professor->email  }}</td>
                                <td>{{ $professor->faculty->faculty }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route("professors.edit", $professor->id ) }}">Edit</a>
                                    <form method="post" action="{{ route("professors.destroy", $professor->id) }}" style="display: inline">
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
