<div class="content-wrapper">
<div class="container" style="padding-top:20px">
  <div class="row">
    <div class="col-lg-12">

      <div class="card p-2 shadow-sm">
        <h3 class="text-center">Kalkulator Simulasi Pinjaman</h3>
        <hr>
        <form action="" method="post" name="form_simulasipinjaman">
          <div class="form-row mb-4">
            <div class="col-12 col-sm-12 col-md-4">
                <label>Bunga (%)</label>
                <input type="number" class="form-control" value="2.2" name="bunga" readonly>
            </div>
            <div class="col-12 col-sm-12 col-md-4">
                <label>Jumlah Pinjaman yang Diinginkan (Rupiah)</label>
                <input type="number" class="form-control" name="pinjaman" min="500000" max="100000000" required>
            </div>
             <div class="col-12 col-sm-12 col-md-4">
                <label>Jangka Waktu (Per Bulan)</label>
                <input type="number" class="form-control" name="bulan" min="1" max="12" required>
            </div>
          </div>
          <div class="row mt-1 mb-4 ml-1 mr-1" style="background: #f7f7f7;">
            <div class="col-lg-6 col-xs-12 text-center">
              <div class="mt-3">
                <p class="text-center mt-1 header-desc-text">Pembayaran Per Bulan</p>
                <h2 class="mb-3 amount-text-lg"><?= rupiah2($bayar); ?></h2>
              </div>
            </div>
            <div class="col-lg-6 col-xs-12 text-center">
              <div class="mt-3">
                <p class="text-center mt-1 header-desc-text">Total Pinjaman</p>
                <h2 class="mb-3 amount-text-lg"><?= rupiah2($pinjaman); ?></h2>
              </div>
            </div>
          </div>
          <div class="text-center">
            <button type="submit" name="tambah" class="btn btn-success" style="width: 200px;">Proses</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
