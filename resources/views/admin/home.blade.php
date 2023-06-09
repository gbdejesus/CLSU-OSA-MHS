@extends('layouts.admin')
@section('style')
    @parent
@endsection
@section('content')
    <script type="application/javascript">
        var clientsCount =  {!! json_encode($data['clients']) !!};
        var counselorsCount =  {!! json_encode($data['counselors']) !!};
    </script>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="content" id="admin" style="padding: 40px;">
                            <dashboard></dashboard>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection

