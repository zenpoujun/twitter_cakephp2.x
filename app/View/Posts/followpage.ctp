<h1>フォローしている人</h1>
<p>
  <?php
   echo "ユーザー: {$user['name']}さん";
   ?>
</p>

<?php
  echo "<hr>";

  for ($i=0; $i < count($data); $i++) {
    $user_info = $data[$i]['User'];
    $tweet_info = $data[$i]['Post'];

   echo "名前&nbsp;&nbsp;{$this->Html->link($user_info['name'],array('action'=>'userpage','?'=>array('id'=>$user_info['id'],'name'=>$user_info['name'])))}&nbsp;&nbsp;&nbsp;&nbsp;";
   echo "@{$user_info['username']}&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>";
   echo "{$tweet_info['body']}&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>";
   echo "{$tweet_info['created']}&nbsp;&nbsp;&nbsp;&nbsp;<br/>";
   echo $this->Form->create('Follow',array('url'=>array('controller'=>'follows','action'=>'user_unfollow')));
   echo $this->Form->hidden('user_id',array('value'=>$user['id']));
   echo $this->Form->hidden('follow_id',array('value'=>$user_info['id']));
   echo $this->Form->submit('unfollow');
   echo $this->Form->end();
   echo "<hr>";
  }

  echo "<br/><br/>";
  echo $this->paginator->prev('<<前へ',array());
  echo $this->paginator->next('>>次へ',array());

 ?>
