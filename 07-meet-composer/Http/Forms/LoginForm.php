<?php


namespace Http\Forms;

use Core\Validator;
use Core\ValidationException;

class LoginForm
{
  protected $errors = [];

  // when you instantiate a form, you immediately validate it an populate the errors
  public function __construct(public array $attributes) // this is how to declare the param as variable followed with type
  {
    if (Validator::email($this->attributes['email'])) {
      $this->errors['email'] = 'Please provide a valid email address.';
    }

    if (!Validator::string($this->attributes['password'])) {
      $this->errors['password'] = 'Please provide a valid password.';
    }
  }

  public static function validate($attributes)
  {
    $instance = new static($attributes);

    return $instance->failed() ? $instance->throw() : $instance;
  }

  public function throw()
  {
    ValidationException::throw($this->errors(), $this->attributes);
  }

  public function failed()
  {
    return count($this->errors);
  }

  public function errors()
  {
    return $this->errors;
  }

  public function error($field, $message)
  {
    $this->errors[$field] = $message;
    return $this;
  }
}
