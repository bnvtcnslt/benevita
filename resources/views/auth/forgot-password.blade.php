@extends('layouts.auth')

@section('content')
<div class="login-container">
        <h2 class="text-center">Lupa Password<br><small>Benevita Consulting</small></h2>
        @if(session()->has('pesan'))
            <div class="alert alert-{{ session('pesan')[0] }} text-center">
                {{ session('pesan')[1] }}
            </div>
        @endif
        <form action="{{route('password.email')}}" method="POST" class="mt-4">
            @csrf
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Kirim Konfirmasi</button>
            <div class="text-center mt-3">
                <a href="{{ route('auth.index') }}">Kembali ke Login</a>
            </div>
        </form>
</div>
@endsection
