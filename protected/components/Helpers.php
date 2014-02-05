<?php

class Helpers {

    public static function statusOrder($status) {
        switch ($status) {
            case 1 :
                return '<font color="red">ยังไม่ชำระเงิน</font>';
                break;
            case 2 :
                return '<font color="green">ชำระเงิน/รอจัดส่งสินค้า</font>';
                break;
            default:
                return '<font color="blue">ชำระเงิน/จัดส่งสินค้าแล้ว</font>';
        }
    }

    public static function getStatus() {
        return array(1 => 'ยังไม่ชำระเงิน', 2 => 'ชำระเงิน/รอจัดส่งสินค้า', 3 => 'ชำระเงิน/จัดส่งสินค้าแล้ว');
    }

    public static function dateConvert($strDate, $mode, $type="") {
        $month_key = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
        $month_full = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $month_short = array("ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $dYear = substr($strDate, 0, 4);  //format Y-m-d H:i:s
        $dMonth = substr($strDate, 5, 2);
        $dDay = substr($strDate, 8, 2);
        if ($dYear < 2550) {
            $dYear += 543;
        }
        switch ($mode) {
            case 'full': // วันที่ 23 เดือนสิงหาคม พ.ศ. 2526
                if (substr($dDay, 0, 1) == 0) { // 02 ตัด 0 ออก เพื่อให้เป็นตัวเลขนับ
                    $dDay = substr($dDay, 1, 1);
                }
                $thMonth = array_combine($month_key, $month_full);
                $new_date = "วันที่ " . $dDay . " เดือน" . $thMonth[$dMonth] . " พ.ศ. " . $dYear;
                break;
            case 'short': // 23 ส.ค. 26
                $thMonth = array_combine($month_key, $month_short);
                $new_date = $dDay . " " . $thMonth[$dMonth] . " " . substr($dYear, 2, 2);
                break;
            case 'digit': // 23/08/2550
                $new_date = $dDay . "/" . $dMonth . "/" . $dYear;
                break;
        }
        switch ($type) {
            case 'datetime':
                $dTime = substr($strDate, 11, 8);
                $new_date = $new_date . " " . $dTime;
                break;
        }
        return $new_date;
    }

    public static function dateFormat($strDate, $mode, $type="") {

        $new_date = "";

        if (!empty($strDate)) {
            switch ($mode) {
                case 'format1': //input format d-m-Y / output format Y-m-d 
                    $dYear = substr($strDate, 6, 4);
                    $dMonth = substr($strDate, 3, 2);
                    $dDay = substr($strDate, 0, 2);
                    $new_date = trim($dYear . "-" . $dMonth . "-" . $dDay);
                    break;
                case 'format2': //input format Y-m-d / output format d-m-Y 
                    $dYear = substr($strDate, 0, 4);
                    $dMonth = substr($strDate, 5, 2);
                    $dDay = substr($strDate, 8, 2);
                    $new_date = trim($dDay . "-" . $dMonth . "-" . $dYear);
                    break;
            }
        }

        return $new_date;
    }

    public static function numb_format() {
        return number_format($totalprice, 2, '.', ',');
    }

    public function Tags() {
        $productTagCount = new ProductTagCount;
        $menus = $productTagCount->model()->findAll(array('order' => 'tagcount_sum DESC', 'limit' => 50));
        $html = "";
        $cMenus = count($menus);
        if (!empty($cMenus)) {
            $html.="<div class='layout1_body'>";
            $html.="<div id='tag'>";
            foreach ($menus as $menu) {
                $html.=CHtml::link($menu["tag_name"], array('tag/view', 'TagName' => $menu["tag_name"]), array('title' => $menu["tag_name"])) . ' ';
            }
            $html.="</div>";
            $html.="</div>";
        }

        return $html;
    }

}

?>