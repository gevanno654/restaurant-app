<?php
include('layout/header.php');
?>

<h1 style="text-align: center; font-size: 36px; font-weight: bold; padding-top: 2%; padding-bottom: 2%;">Edit Menu</h1>
<div class="editmenu-container">
  <button type="button" id="add-product-button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#selectProductModal">Tambah Produk</button>
  <select name="jenis-produk" id="jenis-produk" class="form-select text-center">
      <option value="none" selected="selected">-- Pilih Jenis Produk untuk Ditampilkan pada Tabel--</option>
      <option value="makanan">Makanan</option>
      <option value="minuman">Minuman</option>
      <option value="sidedish">Side dish</option>
  </select>
</div>
<div id="wrapper" style="padding-top: 2%;"></div>

<!-- Select Product Modal -->
<div class="modal fade" id="selectProductModal" tabindex="-1" aria-labelledby="selectProductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="selectProductModalLabel">Pilih Jenis Produk</h5>
      </div>
      <div class="modal-body" style="display: flex; justify-content: center; gap: 2%;">
        <button type="button" class="btn btn-primary" style="width: 150px; height: 150px; font-size: 24px; font-weight: bold;" data-bs-toggle="modal" data-bs-target="#addMakananModal" onclick="setModalUsed('makanan')">Makanan</button>
        <button type="button" class="btn btn-warning" style="width: 150px; height: 150px; font-size: 24px; font-weight: bold;" data-bs-toggle="modal" data-bs-target="#addMinumanModal" onclick="setModalUsed('minuman')">Minuman</button>
        <button type="button" class="btn btn-danger" style="width: 150px; height: 150px; font-size: 24px; font-weight: bold;" data-bs-toggle="modal" data-bs-target="#addSidedishModal" onclick="setModalUsed('sidedish')">Side Dish</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Add Makanan Modal -->
<div class="modal fade" id="addMakananModal" tabindex="-1" aria-labelledby="addMakananModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addMakananModalLabel">Tambah Makanan</h5>
      </div>
      <div class="modal-body">
        <form id="add-makanan-form" action="./model/process_form.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="modal_used" id="modal_used" value="makanan"> <!-- Nilai ini akan diganti oleh JavaScript -->
          <div class="mb-3">
            <label for="makanan-name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="makanan-name" name="name">
          </div>
          <div class="mb-3">
            <label for="makanan-price" class="form-label">Harga</label>
            <input type="text" class="form-control" id="makanan-price" name="price">
          </div>
          <div class="mb-3">
            <label for="makanan-img" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="makanan-img" name="img" accept=".png">
          </div>
          <div class="mb-3">
            <label for="makanan-description" class="form-label">Keterangan</label>
            <input type="text" class="form-control" id="makanan-description" name="description">
          </div>
          <div class="mb-3">
            <label for="makanan-category" class="form-label">Kategori</label>
            <input type="number" class="form-control" id="makanan-category" name="category" placeholder="1=Paket Hemat, 2=Rice Bowl, 3=Makanan, 4=Promo">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#selectProductModal">Kembali</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Add Minuman Modal -->
<div class="modal fade" id="addMinumanModal" tabindex="-1" aria-labelledby="addMinumanModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addMinumanModalLabel">Tambah Minuman</h5>
      </div>
      <div class="modal-body">
        <form id="add-minuman-form" action="./model/process_form.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="modal_used" id="modal_used" value="minuman"> <!-- Nilai ini akan diganti oleh JavaScript -->
          <div class="mb-3">
            <label for="minuman-name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="minuman-name" name="name">
          </div>
          <div class="mb-3">
            <label for="minuman-price" class="form-label">Harga</label>
            <input type="text" class="form-control" id="minuman-price" name="price">
          </div>
          <div class="mb-3">
            <label for="minuman-img" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="minuman-img" name="img">
          </div>
          <div class="mb-3">
            <label for="minuman-description" class="form-label">Keterangan</label>
            <input type="text" class="form-control" id="minuman-description" name="description">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#selectProductModal">Kembali</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Add Sidedish Modal -->
<div class="modal fade" id="addSidedishModal" tabindex="-1" aria-labelledby="addSidedishModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSidedishModalLabel">Tambah Side Dish</h5>
      </div>
      <div class="modal-body">
        <form id="add-sidedish-form" action="./model/process_form.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="modal_used" id="modal_used" value="sidedish"> <!-- Nilai ini akan diganti oleh JavaScript -->
          <div class="mb-3">
            <label for="sidedish-name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="sidedish-name" name="name">
          </div>
          <div class="mb-3">
            <label for="sidedish-price" class="form-label">Harga</label>
            <input type="text" class="form-control" id="sidedish-price" name="price">
          </div>
          <div class="mb-3">
            <label for="sidedish-img" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="sidedish-img" name="img">
          </div>
          <div class="mb-3">
            <label for="sidedish-description" class="form-label">Keterangan</label>
            <input type="text" class="form-control" id="sidedish-description" name="description">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#selectProductModal">Kembali</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="updateProductModal" tabindex="-1" aria-labelledby="addMakananModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addMakananModalLabel">Edit Produk</h5>
      </div>
      <div class="modal-body">
        <form id="update-product-form" action="./model/process_form.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="modal_used" id="update-modal-used">
          <div class="mb-3">
            <label for="update-product-name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="update-product-name" name="name">
          </div>
          <div class="mb-3">
            <label for="update-product-price" class="form-label">Harga</label>
            <input type="text" class="form-control" id="update-product-price" name="price">
          </div>
          <div class="mb-3 d-flex flex-column">
          <label for="makanan-img" class="form-label">Gambar</label>
            <img src="" alt="image" id="update-image-preview" class="img-fluid mb-2">
            <input type="file" class="form-control" id="update-product-image-input" name="img" accept=".png">
          </div>
          <div class="mb-3">
            <label for="update-product-description" class="form-label">Keterangan</label>
            <input type="text" class="form-control" id="update-product-description" name="description">
          </div>
          <div class="mb-3" id="update-makanan-category">
            <label for="makanan-category" class="form-label">Kategori (1=pahe, 2=rice bowl, 3=makanan, 4=promo)</label>
            <input type="number" class="form-control" id="update-product-category" name="category">
          </div>
          <input type="number" id="update-product-id" name="product_id" hidden>
          <input type="text" name="operation" value="update" hidden>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
include('layout/footer.php');
?>