<?php

namespace Cachesistemas\ChatbotWhatsappPhp;

/*
use NLTK\NLTK;
use Rasa\Rasa;
use SentimentAnalysis\SentimentAnalysis;

*/

use Cachesistemas\ChatbotWhatsappPhp\Flow;

class Bot
{

    public function __construct()
    {
        $data       = file_get_contents('php://input');


        $this->createLog('php-input', $data);

        if (isset($data)) {
            $data   = json_decode($data, true);
        }
    }



    public function createLog($name, $logs)
    {
        $fp = fopen($name . '.json', "a+");
        fwrite($fp, "\n\n\n\n" . json_encode($logs) . "\n\n\n");
        fclose($fp);
    }

    /*
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

    public  function Sentiment()
    {
        $text       = "I love this product";
        $sentiment  = new SentimentAnalysis();
        $result     = $sentiment->categorise($text);

        print_r($result);
    }

    */
}
