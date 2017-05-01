<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>結帳</title>
    <style>
        .movie_num{
            padding-bottom: 5px;
        }

        .title{
            font-size: 18px;
            padding-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="title">DVD 結帳系統</div>
<form action="dvd_store_checkout.php" method="post">
    <div class="movie_num">紅標 <input type="text" name="red"> 片</div>
    <div class="movie_num">綠標 <input type="text" name="green"> 片</div>
    <div class="movie_num">藍標 <input type="text" name="blue"> 片</div>
    <div><button type="submit">計算</button></div>
</form>
<br>
<?php
    class shoppingCart {
        public function __construct() {
            $this->count    = array(
                'red'   => $_POST['red'],
                'green' => $_POST['green'],
                'blue'  => $_POST['blue']
            );
        }
        public function checkOut() {
            if (isset($this->count['red'])) {
                if ($this->count['red'] == '' && $this->count['green'] == '' && $this->count['blue'] == '') {
                    echo "請輸入 dvd 數量! <br>";
                }
                else {
                    $price = 0;
                    $point = 0;
                    if ($this->count['red'] != '') {
                        $this->printMsg('red');
                        // calculate
                        if ($this->isNumber($this->count['red'])) {
                            if (intval($this->count['red']) > 0) {
                                $price  += $this->calculateRedPrice();
                            }
                            $point += $this->calculateRedPoint();
                        }
                    }

                    if ($this->count['green'] != '') {
                        $this->printMsg('green');
                        // calculate
                        if ($this->isNumber($this->count['green'])) {
                            if (intval($this->count['green']) > 0) {
                                $price  += $this->calculateGreenPrice();
                            }
                            $point += $this->calculateGreenPoint();
                        }
                    }

                    if ($this->count['blue'] != '') {
                        $this->printMsg('blue');
                        // calculate
                        if ($this->isNumber($this->count['blue'])) {
                            if (intval($this->count['blue']) > 0) {
                                $price  += $this->calculateBluePrice();
                            }
                        }
                    }

                    echo "總金額 {$price} 元 <br>";
                    echo "<br>";
                    echo "此次消費積點為 {$point} 點";
                    if ($point >= 20) {
                        echo "，恭喜您獲得神秘小禮物一份! <br>";
                    }
                }
            }
        }

        private function calculateRedPrice() {
            $price = 0;
            if (intval($this->count['red']) <= 2) {
                $price += 60;
            }
            else {
                $price += 60 + (intval($this->count['red']) - 2) * 40;
            }

            return $price;
        }

        private function calculateRedPoint() {
            $red_point = intval($this->count['red']) * 3;
            if ($red_point > 15) {
                $red_point = 15;
            }
            return $red_point;
        }

        private function calculateGreenPrice() {
            $price = 0;
            if (intval($this->count['green']) <= 3) {
                $price += 30;
            }
            else {
                $price += 30 + (intval($this->count['green']) - 3) * 12;
            }
            return $price;
        }

        private function calculateGreenPoint() {
            $green_point = intval($this->count['green']) * 1;
            if ($green_point > 8) {
                $green_point = 8;
            }
            return $green_point;
        }

        private function calculateBluePrice() {
            $price = 0;
            if (intval($this->count['blue']) <= 3) {
                $price += 25;
            }
            else {
                $price += 25 + (intval($this->count['blue']) - 3) * 10;
            }
            return $price;
        }

        private function isNumber($string) {
            return preg_match('/^\d+$/', $string);
        }

        private function printMsg($type) {
            switch ($type) {
                case 'red':
                    $name       = '藍標';
                    $discount   =  2;
                    break;
                case 'green':
                    $name       = '綠標';
                    $discount   =  3;
                    break;
                case 'blue':
                    $name       = '藍標';
                    $discount   =  3;
                    break;
            }

            if ($this->isNumber($this->count[$type])) {
                echo "您購買{$name}" . $this->count[$type] . "片"; 
                if (intval($this->count[$type]) > 0 && intval($thiss->count[$type]) < $discount) {
                    echo ", 可以再多拿" . strval($discount - intval($this->count[$type])) . "片, 價格不變喔!";
                }
                echo "<br>";
            }
            else {
                echo "{$name}數量請輸入非負整數! <br>";
            }
        }

        private $count;
    }

    $shoppingCart   = new shoppingCart();
    $shoppingCart->checkOut();
?>
</body>
</html>
