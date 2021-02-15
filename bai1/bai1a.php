<?php
require_once 'bai1-data.php';

class manager
{
    public $code;
    public $full_name;
    public $age;
    public $gender;
    public $start_work_time;
    public $luong;
    public $start_datetime;
    public $cong;
    public $end_datetime;
    public $chamcong;
    public function setCode($code){
        $this->code = $code;
    }
    public function getCode(){
        return $this->code;
    }
    public function setName($name){
        $this->full_name = $name;
    }
    public function getName(){
        return $this->full_name;
    }
    public function setAge($age){
        $this->age = $age;
    }
    public function getAge(){
        return $this->age;
    }
    public function setGender($gender){
        $this->gender = $gender;
    }
    public function getGender(){
        return $this->gender;
    }
    public function setLuong($luong){
        $this->luong = $luong;
    }
    public function getLuong(){
        return $this->luong;
    }
    public function datetime($column, $arrlistWorkTime)
    {
        $array = [];
        $lenght = count($arrlistWorkTime);
        for ($i = 0; $i < $lenght; $i++) {
            $cut_one = explode(' ', $arrlistWorkTime[$i][$column]);
            $cut_two = explode(':', $cut_one[1]);
            $hour = ($cut_two[0]) + ($cut_two[1] / 60) + ($cut_two[2] / 3600);
            array_push($array, $hour);
        }
        return $array;
    }

    public function start_datetime($arrlistWorkTime)
    {
        $arrStar_datetime = $this->datetime('start_datetime', $arrlistWorkTime);
        return $arrStar_datetime;
    }

    public function end_datetime($arrlistWorkTime)
    {
        $arrEnd_datetime = $this->datetime('end_datetime', $arrlistWorkTime);
        return $arrEnd_datetime;
    }

    public function getDay($m, $y)
    {
        $sumDay = date('t', mktime(0, 0, 0, $m, 1, $y));
        $getDay = 0;
        for ($d = 1; $d <= $sumDay; $d++) {
            $getDayinW = date('w', mktime(0, 0, 0, $m, $d, $y));
            if ($getDayinW > 0 && $getDayinW < 6) {
                $getDay++;
            }
        }
        switch ($m) {
            case 1:
            case 3:
            case 4:
            case 5:
                $getDay -= 1;
                break;
            case 2:
                $getDay -= 5;
                break;
            case 9:
                $getDay -= 2;
                break;
        }

        return $getDay;
    }
}

class TimekeepingFullTime extends manager
{
    public function getHourFull($arrlistWorkTime, $arrStar_datetime, $arrEnd_datetime)
    {
        $array = [];
        $lenght = count($arrlistWorkTime);
        for ($i = 0; $i < $lenght; $i++) {
            $sum = $arrEnd_datetime[$i] - $arrStar_datetime[$i] - 1.5;
            array_push($array, $sum);

        }
        return $array;
    }

    public function calculate($arrlistWorkTime, $arrlistMemberFullTime, $getHourFull, $arrStar_datetime)
    {
        $lenght = count($arrlistMemberFullTime);
        for ($i = 0; $i < $lenght; $i++) {
            $c = explode(':', $arrlistMemberFullTime[$i]['start_work_time']);
            $c = ($c[0]) + ($c[1] / 60) + ($c[2] / 3600);
            $arrlistMemberFullTime[$i]['start_work_time'] = $c;
            for ($j = 0; $j < count($arrlistWorkTime); $j++) {
                if ($arrlistMemberFullTime[$i]['code'] === $arrlistWorkTime[$j]['member_code']) {
                    $arrlistWorkTime[$j]['cong'] = $getHourFull[$j];
                    if ($arrStar_datetime[$j] > $arrlistMemberFullTime[$i]['start_work_time']) {
                        $arrlistWorkTime[$j]['chamcong'] = 1 / 2;
                        if ($arrlistWorkTime[$j]['cong'] < 4) {
                            $arrlistWorkTime[$j]['chamcong'] = 0;
                        }
                    } else {
                        if ($arrlistWorkTime[$j]['cong'] >= 8) {
                            $arrlistWorkTime[$j]['chamcong'] = 1;
                        } else if ($arrlistWorkTime[$j]['cong'] < 8 && $arrlistWorkTime[$j]['cong'] >= 4) {
                            $arrlistWorkTime[$j]['chamcong'] = 1 / 2;
                        } else if ($arrlistWorkTime[$j]['cong'] < 4) {
                            $arrlistWorkTime[$j]['chamcong'] = 0;
                        }
                    }

                }

            }
        }
        return $arrlistWorkTime;
    }

    public function sum($inputNumber, $getDay, $arrlistWork_Cal, $arrlistMemberFullTime)
    {
        $lenght = count($arrlistMemberFullTime);
        $sum = 0;
        for ($i = 0; $i < $lenght; $i++) {
            for ($j = 0; $j < count($arrlistWork_Cal); $j++) {
                if ($arrlistMemberFullTime[$i]['code'] === $arrlistWork_Cal[$j]['member_code']) {
                    if ($arrlistWork_Cal[$j]['member_code'] === $inputNumber) {
                        $sum += $arrlistWork_Cal[$j]['chamcong'];
                        $arrlistMemberFullTime[$i]['luong'] = round($arrlistMemberFullTime[$i]['salary'] / $getDay * $sum, 2);
                    }
                }
            }
        }
        return $arrlistMemberFullTime;
    }

}

class TimekeepingPartTime extends manager
{
    public function getHourPart($arrlistWorkTime, $arrStar_datetime, $arrEnd_datetime)
    {
        $array = [];
        $lenght = count($arrlistWorkTime);
        for ($i = 0; $i < $lenght; $i++) {
            $sum = $arrEnd_datetime[$i] - $arrStar_datetime[$i];
            array_push($array, $sum);

        }
        return $array;
    }

    public function calculate($arrlistWorkTime, $arrlistMemberPartTime, $getHourPart, $arrStar_datetime)
    {
        $lenght = count($arrlistMemberPartTime);
        for ($i = 0; $i < $lenght; $i++) {
            $c = explode(':', $arrlistMemberPartTime[$i]['start_work_time']);
            $c = ($c[0]) + ($c[1] / 60) + ($c[2] / 3600);
            $arrlistMemberPartTime[$i]['start_work_time'] = $c;
            for ($j = 0; $j < count($arrlistWorkTime); $j++) {
                if ($arrlistMemberPartTime[$i]['code'] === $arrlistWorkTime[$j]['member_code']) {
                    $arrlistWorkTime[$j]['cong'] = $getHourPart[$j];
                    if ($arrStar_datetime[$j] > $arrlistMemberPartTime[$i]['start_work_time']) {
                        $arrlistWorkTime[$j]['chamcong'] = 1 / 2;
                        if ($arrlistWorkTime[$j]['cong'] < 2) {
                            $arrlistWorkTime[$j]['chamcong'] = 0;
                        }
                    } else {
                        if ($arrlistWorkTime[$j]['cong'] >= 4) {
                            $arrlistWorkTime[$j]['chamcong'] = 1;
                        } else if ($arrlistWorkTime[$j]['cong'] < 4 && $arrlistWorkTime[$j]['cong'] >= 2) {
                            $arrlistWorkTime[$j]['chamcong'] = 1 / 2;
                        } else if ($arrlistWorkTime[$j]['cong'] < 2) {
                            $arrlistWorkTime[$j]['chamcong'] = 0;
                        }
                    }

                }

            }
        }
        return $arrlistWorkTime;
    }

    public function sum($inputNumber, $getDay, $arrlistWork_Cal, $arrlistMemberPartTime)
    {
        $lenght = count($arrlistMemberPartTime);
        $sum = 0;
        for ($i = 0; $i < $lenght; $i++) {
            for ($j = 0; $j < count($arrlistWork_Cal); $j++) {
                if ($arrlistMemberPartTime[$i]['code'] === $arrlistWork_Cal[$j]['member_code']) {
                    if ($arrlistWork_Cal[$j]['member_code'] === $inputNumber) {
                        $sum += $arrlistWork_Cal[$j]['chamcong'];
                        $arrlistMemberPartTime[$i]['luong'] = round($arrlistMemberPartTime[$i]['salary'] / $getDay * $sum, 2);
                    }
                }
            }
        }
        return $arrlistMemberPartTime;
    }

}

$parttime = new TimekeepingPartTime;
$manager = new manager;
$fulltime = new TimekeepingFullTime;

?>

<form action="" method="post">
    <input type="text" name="inputNumber" value="">
    <input type="submit" name="submit" value="Tìm kiếm">
    <?php
    if (isset($_POST['submit'])) {
        $inputNumber = $_POST['inputNumber'];
        $arrlistWorkTime = $listWorkTime;
        $arrStar_datetime = $manager->start_datetime($arrlistWorkTime);
        $arrEnd_datetime = $manager->end_datetime($arrlistWorkTime);
        $y = substr($arrlistWorkTime[0]['start_datetime'], 0, 4);
        $m = substr($arrlistWorkTime[0]['start_datetime'], 5, 2);
        $getDay = $manager->getDay($m, $y);

        // FullTime

        $arrlistMemberFullTime = $listMemberFullTime;
        $getHourFull = $fulltime->getHourFull($arrlistWorkTime, $arrStar_datetime, $arrEnd_datetime);
        $arrlistWork_Cal = $fulltime->calculate($arrlistWorkTime, $arrlistMemberFullTime, $getHourFull, $arrStar_datetime);
        $arrays = $fulltime->sum($inputNumber, $getDay, $arrlistWork_Cal, $arrlistMemberFullTime);
        $lenght = count($arrays);
            for ($i = 0; $i < $lenght; $i++) {

                if ($arrays[$i]['code'] === $inputNumber) {
                    $manager->setName($arrays[$i]['full_name']);
                    $manager->setCode($arrays[$i]['code']);
                    $manager->setAge($arrays[$i]['age']);
                    $manager->setGender($arrays[$i]['gender']);
                    $manager->setLuong($arrays[$i]['luong']);
                    echo '<br>' . "Mã: " . $manager->getCode() . '<br>';
                    echo "Họ tên: " . $manager->getName() . '<br>';
                    echo "Tuổi: " . $manager->getAge() . '<br>';
                    if ($manager->getGender() === 0) {
                        echo "Gioi tinh: Nam" . '<br>';
                    }
                    if ($manager->getGender() === 1) {
                        echo "Gioi tinh: Nữ" . '<br>';

                    }
                    echo "Lương: " . $manager->getLuong() . '<br>';
                }
            }

            //Parttime

        $arrlistMemberPartTime = $listMemberPartTime;
        $getHourPart = $parttime->getHourPart($arrlistWorkTime, $arrStar_datetime, $arrEnd_datetime);
        $arrlistWork_Cal = $parttime->calculate($arrlistWorkTime, $arrlistMemberPartTime, $getHourPart, $arrStar_datetime);
        $arrays = $parttime->sum($inputNumber, $getDay, $arrlistWork_Cal, $arrlistMemberPartTime);
        $lenght = count($arrays);
        for ($i = 0; $i < $lenght; $i++) {
            if ($arrays[$i]['code'] === $inputNumber) {
                $manager->setName($arrays[$i]['full_name']);
                $manager->setCode($arrays[$i]['code']);
                $manager->setAge($arrays[$i]['age']);
                $manager->setGender($arrays[$i]['gender']);
                $manager->setLuong($arrays[$i]['luong']);
                echo '<br>' . "Mã: " . $manager->getCode() . '<br>';
                echo "Họ tên: " . $manager->getName() . '<br>';
                echo "Tuổi: " . $manager->getAge() . '<br>';
                if ($manager->getGender() === 0) {
                    echo "Gioi tinh: Nam" . '<br>';
                }
                if ($manager->getGender() === 1) {
                    echo "Gioi tinh: Nữ" . '<br>';

                }
                echo "Lương: " . $manager->getLuong() . '<br>';
            }
        }
//        $lenght  =count($arrlistWork_Cal);
//        for ($j=0;$j<$lenght;$j++){
//
//        }

    }
    ?>
</form>

