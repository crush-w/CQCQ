<?php
namespace app\index\controller;

use \think\Db;
use \think\Request;
use \think\Session;

class Table extends BaseController
{
    public function table(){
		return $this->fetch();
	}
	public function add(){ 
		return $this->fetch();
	}
	public function edit(){ 
		return $this->fetch();
	}

	//返回表中所有宿舍信息
	public function informations(){
		Db::connect();
		$result = db('Student',[],false)->select();
		if ($result) {
            $return_data = array();
            $return_data['code'] = 0;
            $return_data['msg'] = '';
            $return_data['data']=$result;
			return json($return_data);
		}
	}

	//根据学号查找宿舍
	public function find_info(){
		$id = Request::instance()->post('id');
		$where = ['id' => $id];
		$data = Db('Student')
			->field('id,sex,phone,grade,department,dorm')
			->where($where)
			->find();

		if (!empty($data)) {
			$return_data = array();
            $return_data['error_code'] = 0;
			$return_data['msg'] = '查找成功！';
			$return_data['data'] = $data;
			return json($return_data['data']);
		} else {
			$return_data = array();
            $return_data['error_code'] = 1;
            $return_data['msg'] = '查无该学号！';
            return json($return_data);
		}
	}
	//添加单人信息
	public function add_e(){ 
		$id=Request::instance()->post('id');
		$sex=Request::instance()->post('sex');
		$username=Request::instance()->post('username');
		$password=Request::instance()->post('password');
		$email=Request::instance()->post('email');
		$phone=Request::instance()->post('phone');
		$grade=Request::instance()->post('grade');
		$department=Request::instance()->post('department');
		$dorm=Request::instance()->post('dorm');
		$where = ['id' => $id];
		$data_id = Db('Student')->where($where)->find();
		$data = 
		[
			'id' => $id,
			'sex' => $sex,
			'username' => $username,
			'password' => $password,
			'email' => $email,
			'phone' => $phone,
			'grade' => $grade,
			'department' => $department,
			'dorm' => $dorm,
		];
		
		if($data_id){
			$return_data = array();
            $return_data['error_code'] = 1;
			$return_data['msg'] = '添加失败';
			return json($return_data);
		}else{
			Db('Student')->insert($data);
			$return_data = array();
            $return_data['error_code'] = 0;
			$return_data['msg'] = '添加成功！';
			$return_data['data'] = $data;
			return json($return_data);
		}	
	}
	

}