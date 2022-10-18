<div class="content-wrapper">
	<div class="container">
		<div class="row" style="padding-top: 20px">
    <div class="col-lg-12">

      <div class="card p-2  shadow-sm">
        <h3 class="text-center">Unggah Berita</h3>
        <hr>
        <form action="<?= base_url('admin/buat_berita') ?>" method="post" name="form_berita">
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Judul Berita</h5>
              <input type="text" class="form-control" name="judul" id="judul" placeholder="Tulis disini...">
            </div>
          </div><br>

              <h5>Isi Berita</h5>
              <textarea class="form-control" name="isi" id="summernote" placeholder="Tulis disini...">Tulis disini...</textarea>

          
          <div class="text-right">
            <button type="submit" name="tambah" class="btn btn-success" style="width: 200px;">Terbitkan</button>
            <a class="btn btn-primary" href="<?= base_url('admin/daftar_akun');?>">Kembali</a>
          </div>
          <div class="text-center mt-2">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<script>
$(document).ready(function() {
  $('#summernote').summernote();
});

$(document).ready(function () {
    var val = $.trim($("isi").val());
    if (val != "") {
        alert(val);
    }
});
</script>
<!-- Summernote -->
<script src="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
