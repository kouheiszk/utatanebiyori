<?php

class UploaderFormatter
{
  function dispsize($size = 0){
    if($size >= 1024*1024*1024*100){
      $dispsize = sprintf("%dGB",$size/1024/1024/1024);
    }elseif($size >= 1024*1024*1024*10){
      $dispsize = sprintf("%.1fGB",$size/1024/1024/1024);
    }elseif($size > 1024*1024*1024){
      $dispsize = sprintf("%.2fGB",$size/1024/1024/1024);
    }elseif($size >= 1024*1024*100){
      $dispsize = sprintf("%dMB",$size/1024/1024);
    }elseif($size > 1024*1024){
      $dispsize = sprintf("%.1fMB",$size/1024/1024);
    }elseif($size > 1024){
      $dispsize = sprintf("%dKB",$size/1024);
    }else{
      $dispsize = sprintf("%dB",$size);
    }
    return $dispsize;
  }
}