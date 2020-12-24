<?php
require_once 'bai1-data.php';
class manager extends listMember {
    public $code;
    public $fullname;
    public $age;
    public $gender;
    public $marital_status;
    public $total_work_time;
    public $salary;
    public $workdays;
    public $start_work_time;
    public $work_hour;
    public $has_lunch_break;
    public  function  MemberFulltime(){
        $listFullTime = $this->listMemberFullTime();
        $lenght = count($listFullTime);
//        for ($i=0;$i<$lenght;$i++){
//            $code = $listFullTime[$i]['code'];
//        }
        return $listFullTime;
    }
}

$a = new manager;
echo '<pre>';
print_r($a->MemberFulltime());
echo '</pre>';

?>

