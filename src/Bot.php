<?php

namespace Cachesistemas\ChatbotWhatsappPhp;

use NLTK\NLTK;
use Rasa\Rasa;
use SentimentAnalysis\SentimentAnalysis;

use Cachesistemas\ChatbotWhatsappPhp\DB;

class Bot extends DB
{
    public $wpp_server;
    public $wpp_key;
    public $phone;
    public $dateTimeNow;
    public $serviceID;
    public $stageID;


    public function __construct()
    {
        $this->dateTimeNow = date('Y-m-d H:i:s');
    }


    public function checkService()
    {
        return   DB::Select("SELECT * FROM tb_attendance WHERE phone  = '$this->phone' AND situation = 1 ");
    }

    public function startService()
    {
        return   DB::Query("INSERT INTO  tb_attendance SET  phone  = '$this->phone', situation = 1 ");
    }


    public function endService()
    {
        return   DB::Query("UPDATE tb_attendance SET situation = 0 WHERE phone  = '$this->phone' AND situation = 1 ");
    }


    public function stage()
    {
        return   DB::Select("SELECT * FROM tb_stage WHERE attendance  =  $this->serviceID  ");
    }


    public function startStep()
    {
        return   DB::Query("INSERT INTO  tb_stage SET  attendance  = $this->serviceID , stage = 1 ");
    }

    public function changeStage(int $stage)
    {
        return   DB::Query("UPDATE tb_stage SET  stage  = $stage  WHERE attendance  = $this->serviceID  ");
    }





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
}
