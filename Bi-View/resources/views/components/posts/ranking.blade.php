@props(['rankingByCategory'])

<div class="ranking-sidebar">
  <!-- おすすめ美唄ボタン -->
  <img src="{{ asset('img/material/yakitorio.png') }}" alt="おすすめ美唄" class="ranking-title-img sidebar-btn mb-2" data-bs-toggle="modal" data-bs-target="#bibaiInfoModal" role="button">

  <img src="{{ asset('img/material/rank.png') }}" alt="ランキング" class="ranking-title-img">

  @foreach($rankingByCategory as $item)
  <div class="ranking-category-block">
    <div class="ranking-category-name">
      {{ $item['category']->type === 'pro' ? '🔥' : '🐤' }} {{ $item['category']->name }}
    </div>

    @foreach($item['posts'] as $index => $post)
    <div class="ranking-item ranking-item-{{ $index + 1 }}"
      data-bs-toggle="modal"
      data-bs-target="#rankingPostModal"
      data-image="{{ $post->image_path ? asset('storage/' . $post->image_path) : '' }}"
      data-content="{{ $post->content }}"
      data-user="{{ $post->user->nickname ?? $post->user->name ?? '不明' }}"
      data-category="{{ ($post->category->type === 'pro' ? '🔥' : '🐤') . ' ' . $post->category->name }}"
      data-likes="{{ $post->likes_count }}">
      <span class="ranking-number ranking-number-{{ $index + 1 }}">
        {{ $index + 1 }}
      </span>
      @if($post->image_path)
      <img src="{{ asset('storage/' . $post->image_path) }}" alt="ランキング画像" class="ranking-thumb">
      @else
      <div class="ranking-thumb ranking-thumb-empty"></div>
      @endif
    </div>
    @endforeach
  </div>
  @endforeach
</div>

<!-- ランキング詳細モーダル -->
<div class="modal fade" id="rankingPostModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0 pb-0">
        <div>
          <div class="fw-bold" id="rankingModalCategory"></div>
          <div class="text-muted small" id="rankingModalUser"></div>
          <p id="rankingModalContent" class="fw-bold mb-0 mt-1" style="font-size:0.95rem;"></p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body pt-2">
        <img id="rankingModalImage" src="" alt="投稿画像" class="w-100 rounded mb-2" style="object-fit:contain; max-height:400px;">
        <div class="d-flex align-items-center gap-1">
          <img src="{{ asset('img/material/good-mami.png') }}" alt="いいね" style="width:28px;height:28px;object-fit:contain;">
          <span id="rankingModalLikes" class="fw-bold"></span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- おすすめ美唄モーダル -->
<div class="modal fade" id="bibaiInfoModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">🍗 美唄の魅力</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-3">
        <div class="row g-2">
          <div class="col-6">
            <a href="https://www.artepiazza.jp/"><img src="{{ asset('img/banners/artmuseums.png') }}" alt="美術館" class="bibai-banner-img"></a>
          </div>
          <div class="col-6">
            <a href="http://www.net-bibai.co.jp/furusato_oendan/"><img src="{{ asset('img/banners/cheering-squad.png') }}" alt="応援団" class="bibai-banner-img"></a>
          </div>
          <div class="col-6">
            <a href="https://www.city.bibai.hokkaido.jp/soshiki/13/417.html"><img src="{{ asset('img/banners/data-center.png') }}" alt="データセンター" class="bibai-banner-img"></a>
          </div>
          <div class="col-6">
            <a href="https://www.city.bibai.hokkaido.jp/soshiki/13/7556.html"><img src="{{ asset('img/banners/enterprises.png') }}" alt="企業誘致" class="bibai-banner-img"></a>
          </div>
          <div class="col-6">
            <a href="https://www.city.bibai.hokkaido.jp/soshiki/3/13934.html"><img src="{{ asset('img/banners/hometown-tax-payment.png') }}" alt="ふるさと納税" class="bibai-banner-img"></a>
          </div>
          <div class="col-6">
            <a href="https://cdn.discordapp.com/attachments/1474902022909071463/1475306569087324202/bnr_miyajimanuma.png?ex=699d01cf&is=699bb04f&hm=f7e29ff4141073916c9feac212bfdf07a6a49cada1372802b93635f96f52a20e&"><img src="{{ asset('img/banners/miyazimanuma.png') }}" alt="宮島沼" class="bibai-banner-img"></a>
          </div>
          <div class="col-6">
            <a href="https://www.city.bibai.hokkaido.jp/site/ijuu/"><img src="{{ asset('img/banners/move.png') }}" alt="移住" class="bibai-banner-img"></a>
          </div>
          <div class="col-6">
            <a href="https://www.city.bibai.hokkaido.jp/soshiki/3/13934.html"><img src="{{ asset('img/banners/song-town.png') }}" alt="うたのまち" class="bibai-banner-img"></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  document.querySelectorAll('.ranking-item').forEach(function(item) {
    item.addEventListener('click', function() {
      document.getElementById('rankingModalImage').src = item.dataset.image;
      document.getElementById('rankingModalContent').textContent = item.dataset.content;
      document.getElementById('rankingModalUser').textContent = item.dataset.user;
      document.getElementById('rankingModalCategory').textContent = item.dataset.category;
      document.getElementById('rankingModalLikes').textContent = item.dataset.likes;
    });
  });
</script>
@endpush