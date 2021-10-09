<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="row">
    <div class="col-8">
      <h2 class="my-3">Form Tambah Data Komik</h2>
      <form action="/komik/save" method="POST" ecntype="multipart/form-data">
      <!-- biar form nya cuma bisa diinput lewat halaman ini aja, fitur CI4 -->
      <?= csrf_field(); ?>
        <div class="form-group row">
          <label for="judul" class="col-sm-2 col-form-label">Judul</label>
          <div class="col-sm-10">
            <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?= old('judul'); ?>">  
              <!-- div dibawah ini hanya muncul ketika invalid -->
              <div id="validationServer03Feedback" class="invalid-feedback">
                <?= $validation->getError('judul'); ?>
              </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="penulis" name="penulis" value="<?= old('penulis'); ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= old('penerbit'); ?>">
          </div>
        </div>     
        <div class="form-group row">
          <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
          <div class="col-sm-2">
            <img src="/img/naruto.jpg" class="img-thumbnail img-preview">
          </div>
          <div class="col-sm-8">
            <div class="custom-file">
              <input type="file" class="custom-file-input <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>" id="sampul" name="sampul" onchange="previewImg()">
              <!-- div dibawah ini hanya muncul ketika invalid -->
              <div id="validationServer03Feedback" class="invalid-feedback">
                <?= $validation->getError('sampul'); ?>
              </div>
              <label for="sampul" class="custom-file-label">Pilih gambar..</label>
            </div>  
          </div>
        </div>     
        <div class="form-group row">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Tambah Data</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>



<?= $this->endsection(); ?>