<h1>友達を見つけて、フォローしましょう!</h1>
<?php
  echo "ユーザー: {$user["name"]} さん";
  echo "<br/>";
  echo "誰を検索しますか?";

  // フォームに値を残しておくための処理
  if(!empty($content)){
    $name = $content;
  } else {
    $name = "";
  }


  echo $this->Form->create(false,array('type'=>'post','url'=>array('action'=>'search')));
  echo "ユーザー名や名前で検索!";
  echo $this->Form->input("Post.username",array('label' => '名前: ','placeholder' => '名前またはユーザー名','default' => $name));
  echo $this->Form->submit('検索');
  echo $this->Form->end();
  echo "<br/><hr><br/>";

  if(!empty($data)){
    for($i=0; $i<count($data); $i++){
      $user_info = $data[$i]['User'];
      $tweet = $data[$i]['Post'];

      echo "名前&nbsp;:&nbsp;{$this->Html->link($user_info['name'],array('action'=>'userpage','?' => array('id' => $user_info['id'],'name' => $user_info['name'])))}&nbsp;&nbsp;&nbsp;&nbsp;";
      echo "@{$user_info['username']}&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>";
      echo "コメント&nbsp;:&nbsp;{$tweet['body']}&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>";
      echo "{$tweet['created']}&nbsp;&nbsp;&nbsp;&nbsp;<br>";

      // 自分自身かどうかの判別
      $myself = true;
      if($user_info['username'] == $user['username']){
      // 自分自身ならスルー
      $myself = false;
       }

      //  フォロー者かどうかの判別
      $follow = false;
      foreach ($follow_id as $check) {
        if($user_info['id'] == $check['Follow']['follow_id']){
          $follow = true;
        }
      }

      // フォローボタン
      if($myself){
        if($follow){
          echo $this->Form->create('Follow',array('url'=>array('controller'=>'follows','action'=>'unfollow')));
          echo $this->Form->hidden('user_id',array('value'=>$user['id']));
          echo $this->Form->hidden('follow_id',array('value'=>$user_info['id']));
          echo $this->Form->submit('unfollow');
          echo $this->Form->end();
        }else {
          echo $this->Form->create('Follow',array('url'=>array('controller'=>'follows','action'=>'follow')));
          echo $this->Form->hidden('user_id',array('value'=>$user['id']));
          echo $this->Form->hidden('follow_id',array('value'=>$user_info['id']));
          echo $this->Form->submit('follow');
          echo $this->Form->end();
        }
      }
      echo "<hr>";
    }
  }

  echo "<br/><br/>";
  echo $this->Paginator->prev('<<前へ',array());
  echo $this->Paginator->next('>>次へ',array());
 ?>
