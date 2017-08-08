<h1>ユーザーページ</h1>
<?php
 echo "ユーザー: {$user['name']}さん<br/><hr>";
 echo "{$name}さんのページ<br/>";
 echo "フォロー数&nbsp;&nbsp;:&nbsp;&nbsp;",$this->Html->link($follow,array('action'=>'user_followpage','?'=>array('id'=>$id,'name'=>$name)))."<br/>";
 echo "フォロワー数&nbsp;&nbsp;:&nbsp;&nbsp;",$this->Html->link($follower,array('action'=>'user_followerpage','?'=>array('id'=>$id,'name'=>$name)))."<br/>";
 echo "ツイート数&nbsp;&nbsp;:&nbsp;&nbsp;",$this->Html->link($tweet,array('action'=>'user_tweet','?'=>array('id'=>$id,'name'=>$name)))."<br/>";
 echo "<hr>";

 for ($i=0; $i < count($data); $i++) {
   $user_info = $data[$i]['User'];
   $tweet_info = $data[$i]['Post'];

   echo "名前&nbsp;:&nbsp;{$user_info['name']}&nbsp;&nbsp;&nbsp;&nbsp;";
   echo "@{$user_info['username']}&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>";
   echo "{$tweet_info['body']}&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>";
   echo "@{$tweet_info['created']}&nbsp;&nbsp;&nbsp;&nbsp;<br/><hr>";

 }

 echo "<br/><br/>";
 echo $this->Paginator->prev('<<前へ',array());
 echo $this->Paginator->next('>>次へ',array());
 ?>
