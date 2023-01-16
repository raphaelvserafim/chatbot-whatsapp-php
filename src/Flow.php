<?php

namespace Cachesistemas\ChatbotWhatsappPhp;

use Cachesistemas\ChatbotWhatsappPhp\Send;
use Cachesistemas\ChatbotWhatsappPhp\Model;

class Flow
{

    public $send;
    public $model;

    public $text;
    public $option;

    public function __construct($data)
    {
        $this->send  = new Send();
        $this->model = new Model();

        $this->model->phone     = $data["id"];
        $this->send->phone      = $this->model->phone;

        $this->send->key        = $data["token_key"];
        
        $this->send->wpp_server = 'https://server.api-wa.me';

        $this->send->network    = $data["network"];

        $this->model->network   = $this->send->network;


        $check                  = $this->model->checkService();

        if (sizeof($check["data"]) == 0) {
            $start =  $this->model->startService();
            if ($start["status"]) {
                $check  = $this->model->checkService();
                if (sizeof($check["data"]) >  0) {
                    $check                  = $check["data"][0];
                    $this->model->serviceID = $check->id;
                    $this->model->startStep();
                    $this->stage(1);
                }
            }
        } else {
            $check                  = $check["data"][0];
            $this->model->serviceID = $check->id;
            $stage                  = $this->model->stage();
            $this->stage($stage["data"][0]->stage);
        }
    }




    // etapas 
    public function stage($stageID)
    {

        switch ($stageID) {

            case 1:
                $this->send->Message($this->welcomeMessage());

                $this->model->changeStage(2);
                break;


            case 2:
                $this->send->Message($this->justTest());
                $this->model->endService();
                break;


            default:
                $this->send->Message([["type" => "text", "message" => "Etapa não encontrada"]]);
                $this->model->endService();
                break;
        }
    }


    public function welcomeMessage()
    {

        $msg = [];
        array_push($msg, ["type" => "text", "message" => "Olá seja bem vindo(a)"]);
        return $msg;
    }


    public function justTest()
    {
        $msg = [];
        array_push($msg, ["type" => "text", "message" => "Isso é apenas um teste vou encerrar a conversa"]);
        return $msg;
    }
}
