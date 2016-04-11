<?php
  $domain = "stella-mail.tumblr.com";
  $api_key = "U1wdls4IR1s1Mf7poc8ZyuB9fg6cBNvslscZ8LWaU7DRkJ3wNq";
  $responses = file_get_contents("http://api.tumblr.com/v2/blog/{$domain}/posts?api_key={$api_key}");
  $responses = json_decode($responses);
  //var_dump($responses);
  foreach ($responses->response->posts as $key => $value){
    echo "<p><a href=\"{$responses->response->posts[$key]->post_url}\">{$responses->response->posts[$key]->title}</a></p>";
  }
?>