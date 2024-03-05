<?php


namespace App\Controllers;

use App\Models\DataModel;

class Upload extends BaseController
{
   protected $helper = ['form'];

   public $model;

   function __construct()
   {
      $this->model = model(DataModel::class);
   }

   public function index()
   {
      helper('form');

      $data = $this->model->readData();

      return view('templates/header')
         . view('dataMahasiswa/create', $data)
         . view('dataMahasiswa/show', $data)
         . view('templates/footer');
   }

   public function upload($img)
   {
      helper('form');

      // read data 
      $data = $this->model->readData();

      $validationRule = [
         'userFile' => [
            'label' => 'Image File',
            'rules' => [
               'uploaded[userfile]',
               'is_image[userfile]',
               'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
               'max_size[userfile,1000]',
               'max_dims[userfile,5000,5000]',
            ],
         ],
      ];

      if (!$this->validateData([], $validationRule)) {
         $error = $this->validator->getErrors();

         // return view('templates/header')
         //    . view('dataMahasiswa/create', $data)
         //    . view('dataMahasiswa/show', $error)
         //    . view('templates/footer');

         $data['errors'] = $error;
         return $data;
      }

      // $img = $this->request->getFile('userfile');

      if ($img->isValid() && !$img->hasMoved()) {

         $extensions = ltrim(strrchr($img->getMimeType(), '/'), '/');
         $name = uniqid("IMG_", true);
         $filepath = 'uploads/';

         $name = $name . "." . $extensions;
         $img->move($filepath, $name);

         // update kolom foto
         // $id = $this->model->getDataTerakhir();
         // $id = $id[0]->id;
         // $this->model->updateFoto($id, $name);


         // return view('templates/header')
         //    . view('dataMahasiswa/create', $data)
         //    . view('dataMahasiswa/show', $data)
         //    . view('templates/footer');

         $data['foto'] = $name;
         return $data;
      }

      $data['errors'] = "This file has already been moved!";

      return $data;
   }


   public function fotoUpdateGet($id)
   {
      helper('form');

      $data = [
         'id' => $id,
      ];

      return view('dataMahasiswa/edit_foto', $data);
   }

   // public function fotoUpdatePostSimpan()
   // {
   //    // menyimpan data ke dalam database
   //    $this->model->save([
   //       'nama' => $post['nama'],
   //       'nim' => $post['nim'],
   //       'jenis_kelamin' => $post['jenis_kelamin'],
   //       'foto' => $uploadImg['foto'],
   //    ]);
   // }

   public function fotoUpdatePost($id)
   {
      helper('form');

      // ambil post foto
      $img = $this->request->getFile('userfile');

      // move images ke public
      $data = $this->upload($img);

      // update nama foto ke database
      $this->model->updateFoto($id, $data);


      // baca data dan cari data
      $data = $this->model->readData();


      return view('templates/header')
         . view('dataMahasiswa/create', $data)
         . view('dataMahasiswa/show', $data)
         . view('templates/footer');
   }
}
