document.querySelectorAll('.like-btn').forEach(function (button) {
  button.addEventListener('click', async function () {
    this.disabled = true;

    var url = this.dataset.url;
    var img = this.querySelector('.like-img');
    var countSpan = this.querySelector('.like-count');

    try {
      var response = await fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
      });

      if (!response.ok) throw new Error('Network error');

      var data = await response.json();

      countSpan.textContent = data.likes_count;
      img.src = data.is_liked ? img.getAttribute('data-good') : img.getAttribute('data-no');

    } catch (error) {
      alert('いいねの処理に失敗しました');
    } finally {
      this.disabled = false;
    }
  });
});

