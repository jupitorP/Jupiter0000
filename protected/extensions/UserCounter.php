<?php

class UserCounter extends CComponent {

    public $action;
    public $data;
    private $cfg_tbl_useronline = 'user_online';
    private $cfg_tbl_daily = 'counter_daily';
    private $cfg_tbl_log = 'counter_log';
    private $cfg_tbl_counter = 'counter';
    private $cfg_online_time = 10;
    private $user_total = 0;
    private $user_online = 0;
    private $user_today = 0;
    private $user_yesterday = 0;
    private $user_time = 0;
    private $user_year = 0;
    private $user_month = 0;
    private $user_lastyear = 0;
    private $user_lastmonth = 0;

    public function __construct() {
        
    }

    public function init() {
        
    }

    public function refresh() {
        $cfg_tbl_useronline = $this->cfg_tbl_useronline;
        $cfg_tbl_daily = $this->cfg_tbl_daily;
        $cfg_tbl_log = $this->cfg_tbl_log;
        $cfg_tbl_counter = $this->cfg_tbl_counter;

        $db = Yii::app()->db;
        $sessionId = session_id();

        $strSQL = " SELECT date FROM $cfg_tbl_counter LIMIT 0,1";
        $command = $db->createCommand($strSQL);
        $dataReader = $command->query();
        $rowCounter = $dataReader->read();

        if ($rowCounter["date"] != date("Y-m-d")) {
            //*** บันทึกข้อมูลของเมื่อวานไปยังตาราง daily ***//
            $strSQL = " INSERT INTO $cfg_tbl_daily (date,num) SELECT '" . date('Y-m-d', strtotime("-1 day")) . "',COUNT(*) AS intYesterday FROM  $cfg_tbl_counter WHERE 1 AND date = '" . date('Y-m-d', strtotime("-1 day")) . "'";
            $command = $db->createCommand($strSQL);
            $command->query();

            //*** ลบข้อมูลของเมื่อวานในตาราง counter ***//
            $strSQL = " DELETE FROM $cfg_tbl_counter WHERE date != '" . date("Y-m-d") . "' ";
            $command = $db->createCommand($strSQL);
            $command->query();
        }
        
        $strSQL = " SELECT COUNT(*) As chkSession FROM $cfg_tbl_counter  WHERE session='$sessionId' ";
        $command = $db->createCommand($strSQL);
        $dataReader = $command->query();
        $chkSessionShow = $dataReader->read();

        if(empty($chkSessionShow['chkSession'])){
        //*** Insert Counter ปัจจุบัน ***//
        $strSQL = " INSERT INTO $cfg_tbl_counter (date,ip,session) VALUES ('" . date("Y-m-d") . "','" . $_SERVER["REMOTE_ADDR"] . "','" . $sessionId . "') ";
        $command = $db->createCommand($strSQL);
        $command->query();
        $strSQL = " INSERT INTO $cfg_tbl_log (date,ip,session) VALUES ('" . date("Y-m-d") . "','" . $_SERVER["REMOTE_ADDR"] . "','" . $sessionId . "') ";
        $command = $db->createCommand($strSQL);
        $command->query();
        }
        // Today //
        $strSQL = " SELECT COUNT(date) AS CounterToday FROM $cfg_tbl_counter WHERE date = '" . date("Y-m-d") . "' ";
        $command = $db->createCommand($strSQL);
        $dataReader = $command->query();
        $rowCounter = $dataReader->read();
        $strToday = $rowCounter["CounterToday"];

        // Yesterday //
        $strSQL = " SELECT num FROM $cfg_tbl_daily WHERE date = '" . date('Y-m-d', strtotime("-1 day")) . "' ";
        $command = $db->createCommand($strSQL);
        $dataReader = $command->query();
        $rowCounter = $dataReader->read();
        $strYesterday = $rowCounter["num"];

        // This Month //
        $strSQL = " SELECT SUM(num) AS CountMonth FROM $cfg_tbl_daily WHERE DATE_FORMAT(date,'%Y-%m')  = '" . date('Y-m') . "' ";

        $command = $db->createCommand($strSQL);
        $dataReader = $command->query();
        $rowCounter = $dataReader->read();
        $strThisMonth = $rowCounter["CountMonth"];

        // Last Month //
        $strSQL = " SELECT SUM(num) AS CountMonth FROM $cfg_tbl_daily WHERE DATE_FORMAT(date,'%Y-%m')  = '" . date('Y-m', strtotime("-1 month")) . "' ";
        $command = $db->createCommand($strSQL);
        $dataReader = $command->query();
        $rowCounter = $dataReader->read();
        $strLastMonth = $rowCounter["CountMonth"];

        // This Year //
        $strSQL = " SELECT SUM(num) AS CountYear FROM $cfg_tbl_daily WHERE DATE_FORMAT(date,'%Y')  = '" . date('Y') . "' ";
        $command = $db->createCommand($strSQL);
        $dataReader = $command->query();
        $rowCounter = $dataReader->read();
        $strThisYear = $rowCounter["CountYear"];

        // Last Year //
        $strSQL = " SELECT SUM(num) AS CountYear FROM $cfg_tbl_daily WHERE DATE_FORMAT(date,'%Y')  = '" . date('Y', strtotime("-1 year")) . "' ";
        $command = $db->createCommand($strSQL);
        $dataReader = $command->query();
        $rowCounter = $dataReader->read();
        $strLastYear = $rowCounter["CountYear"];

        $strSQL = " SELECT SUM(num) as CountTotal FROM $cfg_tbl_daily";
        $command = $db->createCommand($strSQL);
        $dataReader = $command->query();
        $rowCounter = $dataReader->read();
        $strTotal = $rowCounter["CountTotal"] ;

        $time = time();
        $dag = date("z");
        $nu = time() - 120; // Keep for 1 mins

        $strSQL = "SELECT count(*) As cOnline FROM $cfg_tbl_useronline WHERE session='$sessionId' ";
        $objQuery = $db->createCommand($strSQL);
        $dataReader = $objQuery->query();
        $sessionId_check = $dataReader->read();

        if ($sessionId_check['cOnline'] == "0") {
            $insertUserOnline = $db->createCommand("INSERT INTO $cfg_tbl_useronline VALUES ('$sessionId','$time','$dag')");
            $insertUserOnline->query();
        } else {
            $updateUserOnline = $db->createCommand("UPDATE $cfg_tbl_useronline SET time='$time' WHERE session='$sessionId'");
            $updateUserOnline->query();
        }
        $countUsers = $db->createCommand("SELECT count(*) As countUsers FROM $cfg_tbl_useronline WHERE time>$nu AND day=$dag");
        $dataReader = $countUsers->query();
        $usersOnline = $dataReader->read();
        //echo $users_online; // echo จำนวนผู้ online ออกมาก
        $delUserOnline1 = $db->createCommand("DELETE FROM $cfg_tbl_useronline WHERE time<$nu");
        $delUserOnline1->query();
        $delUserOnline2 = $db->createCommand("DELETE FROM $cfg_tbl_useronline WHERE day != $dag");
        $delUserOnline2->query();

        $this->user_total = ($strTotal+$strToday); //ทั้งหมด
        $this->user_online = $usersOnline['countUsers']; //ผู้ออนไลน์ 
        $this->user_today = $strToday; //วันนี้
        $this->user_yesterday = $strYesterday; //เมื่อวาน
        $this->user_month = ($strThisMonth+$strToday); //เดือนนี้
        $this->user_lastmonth = $strLastMonth; //เดือนที่แล้ว
        $this->user_year = ($strThisYear+$strToday); //ปีนี้
        $this->user_lastyear = $strLastYear; //ปีที่แล้ว
    }

    public function getTotal() {
        return number_format($this->user_total);
    }

    public function getOnline() {
        return number_format($this->user_online);
    }

    public function getToday() {
        return number_format($this->user_today);
    }

    public function getYesterday() {
        return number_format($this->user_yesterday);
    }

    public function getMonth() {
        return number_format($this->user_month);
    }

    public function getLastMonth() {
        return number_format($this->user_lastmonth);
    }

    public function getYear() {
        return number_format($this->user_year);
    }

    public function getLastYear() {
        return number_format($this->user_lastyear);
    }

}

?>