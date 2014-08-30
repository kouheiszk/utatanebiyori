<?php
Rhaco::import("model.table.WikisTable");
Rhaco::import("text.WikiCode");
Rhaco::import("model.WikisBackup");
Rhaco::import("network.http.Request");
Rhaco::import('network.mail.Mail');
Rhaco::import('diff.Diff');

/**
 *
 */
class Wikis extends WikisTable{

  var $difftext, $original_name, $original_text;

  /**
   * 編集前の処理
   */
  function beforeUpdate(&$db){
    $request = new Request();
    $this->original_name = $request->getVariable('original_name');
    $this->original_text = $request->getVariable('original_text');
    if($this->original_text == $this->text && $this->original_name == $this->wikiName){
      Header::redirect(Rhaco::url('wiki/'. $this->wikiName));
    }
    if(ExceptionTrigger::invalid()) return false;
    $this->updatedAt = time();//date('Y-m-d\TH:i:s\J');
    if($this->userId == "") $this->userId = Rhaco::constant('GUEST_USER_ID');
    return true;
  }
  /**
   * 編集後の処理
   */
  function afterUpdate(&$db){
    $this->diff_text = Diff::doDiff($this->original_text, $this->text);
    $wikis_backup = new WikisBackup();
    $wikis_backup->setWikiId($this->id);
    $wikis_backup->setWikiName($this->original_name);
    $wikis_backup->setText($this->diff_text);
    $wikis_backup->save();
    // メールを送る
    $mail  = new Mail(Rhaco::constant('SITE_MAIL_ADDRESS'), Rhaco::constant('SITE_NAME'));
    $mail->to(Rhaco::constant('WIKI_BACKUP_MAIL_ADDRESS'));
    $mail->subject('UPDATE:'. $this->original_name);
    $mail->message($this->diff_text);
    $mail->send();
    return true;
  }
  /**
   * 新規作成前の処理
   */
  function beforeInsert(&$db){
    if(ExceptionTrigger::invalid()) return false;
    $this->createdAt = time();
    if($this->userId == "") $this->userId = Rhaco::constant('GUEST_USER_ID');
    return true;
  }
  /**
   * 新規作成後の処理
   */
  function afterInsert(&$db){
    // メールを送る
    $mail  = new Mail(Rhaco::constant('SITE_MAIL_ADDRESS'), Rhaco::constant('SITE_NAME'));
    $mail->to(Rhaco::constant('WIKI_BACKUP_MAIL_ADDRESS'));
    $mail->subject('NEW:'. $this->wikiName);
    $mail->message($this->text);
    $mail->send();
    return true;
  }
  /**
   * 一覧表示処理の表示項目
   */
  function views(){
    return array(
      "list_display"=>"wikiName,updatedAt"
    );
  }

  /**
   * wiki_name_link 仮想列の HTML 表現
   *
   * @return string
   */
  function toStringUrl(){
    return Rhaco::url("wiki/".$this->getWikiName());
  }

  /**
   * wiki_name_link 仮想列の HTML 表現
   *
   * @return string
   */
  function toStringWikiNameLink(){
    return sprintf('<a href="%s">%s</a>',$this->toStringUrl(),$this->getWikiName());
  }
}

?>