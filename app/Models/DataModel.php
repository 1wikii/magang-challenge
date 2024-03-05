<?php

namespace App\Models;

use CodeIgniter\Model;

class DataModel extends Model
{
   protected $table = 'data';
   protected $primaryKey = 'id';

   protected $allowedFields = ['nama', 'nim', 'jenis_kelamin', 'foto'];

   public function getData()
   {
      return $this->findAll();
   }

   public function findData($id)
   {
      return $this->find($id);
   }

   public function readData($id = null)
   {
      if (empty($id)) {

         return $data = [
            'dataRead' => $this->getData(),
            'errors' => [],
            'foto' => null,
         ];
      }


      return $data = [
         'dataRead' => $this->findData($id),
         'errors' => [],
         'foto' => null,
      ];
   }

   public function updateData($id, $data)
   {
      $this->update(['id' => $id], $data);
   }

   public function updateFoto($id, $dataBaru)
   {
      $this->update(['id' => $id], $dataBaru);
   }
}
