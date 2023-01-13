<?php

namespace Cachesistemas\ChatbotWhatsappPhp;

use Cachesistemas\ChatbotWhatsappPhp\Send;
use Cachesistemas\ChatbotWhatsappPhp\Model;

class Flow
{

    public $send;
    public $model;

    public function __construct($phone)
    {
        $this->send  = new Send();
        $this->model = new Model();

        $this->model->phone = $phone;
    }


    public function stage($stageID)
    {

        switch ($stageID) {
            case 1:
                $this->welcomeMessage();
                break;


            default:
                $this->send->whatsApp([["type" => "text", "message" => "Etapa não encontrada"]]);
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



    
}
