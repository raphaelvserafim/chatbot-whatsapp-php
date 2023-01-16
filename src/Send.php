<?php

namespace Cachesistemas\ChatbotWhatsappPhp;

use Cachesistemas\ClassePhpApiWame\WhatsApp;


class Send
{
    public $wpp_server;
    public $key;
    public $phone;
    public $network;

    public function Message($msg)
    {


        switch ($this->network) {
            case 'whatsapp':
                $this->WhatsApp($msg);
                break;

            case 'telegram':
                $this->Telegram($msg);
                break;
        }
    }



    public function WhatsApp($msg)
    {

        if (isset($this->phone)) {


            $whatsapp     = new WhatsApp(["server" =>  $this->wpp_server, "key" =>  $this->key]);

            if (sizeof($msg) > 0) {


                $logs = [];

                for ($i = 0; sizeof($msg) > $i; $i++) {


                    switch ($msg[$i]["type"]) {

                        case 'text':
                            $logs[] =  $whatsapp->sendPresence($this->phone, 'composing');
                            sleep(2);
                            $logs[] =  $whatsapp->sendText($this->phone, $msg[$i]["message"]);
                            break;


                        case 'audio':
                            $logs[] = $whatsapp->sendPresence($this->phone, 'recording');
                            sleep(2);
                            $logs[] =   $whatsapp->sendAudio($this->phone, $msg[$i]["url"], true);
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

                $this->createLog('send-log',  $logs);
            }
        }
    }


    public function Telegram($msg)
    {
        // EM BREVE
    }

    public function createLog($name, $logs)
    {
        $fp = fopen($name . '.json', "a+");
        fwrite($fp, "\n\n\n\n" . $logs  . "\n\n\n");
        fclose($fp);
    }
}
