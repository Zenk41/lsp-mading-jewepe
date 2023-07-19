<?php
namespace app\models;

include_once "app/models/Database.php";

use models\Database;

class Artikel extends Database
{
 public static function all(): array
 {
  return Database::getAll('artikel', ' tgl_terbit DESC', );
 }

 public static function findByID(string $id): array
 {
  $artikel = Database::getOne('artikel', 'ID_artikel', $id);
  return $artikel;
 }

 public static function addArtikel(array $data)
 {
  Database::addOne('artikel', 'ID_penulis, judul, konten, gambar', '?, ?, ?, ?', $data);
 }

 public static function deleteArtikel(string $id)
 {
  Database::deleteOne('artikel', 'ID_artikel', $id);
 }


}

?>