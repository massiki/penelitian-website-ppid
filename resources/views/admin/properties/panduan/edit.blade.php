@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Panduan</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <form action="/panduan/{{ $panduan->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="row">
          <div class="col-12 col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="mb-4">
                  <label for="judul">
                    <h5 class="mb-0">Judul</h5>
                  </label>
                  <input class="form-control" type="text" id="judul" name="judul"
                    value="{{ old('judul', $panduan->judul) }}">
                  @error('judul')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="deskripsi">
                    <h5 class="mb-0">Deskripsi / Subtitle</h5>
                  </label>
                  <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3">{{ old('deskripsi', $panduan->deskripsi) }}</textarea>
                </div>
                <div class="mb-4">
                  <label for="gambar">
                    <h5 class="mb-0">Gambar</h5>
                  </label>
                  @if ($panduan->gambar)
                    <div class="mb-2">
                      <img src="{{ asset('storage/' . $panduan->gambar) }}" class="img-fluid rounded" id="previewImage"
                        style="max-height: 150px;">
                    </div>
                  @endif
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="imageInput" name="gambar"
                        onchange="showIframe()">
                      <label class="custom-file-label" for="gambar">Pilih file</label>
                    </div>
                  </div>
                  @error('gambar')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="video_url">
                    <h5 class="mb-0">Video URL</h5>
                  </label>
                  <input class="form-control" type="text" id="video_url" name="video_url"
                    value="{{ old('video_url', $panduan->video_url) }}">
                </div>
                <div class="mb-4">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                      {{ $panduan->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                      <h5 class="mb-0">Aktif</h5>
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-8">
            <div class="card">
              <div class="card-body">
                <div class="mb-4">
                  <label for="deskripsi_konten">
                    <h5 class="mb-0">Deskripsi Konten</h5>
                  </label>
                  <input id="deskripsi_konten" type="hidden" name="deskripsi_konten"
                    value="{{ old('deskripsi_konten', $panduan->deskripsi_konten) }}">
                  <trix-editor input="deskripsi_konten"></trix-editor>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Persyaratan / Alasan</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm" onclick="addListItem('persyaratan')">
                    <i class="fas fa-plus"></i> Tambah
                  </button>
                </div>
              </div>
              <div class="card-body">
                <input type="hidden" name="persyaratan" id="persyaratan_input"
                  value='{{ old('persyaratan', json_encode($panduan->persyaratan ?? [])) }}'>
                <div id="persyaratan_list"></div>
                <small class="text-muted">Daftar persyaratan (untuk panduan permohonan) atau alasan (untuk panduan
                  pengajuan).</small>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Status</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm" onclick="addListItem('status_list')">
                    <i class="fas fa-plus"></i> Tambah
                  </button>
                </div>
              </div>
              <div class="card-body">
                <input type="hidden" name="status_list" id="status_list_input"
                  value='{{ old('status_list', json_encode($panduan->status_list ?? [])) }}'>
                <div id="status_list_list"></div>
                <small class="text-muted">Daftar status yang ditampilkan.</small>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Langkah-Langkah</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm" onclick="addLangkah()">
                    <i class="fas fa-plus"></i> Tambah Langkah
                  </button>
                </div>
              </div>
              <div class="card-body">
                <input type="hidden" name="langkah" id="langkah_input"
                  value='{{ old('langkah', json_encode($panduan->langkah ?? [])) }}'>
                <div id="langkah_list"></div>
              </div>
            </div>

            <div class="mb-3">
              <a href="/panduan" class="btn btn-secondary">Kembali</a>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </div>
        </div>
      </form>
    </section>
  </div>
@endsection

@push('scripts')
  <script>
    function renderListItems(type) {
      var input = document.getElementById(type + '_input');
      var list = document.getElementById(type + '_list');
      var data = JSON.parse(input.value || '[]');
      list.innerHTML = '';
      data.forEach(function(item, index) {
        var div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = '<input type="text" class="form-control" value="' + item + '" data-index="' + index +
          '" oninput="updateListItem(\'' + type + '\', ' + index +
          ', this.value)"><div class="input-group-append"><button type="button" class="btn btn-danger" onclick="removeListItem(\'' +
          type + '\', ' + index + ')"><i class="fas fa-times"></i></button></div>';
        list.appendChild(div);
      });
    }

    function addListItem(type) {
      var input = document.getElementById(type + '_input');
      var data = JSON.parse(input.value || '[]');
      data.push('');
      input.value = JSON.stringify(data);
      renderListItems(type);
    }

    function removeListItem(type, index) {
      var input = document.getElementById(type + '_input');
      var data = JSON.parse(input.value || '[]');
      data.splice(index, 1);
      input.value = JSON.stringify(data);
      renderListItems(type);
    }

    function updateListItem(type, index, value) {
      var input = document.getElementById(type + '_input');
      var data = JSON.parse(input.value || '[]');
      data[index] = value;
      input.value = JSON.stringify(data);
    }

    function renderLangkah() {
      var input = document.getElementById('langkah_input');
      var list = document.getElementById('langkah_list');
      var data = JSON.parse(input.value || '[]');
      list.innerHTML = '';
      data.forEach(function(item, idx) {
        var card = document.createElement('div');
        card.className = 'card card-outline card-primary mb-3';
        card.innerHTML =
          '<div class="card-header d-flex justify-content-between align-items-center"><h5 class="mb-0">Langkah ' + (
            idx + 1) + '</h5><button type="button" class="btn btn-danger btn-sm" onclick="removeLangkah(' + idx +
          ')"><i class="fas fa-trash"></i></button></div><div class="card-body"><div class="mb-3"><label>Judul</label><input type="text" class="form-control" value="' +
          (item.judul || '') + '" oninput="updateLangkah(' + idx +
          ', \'judul\', this.value)"></div><div class="mb-3"><label>Deskripsi</label><textarea class="form-control" rows="2" oninput="updateLangkah(' +
          idx + ', \'deskripsi\', this.value)">' + (item.deskripsi || '') +
          '</textarea></div><div class="mb-3"><label class="d-block">Fields (opsional)<button type="button" class="btn btn-primary btn-sm float-right" onclick="addLangkahField(' +
          idx + ')"><i class="fas fa-plus"></i></button></label><div id="langkah_fields_' + idx +
          '"></div></div></div>';
        list.appendChild(card);
        renderLangkahFields(idx);
      });
    }

    function addLangkah() {
      var input = document.getElementById('langkah_input');
      var data = JSON.parse(input.value || '[]');
      data.push({
        judul: '',
        deskripsi: '',
        fields: []
      });
      input.value = JSON.stringify(data);
      renderLangkah();
    }

    function removeLangkah(index) {
      var input = document.getElementById('langkah_input');
      var data = JSON.parse(input.value || '[]');
      data.splice(index, 1);
      input.value = JSON.stringify(data);
      renderLangkah();
    }

    function updateLangkah(index, field, value) {
      var input = document.getElementById('langkah_input');
      var data = JSON.parse(input.value || '[]');
      data[index][field] = value;
      input.value = JSON.stringify(data);
    }

    function renderLangkahFields(langkahIdx) {
      var input = document.getElementById('langkah_input');
      var data = JSON.parse(input.value || '[]');
      var item = data[langkahIdx];
      var fields = item ? (item.fields || []) : [];
      var container = document.getElementById('langkah_fields_' + langkahIdx);
      if (!container) return;
      container.innerHTML = '';
      fields.forEach(function(field, fIdx) {
        var div = document.createElement('div');
        div.className = 'input-group mb-1';
        div.innerHTML = '<input type="text" class="form-control form-control-sm" value="' + field +
          '" oninput="updateLangkahField(' + langkahIdx + ', ' + fIdx +
          ', this.value)"><div class="input-group-append"><button type="button" class="btn btn-danger btn-sm" onclick="removeLangkahField(' +
          langkahIdx + ', ' + fIdx + ')"><i class="fas fa-times"></i></button></div>';
        container.appendChild(div);
      });
    }

    function addLangkahField(langkahIdx) {
      var input = document.getElementById('langkah_input');
      var data = JSON.parse(input.value || '[]');
      if (!data[langkahIdx].fields) data[langkahIdx].fields = [];
      data[langkahIdx].fields.push('');
      input.value = JSON.stringify(data);
      renderLangkahFields(langkahIdx);
    }

    function removeLangkahField(langkahIdx, fieldIdx) {
      var input = document.getElementById('langkah_input');
      var data = JSON.parse(input.value || '[]');
      data[langkahIdx].fields.splice(fieldIdx, 1);
      input.value = JSON.stringify(data);
      renderLangkahFields(langkahIdx);
    }

    function updateLangkahField(langkahIdx, fieldIdx, value) {
      var input = document.getElementById('langkah_input');
      var data = JSON.parse(input.value || '[]');
      data[langkahIdx].fields[fieldIdx] = value;
      input.value = JSON.stringify(data);
    }

    document.addEventListener('DOMContentLoaded', function() {
      renderListItems('persyaratan');
      renderListItems('status_list');
      renderLangkah();
    });
  </script>
@endpush
