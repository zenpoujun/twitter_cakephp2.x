<?php

class PostsController extends AppController {

  // モデル
  public $uses = array('User','Post','Follow');
  // 認証コンポーネント
  public $components = array('Session','Auth');

  // ページネーション
  public $paginate = array(
    'User' => array(
    'page' => 1,
    'limit' => 10,
    'sort' => 'created',
    'direction' => 'desc',
    'recursive' => 0
    ),
  'Post' => array(
  'page' => 1,
  'limit' => 10,
  'sort' => 'created',
  'direction' => 'desc',
  'recursive' => 0
    )
  );


  // ホーム
  public function index(){
    $this->set('user', $this->Auth->user());

    $conditions = array('conditions'=>array('Follow.user_id'=>$this->Auth->user('id')));

    // 自分がフォローしている人たちのidを取得
    $follow = $this->Follow->find('all',$conditions);

    // 自分のidを取得
    $id = array($this->Auth->user('id'));

    for ($i=0; $i < count($follow); $i++) {
      $num = $follow[$i]['Follow'];
      // 自分のidとフォローしている人のidを配列にまとめる
      array_push($id,$num['follow_id']);
    }

    $conditions = array('Post.user_id'=>$id);
    $data = $this->paginate('Post',$conditions);
    $this->set('data',h($data));
  }


  // ツイート機能
  public function addRecord(){
    if(!empty($this->data)){
      $this->Post->save($this->data);
    }
    $this->redirect('index');
  }


  // ホームからのツイート削除機能
  public function tweet_delete(){
    $id = $this->request->query['id'];
    if(!empty($id)){
      $conditions = array('Post.id'=>$id);
      $this->Post->delete($conditions);
    }
    $this->redirect('index');
  }


  // マイページ処理
  public function mypage(){
    $this->set("user",$this->Auth->user());

    // フォロー数カウント
    $conditions = array('conditions'=>array('Follow.user_id'=>$this->Auth->user('id')));
    $follow = $this->Follow->find('count',$conditions);
    $this->set('follow',$follow);

    // フォロワー数カウント
    $conditions = array('conditions'=>array('Follow.follow_id'=>$this->Auth->user('id')));
    $follower = $this->Follow->find('count',$conditions);
    $this->set('follower',$follower);

    // ツイート数のカウント
    $conditions = array('conditions'=>array('Post.user_id'=>$this->Auth->user('id')));
    $tweet = $this->Post->find('count',$conditions);
    $this->set('tweet',$tweet);

    // ツイートデータの詳細
    $conditions = array('user_id'=>$this->Auth->user('id'));
    $data = $this->paginate('Post',$conditions);
    $this->set('data',h($data));
  }


  // マイページからのツイート削除機能
  public function mytweet_delete(){
    $id = $this->request->query['id'];
    if(!empty($id)){
      $conditions = array('Post.id'=>$id);
      $this->Post->delete($conditions);
    }
    $this->redirect('mypage');
  }


  // フォローしている人の詳細ページ
  public function followpage(){
    $this->set('user',$this->Auth->user());

    $conditions = array('conditions'=>array('Follow.user_id'=>$this->Auth->user('id')));
    $data = $this->Follow->find('all',$conditions);

    // id取得のために空の配列を用意
    $followid = array();

    //  ツイート情報を取得のために空の配列を用意
    $follow_tweet = array();
    // 最新ツイート情報取得のための条件
    $condition = array('Post.created <' => date('Y-m-d H:i:s'));
    $order = array("Post.created DESC");

    for ($i=0; $i < count($data); $i++) {
      $follow = $data[$i]['Follow'];
      // followidにフォローしている人のidを入れる
      array_push($followid,$follow['follow_id']);
      // 最新情報取得のための処理
      $conditions = array('conditions'=>array('Post.user_id'=>$followid[$i],$condition),'order'=>$order);
      $user_tweet = $this->Post->find('first',$conditions);
      array_push($follow_tweet,$user_tweet['Post']['id']);
    }
    //フォローしている人の名前などの情報を取得
    $tweets = $this->paginate('Post',array('Post.id'=>$follow_tweet));
    $this->set('data',h($tweets));

  }


  // フォロワーの詳細ページ
  public function followerpage(){
    $this->set('user',$this->Auth->user());

    $conditions = array('conditions'=>array('Follow.follow_id'=>$this->Auth->user('id')));
    $data = $this->Follow->find('all',$conditions);

    // id取得のために空の配列を用意
    $followid = array();

    //  ツイート情報を取得のために空の配列を用意
    $follow_tweet = array();
    // 最新ツイート情報取得のための条件
    $condition = array('Post.created <' => date('Y-m-d H:i:s'));
    $order = array("Post.created DESC");

    for ($i=0; $i < count($data); $i++) {
      $follow = $data[$i]['Follow'];
      // followidにフォロワーのidを入れる
      array_push($followid,$follow['user_id']);
      // 最新情報取得のための処理
      $conditions = array('conditions'=>array('Post.user_id'=>$followid[$i],$condition),'order'=>$order);
      $user_tweet = $this->Post->find('first',$conditions);
      array_push($follow_tweet,$user_tweet['Post']['id']);
    }

    //フォロワー名前などの情報を取得
    $tweets = $this->paginate('Post',array('Post.id'=>$follow_tweet));
    $this->set('data',h($tweets));

  }


  // ツイートの詳細ページ
  public function tweet(){
    $this->set('user',$this->Auth->user());
    $conditions = array('Post.user_id'=>$this->Auth->user('id'));
    $data = $this->paginate('Post',$conditions);
    $this->set('data',h($data));
  }


  // ツイートページでのツイート削除
  public function user_tweet_delete(){
    $id = $this->request->query['id'];
    if(!empty($id)){
      $conditions = array('Post.id'=>$id);
      $this->Post->delete($conditions);
    }
    $this->redirect('tweet');
  }


  // ユーザーページ
  public function userpage(){
    $this->set('user',$this->Auth->user());

    // ユーザーのパラメータを受け取る
    $id = $this->request->query['id'];
    $name = $this->request->query['name'];

    $this->set('id',h($id));
    $this->set('name',h($name));

    // フォロー数のカウント
    $conditions = array('conditions'=>array('Follow.user_id'=>$id));
    $follow = $this->Follow->find('count',$conditions);
    $this->set('follow',$follow);

    // フォロワー数のカウント
    $conditions = array('conditions'=>array('Follow.follow_id'=>$id));
    $follower = $this->Follow->find('count',$conditions);
    $this->set('follower',$follower);

    // ツイート数のカウント
    $conditions = array('conditions'=>array('Post.user_id'=>$id));
    $tweet = $this->Post->find('count',$conditions);
    $this->set('tweet',$tweet);

    // ユーザーツイートの取得
    $conditions = array('Post.user_id'=>$id);
    $data = $this->paginate('Post',$conditions);
    $this->set('data',h($data));
  }


  // ユーザーのフォローページ
  public function user_followpage(){
    $this->set('user',$this->Auth->user());

    $id = $this->request->query['id'];
    $name = $this->request->query['name'];
    $this->set('name',h($name));

    $conditions = array('conditions'=>array('Follow.user_id'=>$id));
    $data = $this->Follow->find('all',$conditions);

    // id取得のために空の配列を用意
    $followid = array();

    //  ツイート情報を取得のために空の配列を用意
    $follow_tweet = array();
    // 最新ツイート情報取得のための条件
    $condition = array('Post.created <' => date('Y-m-d H:i:s'));
    $order = array("Post.created DESC");

    for ($i=0; $i < count($data); $i++) {
      $follow = $data[$i]['Follow'];
      // followidにフォローしている人のidを入れる
      array_push($followid,$follow['follow_id']);
      // 最新情報取得のための処理
      $conditions = array('conditions'=>array('Post.user_id'=>$followid[$i],$condition),'order'=>$order);
      $user_tweet = $this->Post->find('first',$conditions);
      array_push($follow_tweet,$user_tweet['Post']['id']);
    }
    //フォローしている人の名前などの情報を取得
    $tweets = $this->paginate('Post',array('Post.id'=>$follow_tweet));
    $this->set('data',h($tweets));
  }


  // ユーザーのフォロワーページ
  public function user_followerpage(){
    $this->set('user',$this->Auth->user());

    $id = $this->request->query['id'];
    $name = $this->request->query['name'];
    $this->set('name',h($name));

    $conditions = array('conditions'=>array('Follow.follow_id'=>$id));
    $data = $this->Follow->find('all',$conditions);

    // id取得のために空の配列を用意
    $followid = array();

    //  ツイート情報を取得のために空の配列を用意
    $follow_tweet = array();
    // 最新ツイート情報取得のための条件
    $condition = array('Post.created <' => date('Y-m-d H:i:s'));
    $order = array("Post.created DESC");

    for ($i=0; $i < count($data); $i++) {
      $follow = $data[$i]['Follow'];
      // followidにフォロワーのidを入れる
      array_push($followid,$follow['user_id']);
      // 最新情報取得のための処理
      $conditions = array('conditions'=>array('Post.user_id'=>$followid[$i],$condition),'order'=>$order);
      $user_tweet = $this->Post->find('first',$conditions);
      array_push($follow_tweet,$user_tweet['Post']['id']);
    }

    //フォロワー名前などの情報を取得
    $tweets = $this->paginate('Post',array('Post.id'=>$follow_tweet));
    $this->set('data',h($tweets));

  }


  // ユーザーツイートページ
  public function user_tweet(){
    $this->set('user',$this->Auth->user());

    $id = $this->request->query['id'];
    $name = $this->request->query['name'];
    $this->set('name',h($name));

    $conditions = array('Post.user_id'=>$id);
    $data = $this->paginate('Post',$conditions);
    $this->set('data',h($data));
  }


  // 友達検索機能
  public function search($page = null,$sort = null, $direction = null){
    $this->set('user',$this->Auth->user());

    //検索ボタンを押した時
    if(!empty($this->data)){
      // フォームの値を取得
      $content = $this->data['Post']['username'];

      // 検索条件
      $conditions = array('OR' => array('User.name like' => "%{$this->data['Post']['username']}%", 'User.username like' => "%{$this->data['Post']['username']}%"));

    //  古いセッションを破棄
    if($this->Session->check('conditions'))
      $this->Session->delete('conditions');

    if($this->Session->check('content'))
      $this->Session->delete('content');

    // 新しいセッションの書き込み
    $this->Session->write('conditions',$conditions);
    $this->Session->write('content',$content);

    //viewに渡す
    $data = $this->paginate('Post',$conditions);
    $this->set("data",h($data));
  }else {
    if($this->Session->check('conditions')){
      // パラメータが無ければ新しくページに来た
      if(empty($this->params['named']['page']) && empty($this->params['named']['sort']) && empty($this->params['named']['direction'])){

        $this->Session->delete('conditions');
        $this->Session->delete('content');
      }else {
        // ページ移動の時の処理
        $conditions = $this->Session->read('conditions');
        $content = $this->Session->read('content');

        $data = $this->paginate('Post',$conditions);
        $this->set('data',h($data));
        $this->set('content',h($content));
        }
      }
    }

    $follow_id = $this->Follow->find('all',array('conditions'=>array('user_id'=>$this->Auth->user())));
    $this->set('follow_id',h($follow_id));
  }
  // 友達検索機能終了

}
