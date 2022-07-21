<section class="page-section">
  <div class="container">
    <div class="text-center">
      <h2 class="section-heading text-uppercase mt-4">Upload File GLTF</h2>
      <h3 class="section-subheading text-muted">Pastikan file yang anda upload valid (.gltf)</h3>
    </div>
    <form id="gltfForm" action="?page=gltf&action=store" method="POST" enctype="multipart/form-data">
      <div class="row align-items-stretch mb-5">
        <div class="col-md-6">
          <div class="form-group">
            <input type="text" class="form-control" id="title" name="title" placeholder="Judul" data-sb-validations="required" />
          </div>
        </div>
        <div class="col-md-6">
          <input type="file" id="gltf" name="gltf" required />
        </div>
        <div class="col-md-12 mt-4">
          <textarea class="form-control" id="gltf" name="gltf" placeholder="Keterangan"></textarea>
        </div>
      </div>
      <!-- Submit Button-->
      <div class="text-center">
        <button type="submit" class="btn btn-primary btn-xl text-uppercase" id="submitButton">Simpan</button>
      </div>
    </form>
  </div>
</section>