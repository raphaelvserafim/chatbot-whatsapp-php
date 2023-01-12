<?php

namespace Cachesistemas\ChatbotWhatsappPhp;

use Cachesistemas\ChatbotWhatsappPhp\Send;


class Flow
{


    public function stage($stageID)
    {
        $send = new Send();
        
        switch ($stageID) {
            case 1:
                $this->welcomeMessage();
                break;

            default:
                $send->whatsApp([["type" => "text", "message" => "Etapa não encontrada"]]);
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
