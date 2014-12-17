<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class History extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /**
     * Fillable table fields
     */
    protected $fillable = array('user_id', 'userid', 'start_time', 'finish_time', 'correct_answers', 'num_questions', 'score', 'quiz_type', 'time', 'time_per_question');

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'history';


}
