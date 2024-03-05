      <!-- Button trigger modal -->
      <div>
         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            + Tambah Data
         </button>
      </div>

      </div>
      </div>

      <!-- //TODO  MODAL -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Data Mahasiswa</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">


                  <?= form_open_multipart('/create', array('method' => 'post')) ?>
                  <?= csrf_field() ?>



                  <?= session()->getFlashdata('error') ?>
                  <?= validation_list_errors() ?>


                  <div class="d-flex flex-column">


                     <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama</label>
                        <input name="nama" type="input" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text"> </div>
                     </div>

                     <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">NIM</label>
                        <input name="nim" type="input" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text"> </div>
                     </div>

                     <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>

                        <select name="jenis_kelamin" class="form-select" aria-label="Default select example">
                           <option selected disabled></option>
                           <option value="Laki-Laki">Laki-Laki</option>
                           <option value="Perempuan">Perempuan</option>
                        </select>
                     </div>


                     <div class="mb-1 d-flex flex-column justify-content-center align-items-center">

                        <img class="img-fluid my-3 rounded" src="" id="frame" height="auto" width="100%" style="display: none;">
                        <input class="form-control w-75 my-2 mb-4" id="formFile" name="userfile" type="file" size="20" onchange="preview()">


                     </div>


                     <div class="modal-footer d-flex justify-content-center align-items-center">
                        <input type="submit" class="btn btn-primary w-100 fw-bold" value="Simpan"></input>
                     </div>


                     </form>

                  </div>



               </div>
            </div>
         </div>
      </div>



      <script>
         function preview() {
            frame.src = URL.createObjectURL(event.target.files[0]);
            document.getElementById('frame').style.display = "block";
         }
      </script>