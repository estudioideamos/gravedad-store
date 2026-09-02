(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('[data-hero-counter]').forEach(function (label) {
      var max = parseInt(label.getAttribute('data-hero-counter'), 10);
      var input = label.querySelector('.hero-count-input');
      var counter = label.querySelector('.hero-char-count-num');
      var wrap = label.querySelector('.hero-char-count');
      if (!input || !counter || !max) { return; }
      function update() {
        var len = input.value.length;
        counter.textContent = len;
        wrap.classList.toggle('is-over', len > max);
      }
      input.addEventListener('input', update);
      update();
    });

    document.querySelectorAll('[data-hero-media]').forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        if (!window.wp || !window.wp.media) { return; }
        var type = btn.getAttribute('data-hero-media');
        var targetInput = document.getElementById(btn.getAttribute('data-target'));
        var preview = document.getElementById(btn.getAttribute('data-preview'));
        var frame = window.wp.media({
          title: type === 'video' ? 'Elegir video de fondo' : 'Elegir imagen de fondo',
          library: { type: type },
          multiple: false,
          button: { text: 'Usar este archivo' }
        });
        frame.on('select', function () {
          var attachment = frame.state().get('selection').first().toJSON();
          targetInput.value = attachment.url;
          if (preview) {
            if (type === 'video') {
              preview.innerHTML = '<video src="' + attachment.url + '" muted loop autoplay playsinline></video>';
            } else {
              preview.innerHTML = '<img src="' + attachment.url + '" alt="">';
            }
          }
          btn.textContent = 'Cambiar ' + (type === 'video' ? 'video' : 'imagen');
        });
        frame.open();
      });
    });

    document.querySelectorAll('[data-hero-clear]').forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        var targetInput = document.getElementById(btn.getAttribute('data-target'));
        var preview = document.getElementById(btn.getAttribute('data-preview'));
        if (targetInput) { targetInput.value = ''; }
        if (preview) { preview.innerHTML = '<span class="hero-media-empty">Sin video</span>'; }
      });
    });

  });
})();
