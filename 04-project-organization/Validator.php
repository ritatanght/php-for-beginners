<?php

class Validator
{
  // make sure the string is within the min and max range
  public static function string($value, $min = 1, $max = INF)
  {
    $value = trim($value);
    return strlen($value) >= $min && strlen($value) <= $max;
  }

  // make sure the passed in string is in a valid email format
  public static function email($value)
  {
    filter_var($value, FILTER_VALIDATE_EMAIL);
  }
}
