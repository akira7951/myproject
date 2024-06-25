<?php
namespace controller;

use APIModule\Request;
use APIModule\Course;
use APIModule\Instructor;
use APIModule\TEST;

class APIController extends Request
{
    private function handleGet($path,$type)
    {
        switch($path[0]){
            case 'courses':
                $Course = new Course();
                $result = $Course->$type();
                break;
            case 'instructors':
                $Instructors = new Instructor();
                $result = $Instructors->$type();
                break;
            default:
                $result = ['message'=>'Resource not found'];
                break;
        }

        return $result;
    }

    private function handlePost($path,$type)
    {
        switch($path[0]){
            case 'test':
                $Test = new TEST();
                $result = $Test->$type();
                break;
            default:
                $result = ['message'=>'Resource not found'];
                break;
        }

        return $result;
    }

    private function setPostHeader()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    }

    public function processRequest($method,$path)
    {
        $result = [];

        switch($method){
            case 'GET':
                if(empty($this->get('act'))){
                    return ['message'=>'Resource not found'];
                }else{
                    $type = $this->get('act');
                }

                $result = $this->handleGet($path,$type);
                break;
            case 'POST':
                $this->setPostHeader();
                if(empty($this->post('act'))){
                    return ['message'=>'Resource not found'];
                }else{
                    $type = $this->post('act');
                }

                $result = $this->handlePost($path,$type);
                break;
            default:
                http_response_code(405);
                $result = ['message'=>'Method not allowed'];
                break;
        }

        return $result;
    }
}