<h1>今何してる?</h1><?php echo "ユーザー: {$user['username']}さん"; ?>
<?php
 echo "<br/><br/>";
 echo $this->Form->create('Post',array('url'=>array('action'=>'addRecord')));
 echo $this->Form->hidden('Post.user_id',array('value'=>$user['id']));
 echo $this->Form->textarea('Post.body',array('placeholder'=>'140文字以内で入力'));
 echo $this->Form->submit("ツイート");
 echo $this->Form->end();
 echo "<br/><hr>";
 ?>

 <!-- ツイート表示 -->

 <?php

  for ($i=0; $i < count($data); $i++) {
    $user_info = $data[$i]['User'];
    $tweet_info = $data[$i]['Post'];


    // 自分自身かどうかの判別
    $myself = true;
    if($user_info['username'] == $user['username']){
      $myself = false;
    }


    if($myself){
      // 自分自身ではないなら削除ボタンなし
      echo "名前&nbsp;:&nbsp;{$this->Html->link($user_info['name'],array('action'=>'userpage','?'=>array('id'=>$user_info['id'],'name'=>$user_info['name'])))}&nbsp;&nbsp;&nbsp;&nbsp;";
      echo "@{$user_info['username']}&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>";
      echo "{$tweet_info['body']}&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>";
      echo "{$tweet_info['created']}&nbsp;&nbsp;&nbsp;&nbsp;<br/>";
      echo $this->Form->create('Follow',array('url'=>array('controller'=>'follows','action'=>'home_unfollow')));
      echo $this->Form->hidden('user_id',array('value'=>$user['id']));
      echo $this->Form->hidden('follow_id',array('value'=>$user_info['id']));
      echo $this->Form->submit('unfollow');
      echo $this->Form->end();
      echo "<hr>";
    }else {
      // 自分自身なら削除ボタンあり
      echo "名前&nbsp;:&nbsp;{$user_info['name']}&nbsp;&nbsp;&nbsp;&nbsp;";
      echo "@{$user_info['username']}&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>";
      echo "{$tweet_info['body']}&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>";
      echo "{$tweet_info['created']}&nbsp;&nbsp;&nbsp;&nbsp;<br/>";
      echo "{$this->Html->link('削除',array('action'=>'tweet_delete','?'=>array('id'=>$tweet_info['id'])),array('class'=>'bottun'),'ツイートを削除します。よろしいですか?')}";
      echo "<hr>";
    }
  }

  echo "<br/><br/>";
  echo $this->paginator->prev('<<前へ',array());
  echo $this->paginator->next('>>次へ',array());
  ?>
