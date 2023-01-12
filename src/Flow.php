<?php

namespace Cachesistemas\ChatbotWhatsappPhp;

use Cachesistemas\ChatbotWhatsappPhp\DB;

class Flow extends DB
{

    public $phone;



    public function checkService()
    {
        return   DB::Select("SELECT * FROM tb_attendance WHERE phone  = '$this->phone' ");
    }

    public function startService()
    {
    }

    public function endService()
    {
    }

    public function changeStage()
    {
    }

    public function stage()
    {
    }
}
