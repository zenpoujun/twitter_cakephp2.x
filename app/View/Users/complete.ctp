<h1>Twitterへようこそ!</h1>
<?php echo $name['name']; ?>さんはtwitterへ参加されました。<br/>
ログインしてtwitterを始めましょう!
<?php
 echo $this->Form->create('User',array('url'=>array('action'=>'login')));
 echo $this->Form->submit("Login!");
 echo $this->Form->end();
 ?>
