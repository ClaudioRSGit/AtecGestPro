@extends('master.main')

@section('content')
<style>
    .content {
        display: flex !important;
        justify-content: top !important;
        align-items: center !important;
        height: 50vh !important;
        flex-direction: column !important;
    }
</style>

<div class="content">

    <br>
    <div>
        <hr>
        <div>
            <img src="{{ asset('assets/atecLogo.png') }}" alt="">
        </div>
        <hr>
    </div>
</div>
@endsection
