<?php

namespace Cachesistemas\ChatbotWhatsappPhp;

use Cachesistemas\ClassePhpApiWame\WhatsApp;


class Send
{
    public $wpp_server;
    public $wpp_key;

    public function whatsApp($msg)
    {

        $whatsapp     = new WhatsApp(["server" =>  $this->wpp_server, "key" =>  $this->wpp_key]);


        
        if (sizeof($msg) > 0) {
        }
    }
}
