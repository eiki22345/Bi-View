@extends('layouts.app')

@section('content')

<!-- 2カラムレイアウト：ヘッダー横からランキング表示 -->
<div class="container-fluid px-0">
  <div class="row g-0 two-col-layout">

    <!-- 左サイド：ランキング -->
    <div class="col-2 ranking-col">
      <x-posts.ranking :rankingByCategory="$rankingByCategory" />
    </div>

    <!-- 右：ヘッダー + テーマ画像 + 投稿一覧 -->
    <div class="col-md-8 posts-col">

      <x-headers.header />

      <!-- 今月のテーマ画像 -->
      <div class="theme-images-wrapper">
        <div class="row g-3 justify-content-center">
          <div class="col-md-6 p-0">
            <img src="{{ asset('img/categories/snowland.png') }}" alt="スノーランドの軌跡" class="theme-image theme-image-shadow">
          </div>
          <div class="col-md-6 p-0">
            <img src="{{ asset('img/categories/chiken.png') }}" alt="あつあつ！美唄焼き鳥" class="theme-image theme-image-shadow">
          </div>
        </div>
      </div>

      <div class="posts-container">

        <!-- フィルタ・ソートバー -->
        <div class="filter-bar d-flex flex-wrap justify-content-between align-items-center px-1 gap-2 mb-0">

          <!-- カテゴリフィルタ -->
          <div class="d-flex flex-wrap gap-1">
            <a href="{{ route('posts.index', ['sort' => $sort]) }}"
              class="btn btn-sm {{ is_null($categoryId) ? 'btn-dark' : 'btn-outline-dark' }}">
              すべて
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('posts.index', ['sort' => $sort, 'category_id' => $cat->id]) }}"
              class="btn btn-sm {{ $categoryId == $cat->id ? 'btn-dark' : 'btn-outline-dark' }}">
              {{ $cat->type === 'pro' ? '🔥' : '🐤' }} {{ $cat->name }}
            </a>
            @endforeach
          </div>

          <!-- ソート -->
          <div class="btn-group btn-group-sm">
            <a href="{{ route('posts.index', array_filter(['sort' => 'new', 'category_id' => $categoryId])) }}"
              class="btn {{ $sort === 'new' ? 'btn-primary' : 'btn-outline-primary' }}">
              新着
            </a>
            <a href="{{ route('posts.index', array_filter(['sort' => 'popular', 'category_id' => $categoryId])) }}"
              class="btn {{ $sort === 'popular' ? 'btn-primary' : 'btn-outline-primary' }}">
              人気
            </a>
          </div>

        </div>

        <!-- 投稿一覧 -->
        @forelse($posts as $post)
        <div class="card post-card mb-3">
          <div class="card-body">
            <div class="post-header d-flex justify-content-between">
              <div>
                <div class="post-time">{{ $post->created_at->diffForHumans() }}</div>
                <div class="post-nickname">{{ $post->user->name }}</div>
              </div>
              <div class="post-category">
                <span class="badge post-badge">{{ $post->category->type === 'pro' ? '🔥' : '🐤' }} {{ $post->category->name }}</span>
              </div>
            </div>
            <p class="post-content fw-bold">{{ $post->content }}</p>
            @if($post->image_path)
            <div class="post-image-wrapper">
              <img src="{{ asset('storage/' . $post->image_path) }}" alt="投稿画像" class="post-image">
            </div>
            @endif
            <div class="post-footer">
              <button type="button" class="like-btn" data-url="{{ route('posts.toggleLike', $post) }}">
                <img src="{{ $post->likes->contains('user_id', Auth::id()) ? asset('img/material/good-mami.png') : asset('img/material/no-mami.png') }}"
                  alt="いいね" class="like-img"
                  data-good="{{ asset('img/material/good-mami.png') }}"
                  data-no="{{ asset('img/material/no-mami.png') }}"
                  data-good-alert="{{ asset('img/material/good-alert.png') }}">
                <span class="like-count">{{ $post->likes->count() }}</span>
              </button>
            </div>
          </div>
        </div>
        @empty
        <p class="text-muted text-center mt-4">まだ投稿がありません。</p>
        @endforelse

        <!-- モーダル起動ボタン -->
        <button type="button" class="create-btn border-0 bg-transparent p-0" data-bs-toggle="modal" data-bs-target="#createPostModal">
          <img src="{{ asset('img/material/create.png') }}" alt="投稿する" class="create-img">
        </button>

        <!-- 投稿作成モーダル -->
        <div class="modal fade" id="createPostModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

              <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="createPostModalLabel">投稿を作成する</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
              </div>

              <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                  <!-- カテゴリ選択 -->
                  <div class="mb-4">
                    <label for="category_id" class="form-label fw-semibold">テーマ（必須）</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                      <option value="">{{ $categories->pluck('name')->join('・') }} から選んでください</option>
                      @foreach($categories as $category)
                      <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->type === 'pro' ? '🔥' : '🐤' }} {{ $category->name }}
                      </option>
                      @endforeach
                    </select>
                    @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <!-- 画像アップロード -->
                  <div class="mb-4">
                    <label for="image" class="form-label fw-semibold">画像（必須）</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" required>
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <!-- コメント -->
                  <div class="mb-3">
                    <label for="content" class="form-label fw-semibold">コメント（必須）</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="4" placeholder="例：美唄の風景を撮りました！" required>{{ old('content') }}</textarea>
                    @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                </div>
                <div class="modal-footer border-0 pt-0">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                  <button type="submit" class="btn btn-primary">作成する</button>
                </div>
              </form>

            </div>
          </div>
        </div>

      </div><!-- /posts-container -->
    </div><!-- /col-md-8 -->

    <!-- 右：空白 col-2 -->
    <div class="col-md-2 d-none d-md-block"></div>

  </div><!-- /row -->
</div><!-- /container-fluid -->
@endsection

@push('scripts')
<script src="{{ asset('js/like.js') }}"></script>
@endpush