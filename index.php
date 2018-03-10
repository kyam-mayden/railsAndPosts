<h1> Posts and Rails exercise</h1>

<?php
session_start();
$_SESSION['invalidInput'] = false;

/**
 * turns user input into array, returns to landing.php if wrong input type
 * @param $length float user input of fence length
 * @param $posts int user input of posts needed
 * @param $rails int user input of rails needed
 * @return array of [length, 0,0] or [0, posts needed, rails needed]
 */
function userDecision ($length, $posts, $rails): array {
    if ($length>0 && is_numeric($length)) {
        return [$length,0,0];
        $_SESSION['invalidInput'] = false;
    } elseif ($posts>0 && $rails>0 && is_numeric($posts) && is_numeric($rails)) {
        return [0.0,floor($posts),floor ($rails)];
        $_SESSION['invalidInput'] = false;
    } else{
        header('Location: landingPage.php');
        $_SESSION['invalidInput'] = true;
    }
}

/**
 * calculates posts, rails into a fence
 * @param array $arr1 response from userDecision
 * @return array of [posts,rails,length, rails over, posts over]
 */
function postRailsDeclared (array $arr1): array {
    $posts = $arr1[1];
    $rails = $arr1[2];
    if ($posts-1<$rails) {
        return [$posts,$rails,(($posts-1*1.6)+0.1),($rails-($posts-1)),0];
    } else {
        return [$posts,$rails,(($rails*1.6)+0.1),0,(($posts-1)-$rails)];
    }
}

/**
 * calculates fence length from desired length
 * @param array $length response from userDecision
 * @return array of [rails, posts, fence length,length over,requested length]
 */
function lengthDeclared (array $length): array {
    $x = ceil(($length[0]-0.1)/1.6);
    $fenceLen = ($x*1.6)+0.1;
    $over = number_format($fenceLen-$length[0],1);
    $arr= [$x, $x+1, $fenceLen, $over, $length[0]];
    return $arr;
}


/**
 * Returns an answer dependent on user inputs
 * @param array $decision If input is Length or Posts & Rails
 * @param array $response calculations from input
 * @return string final response to page
 */
function answer(array $decision, array $response): string {
    if ($decision[0]>1) {
        return nl2br("You requested a fence of $response[4] meters.\n 
        With $response[1] posts and  $response[0] rails you get a fence of 
        $response[2] meters with an overshoot of $response[3] meters.\n\n");
    } else {
        return nl2br( "You provided $response[0] posts and $response[1] rails.\n
        With the provided materials, you can build a fence of $response[2] meters\n
        with an overshoot of $response[3] rails and $response[4] posts.\n\n");
    }
}

/**Takes no inputs, runs functions to take input & generate output.
 *
 * @return string containing user decision and answer.
 */
function play () {
    $decision = userDecision($_GET['length'], $_GET['posts'], $_GET['rails']);
    $response = [];

    if ($decision[0]>0) {
         $response = lengthDeclared($decision);
    } else {
        $response = postRailsDeclared($decision);
        }
    return answer($decision, $response);
}

echo play();

?>

<a href="landingPage.php">Return</a>
