@extends('layouts.main')

<style>
  .contents-main{
    text-align:center;
  }


</style>

@section('header')
@endsection

<main>
  <div class="contents-main">@section('contents')
    <div class="registration-title">
      <p>会員登録</p>
      <form action="/" method="get">
        <div class="registration-rayouts">
          <input type="text">
        </div>
        <div class="registration-rayouts">
          <input type="email">
        </div>
        <div class="registration-rayouts">
          <input type="password">
        </div>
        <div class="registration-rayouts">
          <input type="password">
        </div>
        <div class="registration-button">
          <input type="submit" value="会員登録">
        </div>
      </form>
      <p>アカウントをお持ちの方はこちらから</p>
      <a href="#">ログイン</a>
    </div>
  </div>
</main>
  @endsection

@section('footer')
@endsection