<?php

namespace Core;

class Session
{
  public static function has($key, $value)
  {
    return (bool) static::get($key);
  }

  public static function put($key, $value)
  {
    $_SESSION[$key] = $value;
  }

  public static function get($key, $default = null)
  {
    // look under _flash key first, then fall back to the top key
    if (isset($_SESSION['_flash'][$key])) {
      return $_SESSION['_flash'][$key];
    }
    return $_SESSION[$key] ?? $default;
  }

  public static function flash($key, $value)
  {
    $_SESSION['_flash'][$key] = $value;
  }

  public static function unflash()
  {
    unset($_SESSION['_flash']);
  }

  public static function flush()
  {
    $_SESSION = []; // clear out the super global
  }

  public static function destroy()
  {
    static::flush();
    session_destroy(); // destroy the session file

    // delete the cookie
    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain']);
  }
}
