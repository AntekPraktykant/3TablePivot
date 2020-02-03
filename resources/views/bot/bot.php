<?php
//print_r('php://input');

//file_put_contents('fb.txt', $challenge . $mode . $token);
file_put_contents('fb.txt', $json);
file_put_contents('fb-get.txt', $getImploded);
file_put_contents('fb-post.txt', $postImploded);

echo $challenge;
//echo $dupa;
//dd($request);