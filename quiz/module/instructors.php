<?php
namespace APIModule;

use connection\Database;
use APIModule\Common;
use APIModule\Request;
use PDO;

class Instructor
{
    private $pdo;
    private $request;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->request = new Request();
    }

    public function read()
    {
        if($this->pdo == false){
            return ['code'=>500,'Internal Error'];
        }

        $sql = "SELECT uc.username,c.course_name,c.start_time,c.end_time 
                from teachers_courses as tc
                left join courses as c on tc.course_id = c.seq
                left join users as uc on tc.teacher_id = uc.seq
                where uc.role = ? limit 2";
        $stmt = $this->pdo->prepare($sql);
        $values = [1];
        $stmt->execute($values);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }

    public function create()
    {
        $instructorName = $this->request->get('instructorName');
        $password = $this->request->get('password');

        if($this->pdo == false){
            return array('code'=>500,'Internal Error');
        }

        $conditions = [
            empty($instructorName)=>'Instructor can not be empty',
            empty($password)=>'Password can not be empty'
        ];

        foreach($conditions as $condition=>$message){
            if($condition){
                return ['code'=>300,'message'=>$message];
            }
        }

        $passwordHash = password_hash($password,PASSWORD_DEFAULT);

        $insAry = ['username'=>$instructorName,'password'=>$passwordHash,'role'=>1];
        $sql = "INSERT into users ".Common::sql_build_array('INSERT',$insAry);
        $stmt = $this->pdo->prepare($sql);

        if($stmt->execute() == false){
            return ['code'=>300,'message'=>'User create failed'];
        }

        return ['code'=>200,'message'=>'success'];
    }
}