<?php

namespace Cachesistemas\ChatbotWhatsappPhp;

use Cachesistemas\ChatbotWhatsappPhp\Send;
use Cachesistemas\ChatbotWhatsappPhp\Model;

class Flow
{

    public $send;
    public $model;

    public function __construct($data)
    {
        $this->send  = new Send();
        $this->model = new Model();

        $this->model->phone = $data["id"];

        $check              = $this->model->checkService();

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
        }
    }


    public function stage($stageID)
    {

        switch ($stageID) {

            case 1:
                $this->send->Message($this->welcomeMessage(), ['whatsapp', 'telegram']);

                $this->model->changeStage(2);
                break;


            case 2:

                break;


            default:
                $this->send->Message([["type" => "text", "message" => "Etapa não encontrada"]], ['whatsapp', 'telegram']);
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
