(function () {
  'use strict';

  function uid() {
    return 'n' + Date.now().toString(36) + Math.random().toString(36).slice(2, 7);
  }

  function cloneTemplate(tpl, rowid) {
    var html = tpl.innerHTML;
    if (rowid) { html = html.split('__ROWID__').join(rowid); }
    var wrap = document.createElement('div');
    wrap.innerHTML = html.trim();
    return wrap.firstElementChild;
  }

  function rowsIn(container) {
    return Array.prototype.slice.call(container.querySelectorAll(':scope > [data-mm-row]'));
  }

  function rowAfterPointer(container, y) {
    var rows = rowsIn(container).filter(function (r) { return !r.classList.contains('is-dragging'); });
    var closest = null, closestOffset = -Infinity;
    rows.forEach(function (row) {
      var box = row.getBoundingClientRect();
      var offset = y - box.top - box.height / 2;
      if (offset < 0 && offset > closestOffset) { closestOffset = offset; closest = row; }
    });
    return closest;
  }

  function enableDragReorder(list) {
    if (!list || list.dataset.mmDragBound) { return; }
    list.dataset.mmDragBound = '1';
    var dragging = null;

    list.addEventListener('dragstart', function (e) {
      var row = e.target.closest('[data-mm-row]');
      if (!row || row.parentElement !== list) { return; }
      dragging = row;
      row.classList.add('is-dragging');
      if (e.dataTransfer) { e.dataTransfer.effectAllowed = 'move'; }
    });
    list.addEventListener('dragend', function () {
      if (dragging) { dragging.classList.remove('is-dragging'); }
      dragging = null;
    });
    list.addEventListener('dragover', function (e) {
      if (!dragging) { return; }
      e.preventDefault();
      var after = rowAfterPointer(list, e.clientY);
      if (after == null) { list.appendChild(dragging); } else { list.insertBefore(dragging, after); }
    });
  }

  function initList(list) { enableDragReorder(list); }

  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-mm-list]').forEach(initList);

    document.addEventListener('click', function (e) {
      var addGameBtn = e.target.closest('[data-mm-add-game]');
      if (addGameBtn) {
        var gamesList = addGameBtn.closest('[data-mm-list]');
        var gameTpl = gamesList && gamesList.parentElement.querySelector(':scope > template[data-mm-template-game]');
        if (!gamesList || !gameTpl) { return; }
        var newGame = cloneTemplate(gameTpl, uid());
        gamesList.insertBefore(newGame, addGameBtn);
        newGame.querySelectorAll('[data-mm-list]').forEach(initList);
        return;
      }

      var addBtn = e.target.closest('[data-mm-add]');
      if (addBtn) {
        var list = addBtn.closest('[data-mm-list]');
        var tpl = list && list.querySelector(':scope > template[data-mm-template]');
        if (!list || !tpl) { return; }
        var newRow = cloneTemplate(tpl);
        list.insertBefore(newRow, addBtn);
        return;
      }

      var removeBtn = e.target.closest('[data-mm-remove]');
      if (removeBtn) {
        var row = removeBtn.closest('[data-mm-row]');
        if (row) { row.remove(); }
        return;
      }
    });
  });
})();
