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
        public function checkOut() {
            if (isset($_POST['red'])) {
                if ($_POST['red'] == '' && $_POST['green'] == '' && $_POST['blue'] == '') {
                    echo "請輸入 dvd 數量! <br>";
                }
                else {
                    $price = 0;
                    $point = 0;
                    if ($_POST['red'] != '') {
                        // print
                        if (preg_match('/^\d+$/', $_POST['red'])) {
                            echo "您購買紅標" . $_POST['red'] . "片";
                            if (intval($_POST['red']) > 0 && intval($_POST['red']) < 2) {
                                echo "，可以再多拿" . strval(2 - intval($_POST['red']))  . "片，價格不變唷!";
                            }
                            echo "<br>";
                        }
                        else {
                            echo "紅標數量請輸入非負整數! <br>";
                        }
                        // calculate
                        if (preg_match('/^\d+$/', $_POST['red'])) {
                            if (intval($_POST['red']) > 0) {
                                $price  += $this->calculateRedPrice();
                            }
                            $point += $this->calculateRedPoint();
                        }
                    }

                    if ($_POST['green'] != '') {
                        // print
                        if (preg_match('/^\d+$/', $_POST['green'])) {
                            echo "您購買綠標" . $_POST['green'] . "片";
                            if (intval($_POST['green']) > 0 && intval($_POST['green']) < 3) {
                                echo "，可以再多拿" . strval(3 - intval($_POST['green'])) . "片，價格不變唷!";
                            }
                            echo "<br>";
                        }
                        else {
                            echo "綠標數量請輸入非負整數! <br>";
                        }
                        // calculate
                        if (preg_match('/^\d+$/', $_POST['green'])) {
                            if (intval($_POST['green']) > 0) {
                                $price  += $this->calculateGreenPrice();
                            }
                            $point += $this->calculateGreenPoint();
                        }
                    }

                    if ($_POST['blue'] != '') {
                        // print
                        if (preg_match('/^\d+$/', $_POST['blue'])) {
                            echo "您購買藍標" . $_POST['blue'] . "片";
                            if (intval($_POST['blue']) > 0 && intval($_POST['blue']) < 3) {
                                echo "，可以再多拿" . strval(3 - intval($_POST['blue'])) . "片，價格不變唷!";
                            }
                            echo "<br>";
                        }
                        else {
                            echo "藍標數量請輸入非負整數! <br>";
                        }
                        // calculate
                        if (preg_match('/^\d+$/', $_POST['blue'])) {
                            if (intval($_POST['blue']) > 0) {
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
            if (intval($_POST['red']) <= 2) {
                $price += 60;
            }
            else {
                $price += 60 + (intval($_POST['red']) - 2) * 40;
            }

            return $price;
        }

        private function calculateRedPoint() {
            $red_point = intval($_POST['red']) * 3;
            if ($red_point > 15) {
                $red_point = 15;
            }
            return $red_point;
        }

        private function calculateGreenPrice() {
            $price = 0;
            if (intval($_POST['green']) <= 3) {
                $price += 30;
            }
            else {
                $price += 30 + (intval($_POST['green']) - 3) * 12;
            }
            return $price;
        }

        private function calculateGreenPoint() {
            $green_point = intval($_POST['green']) * 1;
            if ($green_point > 8) {
                $green_point = 8;
            }
            return $green_point;
        }

        private function calculateBluePrice() {
            $price = 0;
            if (intval($_POST['blue']) <= 3) {
                $price += 25;
            }
            else {
                $price += 25 + (intval($_POST['blue']) - 3) * 10;
            }
            return $price;
        }
    }

    $shoppingCart   = new shoppingCart();
    $shoppingCart->checkOut();
?>
</body>
</html>
