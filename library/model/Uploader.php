<?php
Rhaco::import("model.table.UploaderTable");
Rhaco::import("text.RandomString");

/**
 * Uploader
 */
class Uploader extends UploaderTable{
  /**
   * 挿入前の処理
   */
  function beforeInsert(&$db){
    if(ExceptionTrigger::invalid()) return false;
    if(RequestLogin::isLoginSession()){
      $users = RequestLogin::getLoginSession();
    }
    $request = new Request();
    if($request->isFile('file')){
      $upload_file = $request->getFile('file');
      $this->size = $upload_file->size;
      $max_file_size = $request->getVariable('MAX_FILE_SIZE');
      if($this->size > $max_file_size) return ExceptionTrigger::raise(new GenericException('アップロードファイルサイズの上限は '.$max_file_size.' バイトです。'));
      $this->mime = mime_content_type($upload_file->tmp);
      $extension = strtolower($upload_file->extension);
      $this->host = $_SERVER["REMOTE_ADDR"];

      $db_upload = new DbUtil(Uploader::connection());
      $last_upload = $db_upload->get(new Uploader(), new C(Q::orderDesc(Uploader::columnId()), Q::eq(Uploader::columnDeleteFlag(), 0)));
      if($last_upload->host == $this->host){
        if($last_upload->createdAt > time() - Rhaco::constant('UPLOAD_INTERVAL')) return ExceptionTrigger::raise(new GenericException('同一ホストからのアップロードは '.Rhaco::constant('UPLOAD_INTERVAL').' 秒の間隔を開けて行ってください。'));
      }

      $id = $last_upload->id + 1;

      $this->fileName  = sprintf("up%05d", $id). $extension;

      $unique_id = RandomString::ascii(32);

      $this->downloadPath = $this->fileName. "_". $unique_id. "/". $this->fileName;

      if(empty($this->userId)) $this->userId = Rhaco::constant('GUEST_USER_ID');

      if(!FileUtil::isDir(Rhaco::resource('uploader/'). $this->fileName. "_". $unique_id)){
        FileUtil::mkdir(Rhaco::resource('uploader/'). $this->fileName. "_". $unique_id,777);
      }
      //ディレクトリのパーミッション
      if(!$upload_file->generate(Rhaco::resource('uploader/'). $this->downloadPath)){
        return false;
      }
    }
    return true;
  }

  function afterInsert(&$db){
    $this->getId();
    return true;
  }

  function _genFileId($length = 32){
    return RandomString::ascii($length);
  }

  /**
   * 一覧表示処理の表示項目
   */
  function views(){
    return array(
      "list_display"=>"file_name,comment,mime,size,download_count,created_at",
      "ordering"=>"-CreatedAt"
    );
  }
}

?>