<?php

namespace App\Bot;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class MediaUploadConversation extends Conversation
{

    protected $firstname;

    protected $email;

    public function askFirstname()
    {
        $this->ask('Hello! What is your firstname?', function(Answer $answer) {
            // Save result
            $this->firstname = $answer->getText();

            $this->say('Nice to meet you '.$this->firstname);
            $this->askEmail();
        });
    }

    public function askEmail()
    {
        $this->ask('One more thing - what is your email?', function(Answer $answer) {
            // Save result
            $this->email = $answer->getText();

            $this->say('Great - that is all we need, '.$this->firstname);
        });
    }
    public function askForDatabase()
    {
        $question = Question::create('Do you need a database?')
            ->fallback('Unable to create a new database')
            ->callbackId('create_database')
            ->addButtons([
                             Button::create('Add Description')->value('description'),
                             Button::create('Add Location')->value('location'),
                         ]);

//        $this->ask($question, function (Answer $answer) {
//            // Detect if button was clicked:
//            if ($answer->isInteractiveMessageReply()) {
//                $selectedValue = $answer->getValue(); // will be either 'yes' or 'no'
//                $selectedText = $answer->getText(); // will be either 'Of course' or 'Hell no!'
//                $this->say($selectedValue);
//                $this->askForLocation('Please tell me your location.', function (Location $location) {
//                    // $location is a Location object with the latitude / longitude.
//                });
//            }
//        });
    }

    public function run()
    {
        // This will be called immediately
        $this->askForDatabase();
    }
}
