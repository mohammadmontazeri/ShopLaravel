@extends('layouts.admin')

@section('content')
    <div class="container">
        <div style="width: auto;margin-right: 20px;padding: 5px;background-color: #ddd;border: solid 1.5px #aaa;border-radius: 2px;">
            {!! $video->detail !!}
        </div>
    </div>

@endsection