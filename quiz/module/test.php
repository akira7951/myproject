<?php
namespace APIModule;

use connection\Database;
use APIModule\Common;
use APIModule\Request;
use PDO;
use DateTime;

class TEST
{
    private $pdo;
    private $request;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->request = new Request();
    }

    public function setting()
    {
        $emp_info = array(
            [
                'firstName'=>'John',
                'lastName'=>'Doe',
                'age'=>42,
                'gender'=>'M',
                'emp_id'=>'R432',
                'email'=>'johndoe@gmail.com'
            ],
            [
                'firstName'=>'Lily',
                'lastName'=>'Chen',
                'age'=>28,
                'gender'=>'F',
                'emp_id'=>'R411',
                'email'=>'lilychen@gmail.com'
            ],
            [
                'firstName'=>'Mark',
                'lastName'=>'Ma',
                'age'=>40,
                'gender'=>'M',
                'emp_id'=>'R430',
                'email'=>'markma@gmail.com'
            ]
        );

        $format = [];
        foreach($emp_info as $emp){
            $format[$emp['emp_id']] = [
                'firstName'=>$emp['firstName'],
                'lastName'=>$emp['lastName'],
                'gender'=>$emp['gender'],
                'email'=>$emp['email']
            ];
        }

        return $format;
    }
}