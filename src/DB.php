<?php
namespace Cachesistemas\ChatbotWhatsappPhp;

use PDO;
use PDOException;


class DB
{

    private  function conectar()
    {

        try {
            $conect  = new PDO("mysql:host=" . DB_HOST  . ";dbname=" . DB_BASE_NAME . "", DB_USER, DB_PASS);
            $conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conect->exec("SET NAMES 'utf8';");
        } catch (PDOException $e) {
            echo json_encode(array("status" => false, "message" => $e->getMessage()));
            die();
        }
        return  $conect;
    }


    public function Query($sql)
    {

        try {
            $stmt = $this->conectar()->prepare($sql);
            $stmt->execute();
            return  array("status" => true);
        } catch (PDOException $e) {
            return array("status" => false, "message" =>  $e->getMessage());
        }
    }

    public  function Select($sql)
    {

        try {
            $stmt = $this->conectar()->prepare($sql);
            $stmt->execute();
            return array("status" => true,  "data" => $stmt->fetchAll(PDO::FETCH_OBJ));
        } catch (PDOException $e) {

            return array("status" => false, "message" =>  $e->getMessage());
        }
    }
}
