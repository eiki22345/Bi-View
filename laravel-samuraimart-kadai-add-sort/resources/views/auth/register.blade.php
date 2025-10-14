@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h3 class="mt-3 mb-3">新規会員登録</h3>

            <hr>

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="form-group row">

                    <label for="name" class="col-md-5 col-form-label text-md-left">氏名<span class="ml-1 samuraimart-require-input-label"><span class="samuraimart-require-input-label-text">必須</span></span></label>

                    <div class="col-md-7">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror samuraimart-login-input" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="侍 太郎">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>氏名を入力してください</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-5 col-form-label text-md-left">メールアドレス<span class="ml-1 samuraimart-require-input-label"><span class="samuraimart-require-input-label-text">必須</span></span></label>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>メールアドレスを入力してください</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="postal_code" class="col-md-5 col-form-label text-md-left">郵便番号<span class="ml-1 samuraimart-require-input-label"><span class="samuraimart-require-input-label-text">必須</span></span></label>

                    <div class="col-md-7">
                        <input type="text" class="form-control @error('postal_code') is-invalid @enderror samuraimart-ligin-input" name="postal_code" required placeholder="東京都渋谷区道玄坂２丁目１１ー１">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-md-5 col-form-label text-md-left">住所<span class="ml-1 samuraimart-require-input-label"><span class="samuraimart-require-input-label-text">必須</span></span></label>

                    <div class="col-md-7">
                        <input type="text" class="form-control @error('address') is-invalid @enderror samuraimart-login-input" name="address" required placeholder="東京都渋谷区道玄坂２丁目１１−１">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-md-5 col-form-label text-md-left">電話番号<span class="ml-1 samuraimart-require-input-label"><span class="samuraimart-require-input-label-text">必須</span></span></label>

                    <div class="col-md-7">
                        <input type="text" class="form-control @error('phone') is-invalid @enderror samuraimart-login-input" name="phone" required placeholder="03-5790-9039">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-5 col-form-label text-md-left">パスワード<span class="ml-1 samuraimart-require-input-label"><span class="samuraimart-require-input-label-text">必須</span></span></label>

                    <div class="col-md-7">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror samuraimart-login-input" name="password" required placeholder="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-5 col-form-label text-md-left"></label>

                    <div class="col-md-7">
                        <input id="password-confirm" type="password" class="form-control  samuraimart-login-input" name="password_confirmation" required placeholder="new-password">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn samuraimart-submit-button w-100">
                            アカウント作成
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection