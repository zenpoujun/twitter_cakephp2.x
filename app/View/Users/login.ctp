<h1>ログイン</h1>
<?php
  echo $this->Session->flash();
  echo $this->Form->create('User',array('url'=>array('action'=>'login')));
  echo $this->Form->input('username',array('label' => 'ユーザー名: ','placeholder' => 'username'));
  echo $this->Form->input('password',array('label' => 'パスワード: ','placeholder' => 'password'));
  echo $this->Form->end('Logun!');
 ?>
