<?php

//initialize session if it hasn't already been
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function generateNewQuestionBank(){
  unset($_SESSION['question_bank']);
  $_SESSION["question_bank"] = [];
  $_SESSION["score"] = 0;

  // Loop for required number of questions
  for ($i=1; $i<=10; $i++){
    generateRandomQuestion($i);
  }

}

// Generate random questions
//q stands for question
//a stands for answer, where a1 is the correct one
function generateRandomQuestion($i){

  // Get random numbers to add
  $q1 = rand(10,90);
  $q2 = rand(10,90);

  // Calculate correct answer
  $a1 = $q1+$q2;
  $a2 = generateWrongAnswer($a1);

  // Make sure the two are unique answers
  do{
    $a3 = generateWrongAnswer($a1);
  } while ($a2 == $a3);

// Add question and answer to questions array
  $_SESSION["question_bank"][$i] = [
    "question" => "$q1 + $q2",
    "answers" => [$a1,$a2,$a3]
  ];
}

// Get incorrect answers within 10 numbers either way of correct answer

function generateWrongAnswer($a1){
  do{
    $deviation = rand(-10,10);
  } while ($deviation == 0);
  return $a1 + $deviation;
}
