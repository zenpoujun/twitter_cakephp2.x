<h1>新規登録</h1>
<?php
 echo $this->Form->create('User',array('url'=>array('action'=>'register')));
 // name
 echo $this->Form->input('User.name',array('error'=>false,'placeholder'=>'nameを入力してください。','label'=>'名前: '));
 echo $this->Form->error('User.name').'<br/>';

 // username
 echo $this->Form->input('User.username',array('error'=>false,'placeholder'=>'usernameを入力してください。','label'=>'ユーザー名: '));
 echo $this->Form->error('User.username').'<br/>';

 // password
 echo $this->Form->input('User.password',array('error'=>false,'placeholder'=>'passwordを入力してください。','label'=>'パスワード: '));
 echo $this->Form->error('User.password').'<br/>';

 // password2
 echo $this->Form->input('User.password2',array('error'=>false,'placeholder'=>'password2を入力してください。','label'=>'パスワード(確認): '));
 echo $this->Form->error('User.password2').'<br/>';

 // email
 echo $this->Form->input('User.email',array('error'=>false,'placeholder'=>'emailを入力してください。','label'=>'メールアドレス: '));
 echo $this->Form->error('User.email').'<br/>';

 echo $this->Form->submit("登録");
 echo $this->Form->end();
 ?>
