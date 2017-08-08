<?php
App::uses('AppModel', 'Model');

class User extends AppModel {

  //入力チェック機能
  public $validate = array(

    // name
    'name' => array(
      array(
        'rule' => 'notBlank',
        'message' => 'nameを入力してください。'
      ),
      array(
        'rule' => array('between', 4, 20), //4～20文字
        'message' => '名前は4文字以上20文字以内にしてください。'
      )
    ),

    // username
    'username' => array(
      array(
        'rule' => 'notBlank',
        'message' => 'usernameを入力してください。'
      ),
      array(
        'rule' => 'isUnique', //重複禁止
        'message' => '既に使用されている名前です。'
      ),
      array(
        'rule' => 'alphaNumeric', //半角英数字のみ
        'message' => '名前は半角英数字にしてください。'
      ),
      array(
        'rule' => array('between', 4, 20), //4～20文字
        'message' => '名前は2文字以上32文字以内にしてください。'
      )
    ),

    // password
    'password' => array(
      array(
        'rule' => 'notBlank',
        'message' => 'passwordを入力してください。'
      ),
      array(
        'rule' => 'alphaNumeric',
        'message' => 'パスワードは半角英数字にしてください。'
      ),
      array(
        'rule' => array('between', 4, 20),
        'message' => 'パスワードは8文字以上32文字以内にしてください。'
      )
    ),

    // password2
    'password2' => array(
      array(
        'rule' => 'notBlank',
        'message' => 'password2を入力してください。'
      ),
      array(
        'rule' => 'passwordConfirm',
        'message' => 'パスワードが一致していません。'
      )
    ),

    // email
    'email' => array(
      array(
        'rule' => 'notBlank',
        'message' => 'nameを入力してください。'
      ),
       array(
          'rule' => array('email',false),
          'require' => true,
          'message' => 'メールアドレスを入力してください。'
      )
    )
  );

  public function beforeSave($options = array()) {
    $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
    return true;
  }

  // パスワードの一致の処理
  public function passwordConfirm($check){

        //２つのパスワードフィールドが一致する事を確認する
        if($this->data['User']['password'] === $this->data['User']['password2']){
            return true;
        }else{
            return false;
        }

    }

}
