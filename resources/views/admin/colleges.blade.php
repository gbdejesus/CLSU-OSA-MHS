@extends('layouts.admin')
@section('style')
    @parent
{{--
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('backend/css/demo.css') }}" rel="stylesheet" />--}}
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="content" id="admin" style="padding: 40px;">
                            <colleges></colleges>
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

