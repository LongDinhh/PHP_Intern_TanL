<?php
require_once 'bai1-data.php';
class manager_datetime extends listMember
{
    public function datetime($column)
    {
        $array = [];
        $arrlistWorkTime = $this->listWorkTime();
        $lenght = count($arrlistWorkTime);
        for ($i = 0; $i < $lenght; $i++) {
            $cut_one = explode(' ', $arrlistWorkTime[$i][$column]);
            $cut_two = explode(':', $cut_one[1]);
            $hour = ($cut_two[0]) + ($cut_two[1] / 60) + ($cut_two[2] / 3600);
            array_push($array, $hour);
        }
        return $array;
    }

    public function start_datetime()
    {
        $arrStar_datetime = $this->datetime('start_datetime');
        return $arrStar_datetime;
    }

    public function end_datetime()
    {
        $arrEnd_datetime = $this->datetime('end_datetime');
        return $arrEnd_datetime;
    }

    public function getDay($m, $y)
    {
        $sumDay = date('t', mktime(0, 0, 0, $m, 1, $y));
        $getDay = 0;
        for ($d = 1; $d <= $sumDay; $d++) {
            $getDayinW = date('w', mktime(0, 0, 0, $m, $d, $y));
            if ($getDayinW > 0 && $getDayinW < 6) {
                $getDay ++;
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
            case 6:
            case 7:
            case 8:
            case 10:
            case 11:
            case 12:
                break;
        }

        return $getDay;
    }
}

class TimekeepingFullTime extends manager_datetime
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

    public function calculate()
    {
        $arrStar_datetime = $this->start_datetime();
        $arrEnd_datetime = $this->end_datetime();
        $arrlistWorkTime = $this->listWorkTime();
        $arrlistMemberFullTime = $this->listMemberFullTime();
        $getHourFull = $this->getHourFull($arrlistWorkTime, $arrStar_datetime, $arrEnd_datetime);
        $lenght = count($this->listMemberFullTime());
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

    public function sum($inputNumber)
    {
        $arrlistWork = $this->listWorkTime();
        $lenght = count($arrlistWork);
        $y = substr($arrlistWork[0]['start_datetime'], 0, 4);
        $m = substr($arrlistWork[0]['start_datetime'], 5, 2);
        $getDay = $this->getDay($m, $y);
        $sum = 0;
        $arrlistWork_Cal = $this->calculate();
        $arrlistMemberFullTime = $this->listMemberFullTime();
        for ($i = 0; $i < count($arrlistMemberFullTime); $i++) {
            for ($j = 0; $j < count($arrlistWork_Cal); $j++) {
                if ($arrlistMemberFullTime[$i]['code'] === $arrlistWork_Cal[$j]['member_code']) {
                    if ($arrlistWork_Cal[$j]['member_code'] === $inputNumber) {
                        $sum += $arrlistWork_Cal[$j]['chamcong'];
                        $arrlistMemberFullTime[$i]['luong'] = round($arrlistMemberFullTime[$i]['salary'] / $getDay * $sum,2);
                    }
                }
            }
        }
        return $arrlistMemberFullTime;
    }

}

class TimekeepingPartTime extends manager_datetime
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

    public function calculate()
    {
        $arrStar_datetime = $this->start_datetime();
        $arrEnd_datetime = $this->end_datetime();
        $arrlistWorkTime = $this->listWorkTime();
        $arrlistMemberPartTime = $this->listMemberPartTime();
        $getHourPart = $this->getHourPart($arrlistWorkTime, $arrStar_datetime, $arrEnd_datetime);
        $lenght = count($this->listMemberPartTime());
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

    public function sum($inputNumber)
    {
        $arrlistWork = $this->listWorkTime();
        $lenght = count($arrlistWork);
        $y = substr($arrlistWork[0]['start_datetime'], 0, 4);
        $m = substr($arrlistWork[0]['start_datetime'], 5, 2);
        $getDay = $this->getDay($m, $y);
        $sum = 0;
        $arrlistWork_Cal = $this->calculate();
        $arrlistMemberPartTime = $this->listMemberPartTime();
        for ($i = 0; $i < count($arrlistMemberPartTime); $i++) {
            for ($j = 0; $j < count($arrlistWork_Cal); $j++) {
                if ($arrlistMemberPartTime[$i]['code'] === $arrlistWork_Cal[$j]['member_code']) {
                    if ($arrlistWork_Cal[$j]['member_code'] === $inputNumber) {
                        $sum += $arrlistWork_Cal[$j]['chamcong'];
                        $arrlistMemberPartTime[$i]['luong'] = round($arrlistMemberPartTime[$i]['salary'] / $getDay * $sum,2);
                    }
                }
            }
        }
        return $arrlistMemberPartTime;
    }

}

$fulltime = new TimekeepingFullTime;
$parttime = new TimekeepingPartTime;

?>

<form action="" method="post">
    <table border="" cellpadding="8" cellspacing="0">
        <tr>
            <th>Mã</th>
            <th>Tên</th>
            <th>Tuổi</th>
            <th>Gioi tinh</th>
            <th>tình trạng hôn nhân</th>
            <th>thời gian làm việc</th>
            <th>lương</th>
            <th>số ngày công</th>
            <th>thời gian đăng ký đi làm</th>
            <th>Thời gian đăng kí làm việc</th>
            <th>has_lunch_break</th>
            <th>nghỉ trưa</th>
        </tr>
        <?php
        $MembersFullTime = $fulltime->listMemberFullTime();
        foreach ($MembersFullTime as $MemberFullTime):?>
            <tr>
                <td><?php echo $MemberFullTime['code']; ?></td>
                <td><?php echo $MemberFullTime['full_name']; ?></td>
                <td><?php echo $MemberFullTime['age']; ?></td>

                <td><?php echo $MemberFullTime['gender']; ?></td>

                <td><?php echo $MemberFullTime['marital_status']; ?></td>


                <td><?php echo $MemberFullTime['total_work_time']; ?></td>

                <td><?php echo $MemberFullTime['salary']; ?></td>
                <td><?php echo $MemberFullTime['workdays']; ?></td>
                <td><?php echo $MemberFullTime['start_work_time']; ?></td>
                <td><?php echo $MemberFullTime['work_hour']; ?></td>
                <td><?php echo $MemberFullTime['has_lunch_break']; ?></td>
                <td><?php echo 1.5; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <table border="" cellpadding="8" cellspacing="0">
        <tr>
            <th>Mã</th>
            <th>Ngày - giờ bắt đầu</th>
            <th>Ngày - giờ kết thúc</th>
            <th>Thời gian làm việc trong 1 ngày</th>
            <th>Chấm công</th>
        </tr>
        <?php
        $listWork = $fulltime->calculate();
        foreach ($listWork as $MemberFullTime):?>
            <tr>
                <?php if (($MemberFullTime['cong']) > 0): ?>
                    <td><?php echo $MemberFullTime['member_code']; ?></td>
                    <td><?php echo $MemberFullTime['start_datetime']; ?></td>
                    <td><?php echo $MemberFullTime['end_datetime']; ?></td>
                    <td><?php echo $MemberFullTime['cong']; ?></td>
                    <td><?php echo $MemberFullTime['chamcong']; ?></td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>
    <table border="" cellpadding="8" cellspacing="0">
        <tr>
            <th>Mã</th>
            <th>Tên</th>
            <th>Tuổi</th>
            <th>Gioi tinh</th>
            <th>tình trạng hôn nhân</th>
            <th>thời gian làm việc</th>
            <th>lương</th>
            <th>số ngày công</th>
            <th>thời gian đăng ký đi làm</th>
            <th>Thời gian đăng kí làm việc</th>
            <th>has_lunch_break</th>
        </tr>
        <?php
        $MembersFullTime = $parttime->listMemberPartTime();
        foreach ($MembersFullTime as $MemberFullTime):?>
            <tr>
                <td><?php echo $MemberFullTime['code']; ?></td>
                <td><?php echo $MemberFullTime['full_name']; ?></td>
                <td><?php echo $MemberFullTime['age']; ?></td>


                <td><?php echo $MemberFullTime['gender']; ?></td>


                <td><?php echo $MemberFullTime['marital_status']; ?></td>


                <td><?php echo $MemberFullTime['total_work_time']; ?></td>

                <td><?php echo $MemberFullTime['salary']; ?></td>
                <td><?php echo $MemberFullTime['workdays']; ?></td>
                <td><?php echo $MemberFullTime['start_work_time']; ?></td>
                <td><?php echo $MemberFullTime['work_hour']; ?></td>
                <td><?php echo $MemberFullTime['has_lunch_break']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <table border="" cellpadding="8" cellspacing="0">
        <tr>
            <th>Mã</th>
            <th>Ngày - giờ bắt đầu</th>
            <th>Ngày - giờ kết thúc</th>
            <th>Thời gian làm việc trong 1 ngày</th>
            <th>Chấm công</th>
        </tr>
        <?php
        $listWork = $parttime->calculate();
        foreach ($listWork as $MemberFullTime):?>
            <tr>
                <?php if (($MemberFullTime['cong']) > 0): ?>
                    <td><?php echo $MemberFullTime['member_code']; ?></td>
                    <td><?php echo $MemberFullTime['start_datetime']; ?></td>
                    <td><?php echo $MemberFullTime['end_datetime']; ?></td>
                    <td><?php echo $MemberFullTime['cong']; ?></td>
                    <td><?php echo $MemberFullTime['chamcong']; ?></td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>
    <input type="text" name="inputNumber" value="">
    <input type="submit" name="submit" value="Tìm kiếm">
    <?php
    if (isset($_POST['submit'])) {
        $inputNumber = $_POST['inputNumber'];
        $arrays = $fulltime->sum($inputNumber);
        foreach ($arrays as $array) {
            if ($array['code'] === $inputNumber) {
                echo '<br>' . 'Mã: ' . $array['code'] . '<br>';
                echo "Họ tên: " . $array['full_name'] . '<br>';
                echo "Tuổi: " . $array['age'] . '<br>';
                if($array['gender'] ===0){
                    echo "Gioi tinh: Nam" . '<br>';
                }
                if($array['gender'] ===1){
                    echo "Gioi tinh: Nữ" . '<br>';
                }
                echo "Lương: " . $array['luong'] . '<br>';
            }
        }
        $arrays1 = $parttime->sum($inputNumber);
        foreach ($arrays1 as $array) {
            if ($array['code'] === $inputNumber) {
                echo '<br>' . 'Mã: ' . $array['code'] . '<br>';
                echo "Họ tên: " . $array['full_name'] . '<br>';
                echo "Tuổi: " . $array['age'] . '<br>';
                if($array['gender'] ===0){
                    echo "Gioi tinh: Nam" . '<br>';
                }
                if($array['gender'] ===1){
                    echo "Gioi tinh: Nữ" . '<br>';
                }
                echo "Lương: " . $array['luong'] . '<br>';
            }
        }
    }
    ?>
</form>

