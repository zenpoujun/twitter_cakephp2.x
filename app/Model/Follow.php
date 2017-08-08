<?php

 class Follow extends AppModel {

   public $name = 'Follow';

// postsテーブルをusersテーブルに属させる処理
   public $belongsTo = array(
     "User" => array(
       'className' => 'User',
       'foreignKey' => 'user_id'
     )
   );
 }
