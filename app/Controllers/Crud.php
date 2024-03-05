<?php

namespace App\Controllers;

use App\Models\DataModel;

class Crud extends BaseController
{
    public $model;
    public $Upload;

    public function __construct()
    {
        $this->model = model(DataModel::class);
        $this->Upload = new Upload();
    }


    public function index($err = false)
    {
        helper('form');

        $data = $this->model->readData();

        if (!$err || gettype($err) == 'string') {

            if (!empty($data['dataRead']) && is_array($data['dataRead'])) {

                return view('templates/header')
                    . view('dataMahasiswa/create', $data)
                    . view('dataMahasiswa/show', $data)
                    . view('templates/footer');
            }

            return view('templates/header')
                . view('dataMahasiswa/create', $data)
                . view('errors/error_database_empty')
                . view('errors/error_validation')
                . view('dataMahasiswa/show', $data)
                . view('templates/footer');
        } else {

            return view('templates/header')
                . view('dataMahasiswa/create', $data)
                . view('errors/error_input')
                . view('dataMahasiswa/show', $data)
                . view('templates/footer');
        }
    }




    public function getPostAndValidate()
    {
        $data = $this->request->getPost(['nama', 'nim', 'jenis_kelamin']);

        // melakukan checking pada input user apakah sudah sesuai dengan aturan validasi seperti dibawah
        if (!$this->validateData($data, [
            'nama' => 'required|max_length[255]|min_length[3]',
            'nim' => 'required|max_length[5000]|min_length[8]',
            'jenis_kelamin' => 'required',
        ])) {

            // Tvalidasi gagal, menampilkan error page
            return $this->index(true);
        }

        // menyimpan data yg sudah divalidasi
        return $post = $this->validator->getValidated();
    }


    public function create()
    {
        helper('form');

        $post = $this->getPostAndValidate();

        // get foto dari post
        $img = $this->request->getFile('userfile');

        // run upload controller method
        $uploadImg = $this->Upload->upload($img);


        if (!empty($uploadImg['foto'])) {

            // menyimpan data ke dalam database
            $this->model->save([
                'nama' => $post['nama'],
                'nim' => $post['nim'],
                'jenis_kelamin' => $post['jenis_kelamin'],
                'foto' => $uploadImg['foto'],
            ]);
        }


        // baca data 
        $data = $this->model->readData();


        if (!empty($data['dataRead']) && empty($data['errors'])) {

            return view('templates/header')
                . view('dataMahasiswa/create', $data)
                . view('success')
                . view('dataMahasiswa/show', $data)
                . view('templates/footer');
        }

        if (empty($data['dataRead'])) {
            return view('templates/header')
                . view('dataMahasiswa/create', $data)
                . view('errors/error_database_empty')
                . view('dataMahasiswa/show', $data)
                . view('templates/footer');
        }

        return view('templates/header')
            . view('dataMahasiswa/create', $data)
            . view('errors/error_validation', $data)
            . view('dataMahasiswa/show', $data)
            . view('templates/footer');
    }


    public function formUpdate($id)
    {
        helper('form');

        $post = $this->getPostAndValidate();

        $dataBaru = [
            'nama' => $post['nama'],
            'nim' => $post['nim'],
            'jenis_kelamin' => $post['jenis_kelamin'],
        ];

        // ambil data dari database
        $data = $this->model->updateData($id, $dataBaru);

        return $this->index();
    }

    public function update($id)
    {
        helper('form');

        $dataID = [
            'id' => $id,
        ];

        $data = $this->model->readData();

        // menggabungkan array agar terdapat 'id' dan 'dataRead' dalam satu variabel
        $dataMerge = array_merge($dataID, $data);

        return view('templates/header')
            . view('dataMahasiswa/create', $data)
            . view('dataMahasiswa/edit', $dataMerge)
            . view('templates/footer');
    }

    public function hapus($id)
    {
        helper('form');

        $this->model->delete(['id' => $id]);

        return $this->index();
    }
}
