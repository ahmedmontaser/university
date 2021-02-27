@extends("layout")

@section("content")
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img class="img-fluid" alt="{{ $student->name }}" src="{{ asset("images/students/" . $student->image) }}" class="container-fluid">
                        </div>
                        <div class="col-md-8">
                            <p>
                                <strong>Name: </strong> {{ $student->name }}
                            </p>

                            <p>
                                <strong>Email: </strong> {{ $student->email }}
                            </p>

                            <p>
                                <strong>Phone: </strong> {{ $student->phone }}
                            </p>

                            <p>
                                <strong>Faculty: </strong> {{ $student->faculty->faculty }}
                            </p>

                            <p>
                                <strong>Department: </strong> {{ $student->department->department }}
                            </p>

                            <p>
                                <strong>Level: </strong> {{ $student->level }}
                            </p>

                            <a class="btn btn-primary" href="{{ route("students.edit", $student->id) }}">Edit</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
