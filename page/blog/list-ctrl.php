<?php

$headTemplate = new HeadTemplate('Blog list | Cooking Paleo', 'Blog listing');

$dao = new BlogDao();


$sql = 'SELECT u.id as user_id, u.first_name, u.last_name, '
        . 'b.id, b.title, b.description, b.content FROM blogs b, users '
        . 'u WHERE u.id = b.user_id AND b.status != "deleted";';
$blogs = $dao->find($sql);
 
if(!isset($_SESSION['email'])) { 
    Utils::redirect('login', array('module' => 'auth')); 
}
  
