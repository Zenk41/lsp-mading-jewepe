<?php
namespace app\models;

use app\models\Database;

class Komentar extends Database
{
 public static function all(): array
 {
  return Database::getAll('komentar','tgl_komentar DESC');
 }

 public static function allByArtikelId($value): array
 {
  return Database::getAll('komentar', 'tgl_komentar DESC', 'ID_artikel', $value);
 }

 public static function addKomentar($data)
 {
  Database::addOne('komentar', 'ID_artikel, name, email, komentar', '?, ?, ?, ?', $data);
 }
 public static function countKomentar($value)
 {
  Database::count('komentar', 'komentar_count', 'ID_artikel', $value);
 }

 public static function deleteKomentar(string $id)
 {
     Database::deleteOne('komentar', 'ID_komentar', $id);
 }
}
?>