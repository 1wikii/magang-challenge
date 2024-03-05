<table class="table table-striped align-self-center mt-4 rounded-4" style="max-width: 95%;">

   <thead>
      <tr>
         <th scope="col">Nama</th>
         <th scope="col">NIM</th>
         <th scope="col">Jenis Kelamin</th>
         <th scope="col" class="text-center">Foto</th>
         <th scope="col" class="text-center">Aksi</th>
      </tr>
   </thead>
   <tbody class="">

      <?php if (!empty($dataRead) && is_array($dataRead)) : ?>

         <?php foreach ($dataRead as $perData) : ?>

            <?php if ($id == $perData['id']) : ?>

               <tr>
                  <td contenteditable="true" id="nama" class="table-warning align-middle"> <?= esc($perData['nama']) ?> </td>
                  <td contenteditable="true" id="nim" class="table-warning align-middle"> <?= esc($perData['nim']) ?> </td>
                  <td contenteditable="true" id="jenis_kelamin" class="table-warning align-middle"> <?= esc($perData['jenis_kelamin']) ?> </td>
                  <td id="foto">



                     <div class="mb-1 d-flex flex-column justify-content-center align-items-center">

                        <?php if ($perData['foto'] != null) : ?>

                           <img class="img-thumbnail" src="<?= base_url('uploads/' . $perData['foto']) ?>" height="80px" width="100px" alt="Foto">
                           <a href="<?= base_url('edit/foto/' . esc($perData['id'], 'url')) ?>" class="mt-2"> <button type="button" class="btn btn-dark px-4 py-1" style="font-size: .75em;">Ganti</button></a>
                        <?php endif; ?>
                     </div>


                  </td>
                  <td class="text-center align-middle">

                     <?= session()->getFlashdata('error') ?>
                     <?= validation_list_errors() ?>

                     <form action="<?= base_url('edit/' . $id) ?>" method="post">
                        <?= csrf_field() ?>

                        <input style="display: none;" id="input_nama" type="input" name="nama">
                        <input style="display: none;" id="input_nim" type="input" name="nim">
                        <input style="display: none;" id="input_jenis_kelamin" type="input" name="jenis_kelamin">


                        <button onclick="migrateValue()" type="submit" class="btn btn-primary"> Simpan </button>

                        <script>
                           function migrateValue() {
                              let nama = document.getElementById('nama').innerText;
                              let nim = document.getElementById('nim').innerText;
                              let jenis_kelamin = document.getElementById('jenis_kelamin').innerText;

                              document.getElementById('input_nama').value = nama;
                              document.getElementById('input_nim').value = nim;
                              document.getElementById('input_jenis_kelamin').value = jenis_kelamin;
                           }
                        </script>

                     </form>
                  </td>
               </tr>

            <?php else : ?>
               <tr>
                  <td> <?= esc($perData['nama']) ?> </td>
                  <td> <?= esc($perData['nim']) ?> </td>
                  <td> <?= esc($perData['jenis_kelamin']) ?> </td>
                  <td>

                     <?php foreach ($errors as $error) : ?>
                        <li><?= esc($error) ?></li>
                     <?php endforeach ?>

                     <div class="mb-1 d-flex flex-column justify-content-center align-items-center">

                        <?php if ($perData['foto'] == null) : ?>
                           @Foto
                        <?php else : ?>
                           <img class="img-thumbnail" src="<?= base_url('uploads/' . $perData['foto']) ?>" height="80px" width="100px" alt="Foto">
                        <?php endif; ?>

                     </div>


                  </td>
                  <td class="text-center">
                     <a href="<?= base_url('/edit/' . esc($perData['id'], 'url')) ?>" type="button" class="btn btn-warning">Edit</a>
                     <a href="<?= base_url('hapus/1/' . esc($perData['id'], 'url')) ?>" type="button" class="btn btn-danger">Hapus</a>
                  </td>
               </tr>
            <?php endif; ?>

         <?php endforeach; ?>

      <?php endif; ?>
   </tbody>
</table>