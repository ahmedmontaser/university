@extends("layout")

@section("content")
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <p>
                        <strong>Name: </strong> {{ $faculty->faculty }}
                    </p>
                    
                    <a class="btn btn-primary" href="{{ route("faculties.edit", $faculty->id) }}">Edit</a>

                </div>
            </div>
        </div>
    </div>
@endsection
