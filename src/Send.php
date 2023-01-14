<?php

namespace Cachesistemas\ChatbotWhatsappPhp;

use Cachesistemas\ClassePhpApiWame\WhatsApp;


class Send
{
    public $wpp_server;
    public $wpp_key;
    public $phone;

    public function Message($msg, $network)
    {

        if (sizeof($network) > 0) {
            for ($i = 0; sizeof($network) > $i; $i++) {
                switch ($network[$i]) {
                    case 'whatsapp':
                        $this->WhatsApp($msg);
                        break;

                    case 'telegram':
                        $this->Telegram($msg);
                        break;
                }
            }
        }
    }



    public function WhatsApp($msg)
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

                    case 'video':
                        $whatsapp->sendMedia($this->phone, $msg[$i]["url"], 'video', $msg[$i]["caption"]);
                        break;

                    case 'document':
                        $whatsapp->sendMedia($this->phone, $msg[$i]["url"], 'document', $msg[$i]["caption"]);
                        break;

                    case 'button':
                        $whatsapp->sendButton([
                            "to" => $this->phone,
                            "data" => [
                                "text" => $msg[$i]["title"],
                                "buttons" =>  $msg[$i]["buttons"],
                                "footerText" => $msg[$i]["footer"]
                            ]
                        ]);
                        break;


                    case 'list':
                        $body = [
                            "messageData" => [
                                "to" => $this->phone,
                                "buttonText" => $msg[$i]["name"],
                                "text" => " ",
                                "title" => $msg[$i]["title"],
                                "description" => $msg[$i]["footer"],
                                "sections" =>  $msg[$i]["sections"],
                                "listType" => 0
                            ]
                        ];
                        $whatsapp->sendList($body);
                        break;

                    case 'contact':
                        $whatsapp->sendContact($this->phone, $msg[$i]["name"], $msg[$i]["number"]);
                        break;
                }
            }
        }
    }


    public function Telegram($msg)
    {
        // EM BREVE
    }
}
