<h1>マイページ</h1>

<?php
 echo "ユーザー: {$user['name']}さん<br/>";
 echo "フォロー数&nbsp;:&nbsp;".$this->Html->link($follow,array('action'=>'followpage'))."<br/>";
 echo "フォロワー数&nbsp;:&nbsp;".$this->Html->link($follower,array('action'=>'followerpage'))."<br/>";
 echo "ツイート数&nbsp;:&nbsp;".$this->Html->link($tweet,array('action'=>'tweet'))."<br/>";
 echo "<hr>";

 for ($i=0; $i < count($data); $i++) {
   $user_info = $data[$i]['User'];
   $tweet_info = $data[$i]['Post'];

  echo "名前&nbsp;:&nbsp;{$user_info['name']}&nbsp;&nbsp;&nbsp;&nbsp;";
  echo "@{$user_info['username']}&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>";
  echo "{$tweet_info['body']}&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>";
  echo "{$tweet_info['created']}&nbsp;&nbsp;&nbsp;&nbsp;<br/>";
  echo "{$this->Html->link('削除',array('action'=>'mytweet_delete','?'=>array('id'=>$tweet_info['id'])),array('class'=>'bottun'),'ツイートを削除します。よろしいですか?')}";
  echo "<hr>";
 }

 echo "<br/><br/>";
 echo $this->paginator->prev('<<前へ',array());
 echo $this->paginator->next('>>次へ',array());
 ?>
