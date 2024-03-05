  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/c2b7ee3658.js" crossorigin="anonymous"></script>

  <div class="w-100 h-100 bg-info-subtle d-flex flex-column justify-content-center align-items-center">
     <div class="d-flex flex-column justify-content-center align-items-center shadow-lg px-3 py-4 b bg-body-tertiary rounded">

        <?= session()->getFlashdata('error') ?>
        <?= validation_list_errors() ?>


        <?= form_open_multipart('edit/foto/' . esc($id, 'url')) ?>
        <?= csrf_field() ?>

        <div class="d-flex flex-column justify-content-center align-items-center">
           <img class="img-fluid my-3 rounded" src="" id="frame" height="auto" width="50%" style="display: none;">
           <input class="form-control w-75 mt-4" id="formFile" name="userfile" type="file" size="20" onchange="preview()">
           <input class="btn btn-primary rounded mt-3 px-4" type="submit" value="Upload">

        </div>

        </form>

     </div>
  </div>

  <script>
     function preview() {
        frame.src = URL.createObjectURL(event.target.files[0]);
        document.getElementById('frame').style.display = "block";
     }
  </script>