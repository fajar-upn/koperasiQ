<div class="content-wrapper">
	<div class="container">
		<div class="row" style="padding-top: 20px">
    <div class="col-lg-12">

      <div class="card p-2  shadow-sm">
        <h3 class="text-center">Unggah Berita</h3>
        <hr>
        <form action="" method="post" name="form_berita" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Judul Berita</h5>
              <input type="text" class="form-control" name="judul" id="judul" placeholder="Tulis disini..." required>
            </div>
          </div><br>

              <h5>Isi Berita</h5>
              <textarea name="isi" id="summernote" required></textarea>

          <table style="width:100%">
              <tr>
                  <td style="width:100%"><a class="btn btn-danger" href="<?= base_url('admin/daftar_akun');?>">Kembali</a></td>
                  <td><button type="submit" name="tambah" class="btn btn-success" style="width: 200px;">Terbitkan</button></td>
              </tr>
          </table>
          
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
