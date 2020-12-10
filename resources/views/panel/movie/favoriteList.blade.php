@extends("$routeAmbient.template.index")

@section("content")
    <div class="container-fluid p-0">
        @includeIf("$routeAmbient.$routeCrud.$routeMethod.list")
    </div>
@endsection
