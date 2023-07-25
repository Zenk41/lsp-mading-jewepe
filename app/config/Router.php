<?php

namespace app\config;

class Router
{

 public static function delete($route, $callback)
 {
  if (strcasecmp($_SERVER['REQUEST_METHOD'], 'DELETE') !== 0) {
   return;
  }

  self::on($route, $callback);
 }
 // Route get type
 public static function get($route, $callback)
 {
  if (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !== 0) {
   return;
  }

  self::on($route, $callback);
 }

 // Route post type
 public static function post($route, $callback)
 {
  if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0) {
   return;
  }

  self::on($route, $callback);
 }

 public static function on($regex, $callback)
 {
  $urlParts = parse_url($_SERVER['REQUEST_URI']);
  $path = $urlParts['path'];
  $query = isset($urlParts['query']) ? $urlParts['query'] : '';

  $params = ($path !== null) ? rtrim($path, '/') : '/';
  $is_match = preg_match('~' . $regex . '~', $params, $matches);

  if ($is_match) {
   array_shift($matches);

   $request = new Request($matches, $query);
   $callback($request);
  }
 }

}