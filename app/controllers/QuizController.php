<?php

class QuizController extends BaseController {

    
    /*
    |--------------------------------------------------
    | Display a new question in an active quizz
    |--------------------------------------------------
    */

    public function getQuiz() {

        if (!Session::has('quizz_active')) {
            $this->generateQuizz();
        } else {

            return View::make('quizz.quizz', array(
                                            'questions' => Session::get('questions'),
                                            'questions_idx' => Session::get('questions_idx'),
                                            'number_of_questions' => Session::get('number_of_questions'),
                                            'capitals' => Session::get('capitals'), 
                                            'all_capitals' => Session::get('all_capitals'), 
                                            'randomizer' => Session::get('randomizer'),
                                            'randomizer_250' => Session::get('randomizer_250'),
                                            'q_index' => Session::get('q_index')
                                                ));
        }
    }

    /*
    |--------------------------------------------------
    | Generate new quiz
    |--------------------------------------------------
    */

    public function generateQuiz($number_of_questions) {

        // Set the maximum questions allowable on the quizz and display error page if exceeded
        $max_questions = 200;
        if ($number_of_questions > $max_questions) {
            return View::make('quizz.quizz-sorry', array('max' => $max_questions))
                ->with('title', 'Quizz Size Error | '); 
        } 

        // Random number list to generate a list of questions
        $random_list = range(1,249);
        shuffle($random_list);

        $all_capitals_temp = Country::where('id', '>=', 0)->select('capital')->get();
        
        $countries = array();
        $capitals_temp = array();
        $questions = array();       // key value pairs e.g. 'Poland' => 'Warsaw'
        $questions_idx = array();   // array of arrays e.g. 0 => array (0 => 'Poland' 1 => 'Warsaw')
        $questions_temp = array();
        $q_index = 0;

        // Random number list to use on the display page (for generating wrong answers in every question)
        $randomizer_250 = range(1,248);
        shuffle($randomizer_250);

        // Put all capitals in the database in an array
        $all_capitals = array();
        foreach ($all_capitals_temp as $index => $capital) {
            $all_capitals[$index] = $all_capitals_temp[$index]['capital'];
        }

        // Generate a list of random questions / answers
        for ($i = 0; $i < $number_of_questions; $i++) {
            $question = Country::where('id', '=', $random_list[$i])->select('countryName', 'capital')->get();
            $capital = Country::where('id', '=', $random_list[$i])->select('capital')->get();
            $questions_temp[] = $question;
            $capitals_temp[] = $capital;
        }

        // put capital / country pairs in arrays to avoid passing objects to session.
        foreach ($questions_temp as $index => $question) {
            $questions[$questions_temp[$index][0]['countryName']] = $questions_temp[$index][0]['capital'];
            $questions_idx[$index] = [$questions_temp[$index][0]['countryName'], $questions_temp[$index][0]['capital']]; 
        }

        // add data to the session
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
        Session::put('number_of_questions', $number_of_questions);
        Session::save();
        
        // render view
        return View::make('quizz.quizz-new', array(
                                            'questions' => Session::get('questions'),
                                            'questions_idx' => Session::get('questions_idx'),
                                            'number_of_questions' => Session::get('number_of_questions'),
                                            'capitals' => Session::get('capitals'), 
                                            'all_capitals' => Session::get('all_capitals'), 
                                            'randomizer' => Session::get('randomizer'),
                                            'randomizer_250' => Session::get('randomizer_250'),
                                            'q_index' => Session::get('q_index'),
                                            'title' => $number_of_questions . ' Questions Quizz | '
                                            ));    
        }

    /*
    |--------------------------------------------------
    | Post quiz answer questions and display feedback
    |--------------------------------------------------
    */

    public function postQuiz() {

        $validator = Validator::make(Input::all(), 
            array(
                'question' => 'required'
            )
        );

        if($validator->fails()) {
            return View::make('quizz.quizz', array(
                                            'questions' => Session::get('questions'),
                                            'questions_idx' => Session::get('questions_idx'),
                                            'number_of_questions' => Session::get('number_of_questions'),
                                            'capitals' => Session::get('capitals'), 
                                            'all_capitals' => Session::get('all_capitals'), 
                                            'randomizer' => Session::get('randomizer'),
                                            'randomizer_250' => Session::get('randomizer_250'),
                                            'q_index' => Session::get('q_index')
                                                ))->withErrors($validator);
        } else {

            // Check if the answer was posted.
            if(isset($_POST['question'])) {
                $questions_idx = Session::get('questions_idx');
                $q_index = Session::get('q_index');
                $number_of_questions = Session::get('number_of_questions');
                
                if ($q_index > $number_of_questions - 1) {
                    $q_index = $number_of_questions - 1;
                }

                $question = $questions_idx[$q_index][1];
                $capital = $questions_idx[$q_index][0];
                $answer = trim($_POST['question']);

            }

            $answered_questions = Session::get('answered_questions');
            $correct_answers = Session::get('correct_answers');
            $number_of_questions = Session::get('number_of_questions');
            $feedback = '';

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

            // Return a view with the feedback and next question button

            // if question index > than number of questions
            if ($q_index >= sizeof(Session::get('questions_idx'))) {
                    
                    // Quiz is now inactive
                    Session::put('quizz_active', 0);
                    $q_index = sizeof(Session::get('questions_idx')) - 1;

                    // If user logged in - save quiz results
                    if(Auth::check()) {
                        $id = Auth::user()->getId();
                        $correct_answers = Session::get('correct_answers');
                        $num_questions = Session::get('number_of_questions');
                        $score = ($correct_answers / $num_questions) * 100;
                        $quiz_type = Session::get('number_of_questions');

                        // Save quiz record in the database
                        $quiz_record = History::create(array(
                            'userid'            => $id,
                            'correct_answers'   => $correct_answers,
                            'num_questions'     => $num_questions,
                            'quiz_type'         => $quiz_type,
                            'score'             => $score
                        ));
                    }

                    // Display quiz finish summary
                    return View::make('quizz.quizz-finished', array(
                                                'questions' => Session::get('questions'),
                                                'questions_idx' => Session::get('questions_idx'),
                                                'number_of_questions' => Session::get('number_of_questions'),
                                                'q_index' => Session::get('q_index'),
                                                'feedback' => Session::get('feedback'),
                                                'answered_questions' => Session::get('answered_questions'),
                                                'correct_answers' => Session::get('correct_answers')
                                                )); 

            // if quiz is still active, display the feedback page with next question button
            } else { 

                    // generate Flickr photographs for the feedback page
                    $flickering = App::make('flickering');
                    $flickering->handshake('ade52786b574ca2ddbf8b58a0ce7299b', '25654303463a1f1e');
                    $search_query = $question . " " . $capital;

                    $results = Flickering::callMethod('photos.search', array(
                                                                            'text' => $search_query,
                                                                            'tags' => $capital, 
                                                                            'extras' => 'url_m',
                                                                            'orientation' => 'landscape', 
                                                                            'sort' => 'relevance'
                                                                            ));
                    $photos = $results->getResults('photo');
                    $photo_size = sizeof($photos);

                    $question_idx = Session::get('questions_idx');
                    $q_index = Session::get('q_index');
                    $current_country = $question_idx[$q_index - 1][0];
                    $country = Country::where('countryName', '=', $current_country)->get();

                    // in case there is less than 10 photographs returned from Flickr
                    if ($photo_size > 10) {
                        $photo_index = 10;
                    } else {
                        $photo_index = $photo_size;
                    }

                    // put data in the session
                    Session::put('photos', $photos);
                    Session::put('photo_index', $photo_index);
                    Session::put('country', $country);

                    // render view         
                    return View::make('quizz.quizz-feedback', array(
                                                'country' => Session::get('country'),
                                                'questions' => Session::get('questions'),
                                                'questions_idx' => Session::get('questions_idx'),
                                                'number_of_questions' => Session::get('number_of_questions'),
                                                'capitals' => Session::get('capitals'), 
                                                'all_capitals' => Session::get('all_capitals'), 
                                                'randomizer' => Session::get('randomizer'),
                                                'randomizer_250' => Session::get('randomizer_250'),
                                                'q_index' => Session::get('q_index'),
                                                'feedback' => Session::get('feedback'),
                                                'photos' => Session::get('photos'),
                                                'photo_index' => Session::get('photo_index'),
                                                'title' => Session::get('number_of_questions') . ' Questions Quizz | '
                                                )); 
           
            }
        }
    }

    /*
    |--------------------------------------------------
    | Display history of the quizzes taken by the user
    |--------------------------------------------------
    */

    public function getQuizzHistory() {

        if(Auth::check()) {
            $id = Auth::user()->getId();
            $quizz_history = History::where('userid', '=', $id)->get();

            $total_answered = 0;
            $total_correct = 0;

            // determine numbers of answered questions
            foreach ($quizz_history as $idx=>$quizz) {
                $total_answered += $quizz->num_questions;
                $total_correct += $quizz->correct_answers;
            }

            // calculate average score
            $average_score = ($total_correct / $total_answered) * 100;

            // render view
            return View::make('quizz.quizz-history', array(
                                        'quizz_history' => $quizz_history,
                                        'total_answered' => $total_answered,
                                        'total_correct' => $total_correct,
                                        'average_score' => $average_score,
                                        'title' => 'Quizz History | '
                                        ));
        }
    }
}
