<?php

session_start();
$_SESSION['invalidInput']=false;

//return array of [length, 0,0] or [0, posts needed, rails needed]
function userDecision($length, $posts, $rails) {
    if ($length>0) {
        return [$length,0,0];
        $_SESSION['invalidInput']=false;
    } elseif ($posts>0 && $rails>0){
        return [0,$posts,$rails];
        $_SESSION['invalidInput']=false;
    } else{
        header('Location: landingPage.php');
        $_SESSION['invalidInput']=true;
    }
}

//input from userDecision
//return array of [posts,rails,length, rails over,0] or [posts,rails,length ,0, posts over]
function postRailsDeclared ($arr1) {
    $posts=$arr1[1];
    $rails=$arr1[2];
    if($posts-1<$rails) {
        return [$posts,$rails,(($posts-1*1.6)+0.1),($rails-($posts-1)),0];
    } else {
        return[$posts,$rails,(($rails*1.6)+0.1),0,(($posts-1)-$rails)];
    }
}

//input from userdecision
//returns array of [rails, posts, fence length,length over,requested length]
function lengthDeclared (array $length) {
    $x = ceil(($length[0]-0.1)/1.6);
    $fenceLen = ($x*1.6)+0.1;
    $over = $fenceLen-$length[0];
    $arr= [$x, $x+1, $fenceLen, $over, $length[0]];
    return $arr;
}

function answer($decision,$response) {
    if ($decision[0]>1) {
        return nl2br("You requested a fence of $response[4] meters.\n 
        With $response[1] posts and  $response[0] rails you get a fence of 
        $response[2] meters with an overshoot of $response[3] meters.");
    } else {
        return nl2br( "You provided $response[0] posts and $response[1] rails.\n
        With the provided materials, you can build a fence of $response[2] meters\n
        with an overshoot of $response[3] rails and $response[4] posts.");
    }

}





function play(){
    $decision = userDecision($_GET['length'], $_GET['posts'], $_GET['rails']);

    $response = [];

    if ($decision[0]>0) {
         $response= lengthDeclared($decision);
    } else {
        $response = postRailsDeclared($decision);
        }

    return answer($decision,$response);
}


echo play();

?>

<a href="landingPage.php">Return</a>
