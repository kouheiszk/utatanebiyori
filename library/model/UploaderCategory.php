<?php
Rhaco::import("model.table.UploaderCategoryTable");
/**
 * Uploader Category
 */
class UploaderCategory extends UploaderCategoryTable{
  function getCategoryList(){
    $model = new UploaderCategory();
    return $this->dbUtil->select($model);
  }
}

?>