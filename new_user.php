<?php
    include 'db/mydbclass.php';
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        session_unset();
        session_destroy(); 
    }elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && array_key_exists('nick', $_POST)){
            $_SESSION['nick'] = $_POST['nick'];
            // echo $_POST['nick']."<br>";
            $user_exist = $db->selectALL("SELECT id FROM users WHERE nick = '".$_POST['nick']."'");
            // print_r($user_exist);
            // print_r($user_exist);
            if(!$user_exist){
                // echo "<br> doesn't exist <br>";
                if ($db->run_query("INSERT INTO users (nick) VALUES ('".$_POST['nick']."')")){
                    // echo "INSERT";
                    // print_r($db->max_id("SELECT MAX(id) AS max_id FROM users"));
                    $_SESSION['user_id'] = $db->max_id("SELECT MAX(id) AS max_id FROM users");
                    // echo $_SESSION['user'];
                }
            }else {
                // echo "<br>exist user number<br>";
                $_SESSION['user_id']= $user_exist[0]['id'];
            }
            $db->run_query("INSERT INTO tests (id) VALUES (NULL)");
            $_SESSION['test_id'] = $db->max_id("SELECT MAX(id) AS max_id FROM tests");
            echo $_SESSION['test_id'];
            $db->run_query("INSERT INTO user_tests (user_id, test_id) VALUES ('".$_SESSION['user_id']."', '".$_SESSION['test_id']."')");
            $questions=$db->selectALL("SELECT id FROM questions_list ORDER BY RAND() LIMIT 30");
            // echo "before quest<br>";
            // print_r($questions);
            // echo "<br>after quest<br>";
            $_SESSION['questions']= array();
            foreach ($questions as $id => $question) {
                $_SESSION['questions'][] = $question['id'];
                $db->run_query("INSERT INTO tests_question_list (test_id, questions_list_id, question_number) VALUES ('".$_SESSION['user_id']."', '".$question['id']."', '".($id+1)."')");
            }
            // print_r($_SESSION['questions']);
            header('Location: quiz.php');
    }   
    // echo $_SESSION['user'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>NICKNAME</title>
</head>
<body>
    <header>
        <ul>
            <li>
                <a href="index.php">
                    TORNA ALLA HOME
                </a>
            </li>
        </ul>
    </header>
    <div>
        <form action="new_user.php" method="post">
            <label for="nick">Scegli il tuo Nikname</label>
            <input type="text" name="nick" id="nick" required>
            <input type="submit" value="Inizia!">
        </form>
    </div>
</body>
</html>