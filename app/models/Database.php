<?php
namespace app\models;

use mysqli;


abstract class Database
{

 private static $_dbConnect;
 private static $host = 'localhost';
 private static $user = 'root';
 private static $pass = '';
 private static $dbname = 'mading_jewepe';
 private static function setDb()
 {
  self::$_dbConnect = new mysqli(self::$host, self::$user, self::$pass, self::$dbname);
  if (self::$_dbConnect->connect_error) {
   die("Connection failed: " . self::$_dbConnect->connect_error);
  }
 }

 private static function conn()
 {
  if (self::$_dbConnect == null) {
   self::setdB();
  }

  return self::$_dbConnect;
 }

 protected static function getAll(string $table, string $orderBy = '', string $condition = '', string $value = ''): array
 {

  $sql = 'SELECT * FROM ' . $table;

  if (!empty($condition) && !empty($value)) {
   $sql .= ' WHERE ' . $condition . ' = ?';
  }

  if (!empty($orderBy)) {
   $sql .= ' ORDER BY ' . $orderBy;
  }

  $query = self::conn()->prepare($sql);

  if (!empty($condition) && !empty($value)) {
   $query->bind_param('s', $value);
  }
  $query->execute();
  $result = $query->get_result();
  return $result->fetch_all(MYSQLI_ASSOC);

 }

 public static function getAllPag(string $table, int $pageNumber = 1, int $recordsPerPage = 10, string $orderBy = ''): array
 {
  $offset = ($pageNumber - 1) * $recordsPerPage;
  $sql = 'SELECT * FROM ' . $table;

  if (!empty($orderBy)) {
   $sql .= ' ORDER BY ' . $orderBy;
  }

  $sql .= ' LIMIT ' . $recordsPerPage . ' OFFSET ' . $offset;

  $query = self::conn()->prepare($sql);
  $query->execute();
  $result = $query->get_result();
  return $result->fetch_all(MYSQLI_ASSOC);

 }


 protected static function getOne(string $table, string $condition, string $value, string $condition2 = '', string $value2 = ''): array
 {
  $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $condition . ' = ?';
  $params = [$value];

  if (!empty($condition2) && !empty($value2)) {
   $sql .= ' AND ' . $condition2 . ' = ?';
   $params[] = $value2;
  }

  $query = self::conn()->prepare($sql);


  if (!empty($params)) {
   $types = str_repeat('s', count($params));
   $query->bind_param($types, ...$params);
  }

  $query->execute();
  $result = $query->get_result();
  $rows = $result->fetch_array();

  if (empty($rows)) {
   return [];
  } else {
   return $rows;
  }
 }

 protected static function addOne(string $table, string $columns, string $values, array $data): void
 {
  $sql = 'INSERT INTO ' . $table . ' ( ' . $columns . ' ) VALUES (' . $values . ')';
  $query = self::conn()->prepare($sql);
  $types = str_repeat('s', count($data));
  $bindParams = array_merge([$types], array_values($data));
  $query->bind_param(...$bindParams);

  $query->execute();
 }

 protected static function updateOne(string $table, array $newData, string $condition, int $uniq): void
 {
  $sets = '';
  foreach ($newData as $key => $value) {
   $sets .= "$key = :$key, ";
  }
  $sets = substr($sets, 0, -1);

  $sql = "UPDATE $table SET $sets WHERE $condition = :$condition";
  $query = self::conn()->prepare($sql);

  foreach ($newData as $key => $value) {
   $query->bind_param(":$key", $value);
  }

  $query->bind_param(":$condition", $uniq);
  $query->execute();
 }

 protected static function deleteOne(string $table, string $column, string $value)
 {
  $sql = "DELETE FROM " . $table . " WHERE " . $column . " = ?";
  $query = self::conn()->prepare($sql);
  $query->execute([$value]);
 }

 protected static function count(string $table, string $colName, string $condition = '', string $value = '')
 {
  $sql = "SELECT COUNT(*) AS " . $colName . " FROM " . $table;
  if (!empty($condition) && !empty($value)) {
   $sql .= " WHERE " . $condition;
  }

  $query = self::conn()->prepare($sql);
  $query->execute();
  $result = $query->get_result();
  return $result->fetch_all(MYSQLI_ASSOC);

 }

}

?>