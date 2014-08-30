<?php
Rhaco::import("io.model.Image");
/**
 * 画像のリサイズ等を行う拡張
 */
class ImageEx extends Image{
    /**
     * 画像が指定サイズより大きい場合にリサイズを行う
     *
     * @param int $x
     * @param int $y
     * @return object Image
     */
    function fitin($x,$y){
        $this->fitWidth($x);
        $this->fitHeight($y);
        return $this;
    }

    /*
     * 画像のサイズを取得
     */
    function getXLength($l){
      if($l < $this->width){
        return $l;
      } else {
        return $this->width;
      }
    }
    function getYLength($l){
      if($l < $this->height){
        return $l;
      } else {
        return $this->height;
      }
    }

    /**
     * 画像の横が指定サイズより大きい場合にリサイズを行う
     *
     * @param int $x
     * @return object Image
     */
    function fitWidth($x){
        if($x < $this->width) $this->resizeWidth($x, false);
        return $this;
    }

    /**
     * 画像の縦が指定サイズより大きい場合にリサイズを行う
     *
     * @param int $y
     * @return object Image
     */
    function fitHeight($y){
        if($y < $this->height) $this->resizeHeight($y, false);
        return $this;
    }
}
?>
