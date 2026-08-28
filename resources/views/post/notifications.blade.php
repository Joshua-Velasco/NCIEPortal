@extends('layouts.admin')

@section('content')

<div class="row">
    <h1>Notificaciones</h1>
</div>
<hr>

<div class="row">
    <div class="col-md-12">
        <div class="card notif-card">
            <div class="card-header notif-head">
                <h3 class="card-title">Sin leer <span class="notif-count" id="unread-count">{{ $postNotifications->count() }}</span></h3>
                <button type="button" class="btn btn-secondary btn-sm" id="mark-all" {{ $postNotifications->isEmpty() ? 'hidden' : '' }}>Marcar todas como leídas</button>
            </div>
            <ul class="notif-list" id="unread-list">
                @forelse ($postNotifications as $notification)
                    <li class="notif-item" data-id="{{ $notification->id }}">
                        <span class="notif-dot" aria-hidden="true"></span>
                        <div class="notif-body">
                            <strong>{{ $notification->data['title'] ?? 'Aviso' }}</strong>
                            <p>{{ $notification->data['description'] ?? '' }}</p>
                            <time datetime="{{ $notification->created_at->toIso8601String() }}">{{ $notification->created_at->diffForHumans() }}</time>
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm mark-as-read" data-id="{{ $notification->id }}">Marcar leída</button>
                    </li>
                @empty
                    <li class="notif-empty" id="unread-empty">No tienes avisos pendientes.</li>
                @endforelse
            </ul>
        </div>

        <div class="card notif-card notif-card--read">
            <div class="card-header notif-head">
                <h3 class="card-title">Leídas</h3>
                <span class="notif-hint">Últimas 30</span>
            </div>
            <ul class="notif-list" id="read-list">
                @forelse ($readNotifications as $notification)
                    <li class="notif-item">
                        <span class="notif-dot" aria-hidden="true"></span>
                        <div class="notif-body">
                            <strong>{{ $notification->data['title'] ?? 'Aviso' }}</strong>
                            <p>{{ $notification->data['description'] ?? '' }}</p>
                            <time datetime="{{ $notification->created_at->toIso8601String() }}">{{ $notification->created_at->diffForHumans() }}</time>
                        </div>
                    </li>
                @empty
                    <li class="notif-empty" id="read-empty">Aquí aparecerán los avisos que ya leíste.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

<script>
(function () {
  var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  var unreadList = document.getElementById('unread-list');
  var readList = document.getElementById('read-list');
  var countEl = document.getElementById('unread-count');
  var markAll = document.getElementById('mark-all');

  function markRequest(id) {
    var body = new FormData();
    body.append('_token', token);
    if (id) { body.append('id', id); }
    return fetch('{{ route('markNotification') }}', {
      method: 'POST', body: body,
      headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
    }).then(function (r) { if (!r.ok) { throw new Error(r.status); } return r.json(); });
  }
  function moveToRead(item) {
    var btn = item.querySelector('.mark-as-read');
    if (btn) { btn.remove(); }
    item.removeAttribute('data-id');
    var empty = document.getElementById('read-empty');
    if (empty) { empty.remove(); }
    readList.insertBefore(item, readList.firstChild);
  }
  function refresh(unread) {
    countEl.textContent = unread;
    if (unread === 0) {
      markAll.hidden = true;
      if (!document.getElementById('unread-empty')) {
        var li = document.createElement('li');
        li.className = 'notif-empty'; li.id = 'unread-empty'; li.textContent = 'No tienes avisos pendientes.';
        unreadList.appendChild(li);
      }
    }
    var badge = document.querySelector('.ncie-nav-badge');
    if (badge) { if (unread === 0) { badge.remove(); } else { badge.textContent = unread; } }
  }
  unreadList.addEventListener('click', function (e) {
    var btn = e.target.closest('.mark-as-read');
    if (!btn) { return; }
    var item = btn.closest('.notif-item');
    btn.disabled = true;
    markRequest(btn.getAttribute('data-id')).then(function (res) { moveToRead(item); refresh(res.unread); })
      .catch(function () { btn.disabled = false; });
  });
  markAll.addEventListener('click', function () {
    markAll.disabled = true;
    markRequest(null).then(function (res) {
      Array.prototype.slice.call(unreadList.querySelectorAll('.notif-item')).forEach(moveToRead);
      refresh(res.unread);
    }).catch(function () { markAll.disabled = false; });
  });
})();
</script>

@endsection
