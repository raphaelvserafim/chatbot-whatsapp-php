<?php

namespace Cachesistemas\ChatbotWhatsappPhp;

use NLTK\NLTK;

use Rasa\Rasa;


class Bot
{
    public $wpp_server;
    public $wpp_key;


    public function NLTK()
    {

        $nltk = new NLTK();
        $text = "Barack Obama was born in Hawaii and was the 44th President of the United States.";
        $entities = $nltk->ner()->extract($text);
        print_r($entities);
    }

    public function Rasa()
    {

        $rasa = new Rasa();
        $text = "I am looking for a cheap hotel in Paris";
        $intents = $rasa->nlu()->parse($text);
        print_r($intents);
    }
}
