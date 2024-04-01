<?php

namespace Core;

class Authenticator
{
  public function login($user)
  {
    $_SESSION['user'] = [
      'email' => $user['email']
    ];

    session_regenerate_id(true);
  }

  public function logout()
  {
    $_SESSION = []; // clear out the super global
    session_destroy(); // destroy the session file

    // delete the cookie
    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain']);
  }
}
