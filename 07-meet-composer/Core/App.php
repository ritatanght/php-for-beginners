<?php

namespace Core;

class App
{
  protected static $container;

  // when this method is call, the container object is passed in and saved it as $container
  public static function setContainer($container)
  {
    static::$container = $container;
  }

  public static function container()
  {
    return static::$container;
  }

  public static function bind($key, $resolver)
  {
    static::container()->bind($key, $resolver);
  }

  public static function resolve($key)
  {
    return static::container()->resolve($key);
  }
}
