<?php

class QuizzController extends BaseController {

    public function getQuizz() {

        // !!!! Need to figure out how to store the quizz data permamently in the session and not generate 
        // a new set of questions when answering the question.
        if (!Session::has('quizz_active')) {
            $this->generateQuizz();
        } else {

        echo "Quizz active:";
        var_dump(Session::get('quizz_active'));
        echo "Correct answers:";
        var_dump(Session::get('correct_answers'));
        echo "Answered questions:";
        var_dump(Session::get('answered_questions'));
         //   var_dump(Session::get('questions'));
          //  var_dump(Session::get('q_index'));
        /*
            $randomizer = Session::get('randomizer');
            $answered_questions = Session::get('answered_questions');
            $correct_answers = Session::get('correct_answers');
            $questions = Session::get('questions');
            $all_capitals = Session::get('all_capitals');
            $quizz_active = Session::get('quizz_active');
            $q_index = Session::get('q_index');  

            $randomizer_250 = range(1,250);
            shuffle($randomizer_250);

            Session::put('randomizer', rand(1,3));
            Session::put('randomizer_250', $randomizer_250);
            Session::put('answered_questions', 0);
            Session::put('correct_answers', 0);
            Session::put('questions', $questions);
            Session::put('all_capitals', $all_capitals);
            Session::put('quizz_active', 1);
            Session::put('q_index', $q_index);  
        */
            return View::make('quizz.quizz', array(
                                            'questions' => Session::get('questions'),
                                            'questions_idx' => Session::get('questions_idx'),
                                            'capitals' => Session::get('capitals'), 
                                            'all_capitals' => Session::get('all_capitals'), 
                                            'randomizer' => Session::get('randomizer'),
                                            'randomizer_250' => Session::get('randomizer_250'),
                                            'q_index' => Session::get('q_index')
                                                ));
        }
    }

    public function generateQuizz() {
        
        $random_list = range(1,249);
        shuffle($random_list);

        $all_capitals_temp = Country::where('id', '>=', 0)->select('capital')->get();
        $countries = array();
        $capitals_temp = array();
        $questions = array();       // key value pairs e.g. 'Poland' => 'Warsaw'
        $questions_idx = array();   // array of arrays e.g. 0 => array (0 => 'Poland' 1 => 'Warsaw')
        $questions_temp = array();
        $q_index = 0;

        $randomizer_250 = range(1,249);
        shuffle($randomizer_250);

        // Put all capitals in the database in an array
        $all_capitals = array();
        foreach ($all_capitals_temp as $index => $capital) {
            $all_capitals[$index] = $all_capitals_temp[$index]['capital'];
        }

        //var_dump($all_capitals_temp[0]['capital']);
        //var_dump($all_capitals);
        //var_dump($randomizer_250);

        for ($i = 0; $i < 20; $i++) {
            $question = Country::where('id', '=', $random_list[$i])->select('countryName', 'capital')->get();
            $capital = Country::where('id', '=', $random_list[$i])->select('capital')->get();
            $questions_temp[] = $question;
            $capitals_temp[] = $capital;
        }

        // put capital / country pairs in arrays to avoid passing objects to session.
        foreach ($questions_temp as $index => $question) {
            $questions[$questions_temp[$index][0]['countryName']] = $questions_temp[$index][0]['capital'];
            $questions_idx[$index] = [$questions_temp[$index][0]['countryName'], $questions_temp[$index][0]['capital']]; 
            //echo $questions[$index][0]['countryName'];
            //echo $questions[$index][0]['capital'];
            //Session::put($questions[$index][0]['countryName'], $questions[$index][0]['capital']);
        }

        //var_dump($questions);
        //var_dump($questions_idx);
        //echo $questions_idx[0][1];
        //echo $questions[$questions_idx[0][0]];

        Session::put('randomizer', rand(1,5));
        Session::put('randomizer_250', $randomizer_250);
        Session::put('answered_questions', 0);
        Session::put('correct_answers', 0);
        Session::put('questions', $questions);
        Session::put('questions_idx', $questions_idx);
        Session::put('capitals', $capitals_temp);
        Session::put('all_capitals', $all_capitals);
        Session::put('quizz_active', 1);
        Session::put('q_index', $q_index);
        Session::save();
        
        return View::make('quizz.quizz-new', array(
                                            'questions' => Session::get('questions'),
                                            'questions_idx' => Session::get('questions_idx'),
                                            'capitals' => Session::get('capitals'), 
                                            'all_capitals' => Session::get('all_capitals'), 
                                            'randomizer' => Session::get('randomizer'),
                                            'randomizer_250' => Session::get('randomizer_250'),
                                            'q_index' => Session::get('q_index')
                                            )); 
 
    }


    public function postQuizz() {

        // Check if the answer was posted.
        if(isset($_POST['question'])) {
            $questions_idx = Session::get('questions_idx');
            $q_index = Session::get('q_index');
            $question = $questions_idx[$q_index][1];
            $answer = trim($_POST['question']);

            //var_dump($questions_idx);
            echo "Question index:";
            var_dump($q_index);
            echo "Question:";
            var_dump($question);
            echo "Answer:";
            var_dump($answer);

            if ($question == $answer) {
                echo "Success";
            } else {
                echo "Failure";
            }
        }

        //$q_index = Session::get('q_index');
        //$question = Session::get('questions'[$q_index]);
        $answered_questions = Session::get('answered_questions');
        $correct_answers = Session::get('correct_answers');

        //var_dump(Session::get('questions'[$q_index]));
        //var_dump(Session::get('questions'));
        //var_dump(Session::get('all_capitals'));

        // Update the index and questions, if the answer is correct update the correct answers.
        if ( $question == $answer) {
            $q_index += 1;
            $answered_questions += 1;
            $correct_answers += 1;
            $feedback = 'correct';
        } else {
            $q_index += 1;
            $answered_questions += 1;
            $feedback = 'incorrect';
        }

        // Keep the wrong answers random
        $randomizer_250 = range(1,249);
        shuffle($randomizer_250);

        // Push the updated data to SESSION.
        Session::put('answered_questions', $answered_questions );
        Session::put('correct_answers', $correct_answers);
        Session::put('q_index', $q_index);
        Session::put('feedback', $feedback);
        Session::put('randomizer_250', $randomizer_250);
        Session::put('randomizer', rand(1,5));

        echo "Size of question_idx is: ";
        var_dump(sizeof(Session::get('questions_idx')));
        //var_dump($q_index);

        // Return a view with the feedback and next question button
        
        if ($q_index - 1 >= sizeof(Session::get('questions_idx'))) {
                // Quiz is now inactive
                Session::put('quizz_active', 0);

                // Display quiz finish summary
                return View::make('quizz.quizz-finished', array(
                                            'questions' => Session::get('questions'),
                                            'questions_idx' => Session::get('questions_idx'),
                                            'q_index' => Session::get('q_index'),
                                            'feedback' => Session::get('feedback'),
                                            'answered_questions' => Session::get('answered_questions'),
                                            'correct_answers' => Session::get('correct_answers')
                                            )); 

        } else { 
                // Display feedback page with next question button         
                return View::make('quizz.quizz-feedback', array(
                                            'questions' => Session::get('questions'),
                                            'questions_idx' => Session::get('questions_idx'),
                                            'capitals' => Session::get('capitals'), 
                                            'all_capitals' => Session::get('all_capitals'), 
                                            'randomizer' => Session::get('randomizer'),
                                            'randomizer_250' => Session::get('randomizer_250'),
                                            'q_index' => Session::get('q_index'),
                                            'feedback' => Session::get('feedback')
                                            )); 

        
        }

        

    }

    /*
        1. Select a set number of countries randomly and add them to an array.
        2. Set session variables like number_of_questions and correct_answers to 0
        3. Generate the question on the screen as a radio button with 3 options:
            - one will be the capital of the selected country and other two will be random capitals off all countries.
            The format would be something like:
                What is the capitol of {{ country[1]->countryName }}:
                    1. {{ all_countries->select_random->capital }}
                    2. {{ all_countries->select_random->capital }}
                    3. {{ country[1]->capital }}
                * Need to make sure to select random number 1-3 to place the correct answer randomly.
                * Need to make sure no capital is displayed twice.
        4. Post the user selection and verify in the post method.
        5. Update the session variables accordingly and provide feedback/answer with continue/next button.
        6. Iterate through 3-5 for every country in the set number array.

    */

}
