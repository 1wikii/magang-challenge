<table class="table table-striped align-self-center mt-4 rounded-4" style="max-width: 95%;">

   <thead class="table-dark">
      <tr>
         <th scope="col">Nama</th>
         <th scope="col">NIM</th>
         <th scope="col">Jenis Kelamin</th>
         <th scope="col" class="text-center">Foto</th>
         <th scope="col" class="text-center">Aksi</th>
      </tr>
   </thead>
   <tbody class="">



      <?php foreach ($dataRead as $perData) : ?>

         <tr>
            <td class="align-middle"> <?= esc($perData['nama']) ?> </td>
            <td class="align-middle"> <?= esc($perData['nim']) ?> </td>
            <td class="align-middle"> <?= esc($perData['jenis_kelamin']) ?> </td>
            <td class="align-middle">


               <div class="mb-1 d-flex flex-column justify-content-center align-items-center">

                  <?php if ($perData['foto'] != null) : ?>
                     <img class=" img-thumbnail" src="<?= base_url('uploads/' . $perData['foto']) ?>" height="80px" width="100px" alt="Foto">
                  <?php endif; ?>
               </div>

            </td>
            <td class="text-center align-middle">
               <a href="<?= base_url('edit/1/' . esc($perData['id'], 'url')) ?>" type="button" class="btn btn-warning">Edit</a>
               <a href="<?= base_url('hapus/1/' . esc($perData['id'], 'url')) ?>" type="button" class="btn btn-danger">Hapus</a>
            </td>
         </tr>

      <?php endforeach; ?>


   </tbody>
</table>

<script>
   function preview() {
      frame.src = URL.createObjectURL(event.target.files[0]);
      document.getElementById('frame').style.display = "block";
   }
</script>