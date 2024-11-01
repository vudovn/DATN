// hover vào ảnh sẽ thay đổi ảnh
$('[data-img-hover]').hover(function() {
    const $this = $(this);
    console.log('hover');
    $this.data('img-original', $this.attr('src'));
    $this.attr('src', $this.data('img-hover'));
}, function() {
    const $this = $(this);
    $this.attr('src', $this.data('img-original'));
});

