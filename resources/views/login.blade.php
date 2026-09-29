@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="card" style="max-width: 380px; margin: 60px auto;">
    <h2>Login</h2>

    @error('username')
        <div class="error">{{ $message }}</div>
    @enderror

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label>Username</label>
        <input type="text" name="username" value="{{ old('username') }}" autofocus>

        <label>Password</label>
        <input type="password" name="password">

        <button type="submit" class="btn">Masuk</button>
    </form>
</div>
@endsection