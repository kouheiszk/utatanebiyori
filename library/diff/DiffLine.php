<?php

class DiffLine
{
  var $text;
  var $status;

  function DiffLine($text)
  {
    $this->text   = $text . "\n";
    $this->status = array();
  }

  function compare($obj)
  {
    return $this->text == $obj->text;
  }

  function set($key, $status)
  {
    $this->status[$key] = $status;
  }

  function get($key)
  {
    return isset($this->status[$key]) ? $this->status[$key] : '';
  }

  function merge($obj)
  {
    $this->status += $obj->status;
  }

  function text()
  {
    return $this->text;
  }
}
?>