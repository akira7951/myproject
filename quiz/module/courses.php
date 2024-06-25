<?php
namespace APIModule;

use connection\Database;
use APIModule\Common;
use APIModule\Request;
use DateTime;
use PDO;

class Course
{
    private $pdo;
    private $request;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->request = new Request();
    }

    private function time_format($time)
    {
        $dateTime = new DateTime($time);
        return $dateTime->format('Hi');
    }

    public function list()
    {
        $data = [];

        if($this->pdo == false){
            return ['code'=>500,'Internal Error'];
        }

        $sql = "SELECT course_name,start_time,end_time from courses limit 2";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data[] = [
                'couorseName'=>$rows['course_name'],
                'startTime'=>$this->time_format($rows['start_time']),
                'endTime'=>$this->time_format($rows['end_time'])
            ];
        }

        return ['code'=>200,'message'=>true,'courses'=>$data];
    }

    public function create()
    {
        $courseName = $this->request->get('course_name');
        $startTime = $this->request->get('s_time');
        $endTime = $this->request->get('e_time');

        if($this->pdo == false){
            return ['code'=>500,'Internal Error'];
        }

        $conditions = [
            empty($courseName)=>'Course Name can not be empty',
            empty($startTime)=>'Course start time can not be empty',
            empty($endTime)=>'Course end time can not be empty',
        ];

        foreach($conditions as $condition=>$message){
            if($condition){
                return ['code'=>300,'message'=>$message];
            }
        }

        $insAry = array('course_name'=>$courseName,'start_time'=>$startTime,'end_time'=>$endTime);
        $sql = "INSERT into courses ".Common::sql_build_array('INSERT',$insAry);
        $stmt = $this->pdo->prepare($sql);
        
        if($stmt->execute() == false){
            return array('code'=>400,'message'=>'Insert data failed');
        }

        return array('code'=>200,'message'=>true);
    }

    public function delete()
    {
        $cid = $this->request->get('cid');

        if($this->pdo == false){
            return ['code'=>500,'Internal Error'];
        }

        if(empty($cid)){
            return ['code'=>300,'CID can not be empty'];
        }

        $sql = "DELETE from courses where seq = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$cid]);

        return ['code'=>200,'message'=>true];
    }

    public function update()
    {
        $updates = [];

        $cid = $this->request->get('cid');
        $courseName = $this->request->get('course_name');
        $startTime = $this->request->get('s_time');
        $endTime = $this->request->get('e_time');

        if($this->pdo == false){
            return ['code'=>500,'Internal Error'];
        }

        if(empty($cid)){
            return ['code'=>300,'CID can not be empty'];
        }

        $sql = "UPDATE courses set ";
        $params = [':cid'=>$cid];

        $fields = [
            'course_name'=>$courseName,
            'start_time'=>$startTime,
            'end_time'=>$endTime
        ];

        foreach($fields as $field=>$value){
            if(!empty($value)){
                $param = ':'.$field;
                $updates[] = "$field = $param";
                $params[$param] = $value;
            }
        }

        if(!empty($updates)){
            $sql .= implode(',',$updates)." where seq = :cid";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);

            return ['code'=>200,'message'=>true];
        }else{
            return ['code'=>300,'message'=>false];
        }
    }
}