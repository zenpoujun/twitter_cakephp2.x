<?php

class FollowsController extends AppController {

  // モデル
  public $uses = array('User','Post','Follow');
  // 認証コンポーネント
  public $components = array('Session','Auth');


  // フォロー機能
  public function follow(){
    if(!empty($this->data)){
      $this->Follow->save($this->data);
    }
    $this->redirect('/posts/search');
  }


  // フォロー外し機能
  public function unfollow(){
    if(!empty($this->data)){
      $this->Follow->deleteAll(array(
        'Follow.user_id' => $this->data['Follow']['user_id'],
        'Follow.follow_id' => $this->data['Follow']['follow_id']
      ));
    }
    $this->redirect('/posts/search');
  }


  // ホームでのフォロー外し機能
  public function home_unfollow(){
    if(!empty($this->data)){
      $this->Follow->deleteAll(array(
        'Follow.user_id' => $this->data['Follow']['user_id'],
        'Follow.follow_id' => $this->data['Follow']['follow_id']
      ));
    }
    $this->redirect('/posts/');
  }


  // フォローページでのフォロー外し機能
  public function user_unfollow(){
    if(!empty($this->data)){
      $this->Follow->deleteAll(array(
        'Follow.user_id' => $this->data['Follow']['user_id'],
        'Follow.follow_id' => $this->data['Follow']['follow_id']
      ));
    }
    $this->redirect('/posts/followpage');
  }

}
