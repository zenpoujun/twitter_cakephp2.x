<?php

class Post extends AppModel {

  public $name = 'Post';

  //postsテーブルをusersテーブルに所属させる処理
    public $belongsTo = array(
       "User" => array(
         'className' => 'User',
         'foreignKey' => 'user_id'
       )
     );
}
