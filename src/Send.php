<?php

namespace Cachesistemas\ChatbotWhatsappPhp;

use Cachesistemas\ClassePhpApiWame\WhatsApp;


class Send
{
    public $wpp_server;
    public $wpp_key;
    public $phone;

    public function whatsApp($msg)
    {

        $whatsapp     = new WhatsApp(["server" =>  $this->wpp_server, "key" =>  $this->wpp_key]);


        if (sizeof($msg) > 0) {

            for ($i = 0; sizeof($msg) > $i; $i++) {

                switch ($msg[$i]["type"]) {

                    case 'text':
                        $whatsapp->sendPresence($this->phone, 'composing');
                        sleep(2);
                        $whatsapp->sendText($this->phone, $msg[$i]["message"]);
                        break;


                    case 'audio':
                        $whatsapp->sendPresence($this->phone, 'recording');
                        sleep(2);
                        $whatsapp->sendAudio($this->phone, $msg[$i]["url"], true);
                        break;


                    case 'image':
                        $whatsapp->sendMedia($this->phone, $msg[$i]["url"], 'image', $msg[$i]["caption"]);
                        break;


                    default:
                        # code...
                        break;
                }
            }
        }
    }
}
