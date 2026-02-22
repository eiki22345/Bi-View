@props(['rankingByCategory'])

<div class="ranking-sidebar">
  <div class="ranking-title">ランキング</div>

  @foreach($rankingByCategory as $item)
  <div class="ranking-category-block">
    <div class="ranking-category-name">
      {{ $item['category']->type === 'pro' ? '🔥' : '🐤' }} {{ $item['category']->name }}
    </div>

    @foreach($item['posts'] as $index => $post)
    <div class="ranking-item"
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