<div class="header-img-container" style="position:relative;">
  <img src="{{ asset('img/material/header.jpg') }}" class="w-100 header-img">
  <form method="POST" action="{{ route('logout') }}" class="header-logout-form">
    @csrf
    <button type="submit" class="header-logout-btn" title="ログアウト">
      <i class="bi bi-box-arrow-right"></i>
    </button>
  </form>
</div>