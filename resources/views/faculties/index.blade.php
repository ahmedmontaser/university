@extends("layout")

@section("content")
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route("faculties.create") }}" class="btn btn-success">Add New Faculty</a>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Manage</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach( $faculties as $faculty )
                            <tr>
                                <td><a style="color: inherit" href="{{ route("faculties.show", $faculty->id) }}">{{ $faculty->faculty }}</a></td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route("faculties.edit", $faculty->id ) }}">Edit</a>
                                    <form method="post" action="{{ route("faculties.destroy", $faculty->id) }}" style="display: inline">
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
