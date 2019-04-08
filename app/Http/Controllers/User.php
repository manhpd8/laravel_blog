<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User extends Controller
{
	public function lan_people(){
        $lan = new People();
        $lan->setName('Nguyen thi lan');
        $lan->getName();
        echo "string";
    }

    public function newUser($name, $age){
        echo 'xin chao'.$name.' tuoi: '.$age;
    }

    public function directPageUser(){
        $data['user'] = 'sdf';
        $data['age'] = 12;
        return view('userView',$data);
    }
}

/**
 * 
 */
class People
{
    var $name;
    var $age;
    public function getName(){
        return $this->name;
    }
    public function setName($arg){
        $this->name = $arg;
    }
    public function setAge($arg){
        $this->age = $arg;
    }
    public function getAge(){
        return $this->age;
    }
}
