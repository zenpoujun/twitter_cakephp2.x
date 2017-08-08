<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

  //読み込むコンポーネントの指定
  public $components = array('Session', 'Auth');

  //どのアクションが呼ばれてもはじめに実行される関数
  public function beforeFilter()
  {
    parent::beforeFilter();

    //未ログインでアクセスできるアクションを指定
    //これ以外のアクションへのアクセスはloginにリダイレクトされる規約になっている
    $this->Auth->allow('home','register', 'login', 'logout','complete','userout');
  }

  //ログイン後にリダイレクトされるアクション
  public function index(){
    $this->set('user', $this->Auth->user());
  }

  // ホーム画面
  public function home(){}


  // 新規登録の処理
  public function register(){
    if(!empty($this->data)){
      if($this->data){
        $this->User->create();
        if($this->User->save($this->data) == false){
          $this->render('register');
        } else {
          $this->User->save($this->data);
          $data = $this->data;
          $this->redirect(array('action'=>'complete',$data['User']['name']));
        }
      }
    }
  }

  // 登録完了の処理
  public function complete($param = null){
    $name = $this->User->find('all',array(
      'condition' => array(
        'User.name' => $param
      )
    ));
    $name = $name[0]['User'];
    $this->set('name',$name);
  }

  // ログイン処理
  public function login(){
    if($this->request->is('post')) {
      if($this->Auth->login())
        return $this->redirect('index');
      else
        $this->Session->setFlash('ユーザー名またはパスワードが間違っています。');
    }
  }

  // ログアウトの処理
  public function logout(){
    $this->Auth->logout();
    $this->redirect('userout');
  }

  // ログアウトした後の画面
  public function userout(){}


}
