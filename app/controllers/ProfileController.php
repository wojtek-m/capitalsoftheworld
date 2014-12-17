<?php

class ProfileController extends BaseController {

    public function user($username) {
        $user = User::where('username', '=', $username);

        if($user->count()) {
            $user = $user->first();

            $id = $user->id;

            $quizz_history = History::where('userid', '=', $id)->get();

            $total_answered = 0;
            $total_correct = 0;

            foreach ($quizz_history as $idx=>$quizz) {
                $total_answered += $quizz->num_questions;
                $total_correct += $quizz->correct_answers;
            }

            $average_score = ($total_correct / $total_answered) * 100;

            return View::make('profile.user', array(
                                        'total_answered' => $total_answered,
                                        'total_correct' => $total_correct,
                                        'average_score' => $average_score
                                        ))->with('user', $user)
                                          ->with('title', $user->username . ' | ');
        }

        return App::abort(404);
    }
}