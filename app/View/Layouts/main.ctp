<!DOCTYPE html>
<html>
  <head>
    <?php echo $this->Html->charset(); ?>
    <title><?php echo $title_for_layout; ?> / ログインするだけのサイト</title>
    <?php echo $this->Html->css('main'); ?>
  </head>
  <body>
  <div id="container">
    <div id="header">
      <div id="header_menu">
        <?php
          if(isset($user)):
            echo $this->Html->link('ホーム/ ', '/posts/index');
            echo $this->Html->link('マイページ/ ','/posts/mypage');
            echo $this->Html->link('友達検索/ ', '/posts/search');
            echo $this->Html->link('ログアウト', '/users/logout',array('class'=>'bottun'),'ログアウトします。よろしいですか?');
          else:
            echo $this->Html->link('ホーム/ ', '/users/home');
            echo $this->Html->link('ユーザー登録/ ', '/users/register');
            echo $this->Html->link('ログイン', '/users/login');
          endif;
        ?>
      </div>
      <div id="header_logo">
        <?php
        if (isset($user)) {
          echo $this->Html->link($this->Html->image('twitter.jpg',array('width'=>'225','height'=>'120')),array('controller'=>'posts','action'=>'index'),array('escape'=>false));
        } else {
          echo $this->Html->link($this->Html->image('twitter.jpg',array('width'=>'225','height'=>'120')),array('controller'=>'users','action'=>'home'),array('escape'=>false));
        }
        ?>
      </div>
      <div id="content">
        <?php echo $this->fetch('content'); ?>
      </div>
    </div>
  </body>
</html>
