@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center" style="border-radius: 10px;">
        <div class="col-md-12" style="padding: 0 !important;">
            <chat-app :user="{{auth()->user()}}" />
        </div>
    </div>
</div>
@endsection
