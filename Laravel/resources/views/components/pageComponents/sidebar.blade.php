@extends('master.main')

@section('sidebar')
    @parent
    <div class="sidebar">
        <div class="sidebar__logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
        </div>
        <div class="sidebar__menu">
            <ul>
                <li>
                    <a href="#">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-info-circle"></i>
                        <span>Ticket</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-envelope"></i>
                        <span>Turmas</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

@endsection
