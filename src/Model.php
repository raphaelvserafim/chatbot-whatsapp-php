<?php

namespace Cachesistemas\ChatbotWhatsappPhp;

use Cachesistemas\ChatbotWhatsappPhp\DB;

class Model extends DB
{

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

}
