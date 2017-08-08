<h1>フォローされてる人</h1>
<h2><?php echo "{$name}さん"; ?></h2>

<p>
  <?php echo "ユーザー:{$user["username"]}さん"; ?>
</p>

<?php
 echo "<hr>";

 for ($i=0; $i < count($data); $i++) {
   $user_info = $data[$i]['User'];
   $tweet_info = $data[$i]['Post'];

   echo "名前&nbsp;:&nbsp;{$this->Html->link($user_info['name'],array('action'=>'userpage','?'=>array('id'=>$user_info['id'],'name'=>$user_info['name'])))}&nbsp;&nbsp;&nbsp;&nbsp;";
   echo "@{$user_info['username']}&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>";
   echo "{$tweet_info['body']}&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>";
   echo "@{$tweet_info['created']}&nbsp;&nbsp;&nbsp;&nbsp;<br/><hr>";
 }

 echo "<br/><br/>";
 echo $this->Paginator->prev('<<前へ',array());
 echo $this->Paginator->next('>>次へ',array());
 ?>
