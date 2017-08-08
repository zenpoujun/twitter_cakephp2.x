<h1>マイツイート</h1>
<?php
 echo "ユーザー: {$user['name']}さん<br/><hr>";

 for ($i=0; $i < count($data); $i++) {
   $user_info = $data[$i]['User'];
   $tweet_info = $data[$i]['Post'];

   echo "名前&nbsp;:&nbsp;{$user_info['name']}&nbsp;&nbsp;&nbsp;&nbsp;";
   echo "@{$user_info['username']}&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>";
   echo "{$tweet_info['body']}&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>";
   echo "@{$tweet_info['created']}&nbsp;&nbsp;&nbsp;&nbsp;<br/>";
   echo "{$this->Html->link('削除',array('action'=>'user_tweet_delete','?'=>array('id'=>$tweet_info['id'])),array('class'=>'bottun'),'ツイートを削除します。よろしいですか?')}";
   echo "<hr>";

 }

 echo "<br/><br/>";
 echo $this->Paginator->prev('<<前へ',array());
 echo $this->Paginator->next('>>次へ',array());
 ?>
