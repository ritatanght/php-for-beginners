<?php

namespace Core;

class Authenticator
{
  public function attempt($email, $password)
  {
    $user = App::resolve('Core\Database')->query('select * from users where email = :email', [
      'email' => $email
    ])->find();

    if ($user) {
      // match password
      if (password_verify($password, $user['password'])) {
        $this->login(['email' => $email]);
        return true;
      }
    } else {
      return false;
    }
  }

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
