<?php

namespace app\index\controller;

use think\Db;
use think\Validate;

class Change extends BaseController
{
    /**
     * 修改昵称
     */
    public function changeUsername()
    {
        $parameter = array();
        $parameter = ['id', 'username'];
        foreach ($parameter as $key => $value) {
            if (empty($_POST[$value])) {
                $return_data = array();
                $return_data['error_code'] = 1;
                $return_data['msg'] = '参数不足: ' . $value;
                return json($return_data);
            }
        }

        //验证规则（昵称）
        if (Db('student')->where(['id' => $_POST['id']])->find()) {
            $vusername = new Validate([['username', 'require|/^[A-Za-z0-9#\x{4e00}-\x{9fa5}]{6,16}$/u']]); // bug 汉字只占一个字符
        } else {
            $vusername = new Validate([['username', 'require|/^[A-Za-z0-9#\x{4e00}-\x{9fa5}]{3,16}$/u']]); // bug 汉字只占一个字符
        }
        $data = ['username' => $_POST['username']];

        //验证
        if (!$vusername->check($data)) {
            $return_data = array();
            $return_data['error_code'] = 2;
            $return_data['msg'] = '6-16个字符，只可包含汉字、数字、字母、#';
            return json($return_data);
        }

        if (Db('student')->where(['id' => $_POST['id']])->find()) {
            $result = Db('student')->where(['id' => $_POST['id']])->setField('username', $_POST['username']);
        } else {
            $result = Db('counselor')->where(['id' => $_POST['id']])->setField('username', $_POST['username']);
        }

        if ($result) {
            $return_data = array();
            $return_data['error_code'] = 0;
            $return_data['msg'] = '修改成功';
            $return_data['data']['id'] = $_POST['id'];
            $return_data['data']['username'] = $_POST['username'];
            return json($return_data);
        } else {
            // 更新数据执行失败
            $return_data = array();
            $return_data['error_code'] = 3;
            $return_data['msg'] = '修改失败';
            return json($return_data);
        }
    }
    /**
     * 修改年级
     */
    public function changeGrade()
    {
        // 校验参数是否存在
        $parameter = array();
        $parameter = ['id', 'grade'];
        foreach ($parameter as $key => $value) {
            if (empty($_POST[$value])) {
                $return_data = array();
                $return_data['error_code'] = 1;
                $return_data['msg'] = '参数不足: ' . $value;

                return json($return_data);
            }
        }
        //更新数据
        if (Db('student')->where(['id' => $_POST['id']])->find()) {
            $result = Db('student')->where(['id' => $_POST['id']])->setField('grade', $_POST['grade']);
        } else {
            $result = Db('counselor')->where(['id' => $_POST['id']])->setField('grade', $_POST['grade']);
        }

        if ($result) {
            $return_data = array();
            $return_data['error_code'] = 0;
            $return_data['msg'] = '修改成功';
            $return_data['data']['id'] = $_POST['id'];
            $return_data['data']['grade'] = $_POST['grade'];
            return json($return_data);
        } else {
            // 更新数据执行失败
            $return_data = array();
            $return_data['error_code'] = 2;
            $return_data['msg'] = '修改失败';
            return json($return_data);
        }
    }

    /**
     * 修改系
     */
    public function changeDepartment()
    {
        $parameter = array();
        $parameter = ['id', 'department'];
        foreach ($parameter as $key => $value) {
            if (empty($_POST[$value])) {
                $return_data = array();
                $return_data['error_code'] = 1;
                $return_data['msg'] = '参数不足: ' . $value;

                return json($return_data);
            }
        }
        //更新数据
        if (Db('student')->where(['id' => $_POST['id']])->find()) {
            $result = Db('student')->where(['id' => $_POST['id']])->setField('department', $_POST['department']);
        } else {
            $result = Db('counselor')->where(['id' => $_POST['id']])->setField('department', $_POST['department']);
        }
        if ($result) {
            $return_data = array();
            $return_data['error_code'] = 0;
            $return_data['msg'] = '修改成功';
            $return_data['data']['id'] = $_POST['id'];
            $return_data['data']['department'] = $_POST['department'];
            return json($return_data);
        } else {
            // 更新数据执行失败
            $return_data = array();
            $return_data['error_code'] = 2;
            $return_data['msg'] = '修改失败';
            return json($return_data);
        }
    }


    /**
     * 修改宿舍号
     */
    public function changeDormNumber()
    {
        $parameter = array();
        $parameter = ['student_id', 'block', 'room'];
        foreach ($parameter as $key => $value) {
            if (empty($_POST[$value])) {
                $return_data = array();
                $return_data['error_code'] = 1;
                $return_data['msg'] = '参数不足: ' . $value;

                return json($return_data);
            }
        }
        //更新数据
        $dormNumber = $_POST['block'] . '#' . $_POST['room'];
        $data = array('block' => $_POST['block'], 'room' => $_POST['room'], 'dormNumber' => $dormNumber);
        $result = Db('dorm')->where(['student_id' => $_POST['student_id']])->setField($data);

        if ($result) {
            $return_data = array();
            $return_data['error_code'] = 0;
            $return_data['msg'] = '修改成功';
            $return_data['data']['student_id'] = $_POST['student_id'];
            $return_data['data']['block'] = $_POST['block'];
            $return_data['data']['room'] = $_POST['room'];
            $return_data['data']['dormNumber'] = $dormNumber;
            return json($return_data);
        } else {
            // 更新数据执行失败
            $return_data = array();
            $return_data['error_code'] = 2;
            $return_data['msg'] = '修改失败';
            return json($return_data);
        }
    }

    /**
     * 修改头像
     */
    public function changeFace()
    {
        $parameter = array();
        $parameter = ['id', 'face_url'];
        foreach ($parameter as $key => $value) {
            if (!empty($_POST[$value]) || !empty($_FILES[$value])) {
            } else {
                $return_data = array();
                $return_data['error_code'] = 1;
                $return_data['msg'] = '参数不足: ' . $value;
                return json($return_data);
            }
        }
        $type = array("gif", "jpeg", "jpg", "png", "bmp");  // 允许上传的图片后缀
        $temp = explode(".", $_FILES['face_url']['name']);  // 拆分获取图片名
        $extension = $temp[count($temp) - 1];     // 获取文件后缀名

        if (in_array($extension, $type) && $_FILES["face_url"]["size"] < 5242880) {

            if ($_FILES["face_url"]["error"] > 0) {

                $return_data = array();
                $return_data['error_code'] = 3;
                $return_data['msg'] = '图片上传错误！';
                return json($return_data);
            } else {

                $new_file_name = $_POST['id']; //取名为id
                $new_name = $new_file_name . '.' . $extension; //新文件名
                $path = 'face_url/' . $new_name;        //face_url为保存头像目录
                if (file_exists("face_url/" . $path)) {   //判断是否存在该文件

                    $return_data = array();
                    $return_data['error_code'] = 4;
                    $return_data['msg'] = '图片已存在！';
                    return json($return_data);
                } else {

                    // 服务器须测试
                    // 如果不存在该文件则将文件上传到 face_url 目录下（将临时文件移动到 face_url 下以新文件名命名）
                    //move_uploaded_file($_FILES['face_url']['tmp_name'], "face_url/" . $new_name); 

                    //本地测试  //本地会覆盖原图
                    // $file = request()->file('face_url');
                    // $info = $file->move('/home/www/face_url/', $new_name);
                    // print_r($info);

                    // 上传到数据库
                    if (Db('student')->where(['id' => $_POST['id']])->find()) {
                        $result = Db('student')->where(['id' => $_POST['id']])->setField('face_url', "face_url/" . $new_name);
                    } else {
                        $result = Db('counselor')->where(['id' => $_POST['id']])->setField('face_url', "face_url/" . $new_name);
                    }
                    $return_data = array();
                    $return_data['error_code'] = 0;
                    $return_data['msg'] = '修改成功！';
                    $return_data['data']['id'] = $_POST['id'];
                    $return_data['data']['face_url'] = 'face_url/' . $new_name;
                    return json($return_data);
                }
            }
        } else {
            $return_data = array();
            $return_data['error_code'] = 2;
            $return_data['msg'] = '图片格式错误！';
            return json($return_data);
        }
    }

    /**
     * 修改密码
     */
    public function changePassword()
    {
        $parameter = array();
        $parameter = ['id', 'oldPassword', 'newPassword', 'password_again'];
        foreach ($parameter as $key => $value) {
            if (empty($_POST[$value])) {
                $return_data = array();
                $return_data['error_code'] = 1;
                $return_data['msg'] = '参数不足: ' . $value;
                return json($return_data);
            }
        }

        // 先从学生表中查询，若不存在从辅导员表中查询
        $user = Db('student')
            ->where(['id' => $_POST['id']])
            ->find();

        if (empty($user)) {
            $user = Db('counselor')
                ->where(['id' => $_POST['id']])
                ->find();
        }


        //判断原密码
        if (md5($_POST['oldPassword']) != $user['password']) {
            $return_data = array();
            $return_data['error_code'] = 2;
            $return_data['msg'] = '密码不正确，请重新输入';
            return json($return_data);
        }

        //判断两次密码是否一样
        if ($_POST['newPassword'] != $_POST['password_again']) {
            $return_data = array();
            $return_data['error_code'] = 3;
            $return_data['msg'] = '两次密码不一致';
            return json($return_data);
        }


        $data = [
            'newPassword' => $_POST['newPassword'],
            'password_again' => $_POST['password_again']
        ];

        // 验证规则（密码）
        $vpassword = new Validate([
            ['newPassword', 'require|/^[0-9a-zA-Z-#_*%$@!?^]{8,16}$/i'],
            ['password_again', 'require|/^[0-9a-zA-Z-#_*%$@!?^]{8,16}$/i']
        ]);

        //验证
        if (!$vpassword->check($data)) {
            $return_data = array();
            $return_data['error_code'] = 4;
            $return_data['msg'] = '8-16位长度，须包含数字、字母、符号至少2种或以上元素';
            return json($return_data);
        }

        //更新数据
        if (Db('student')->where(['id' => $_POST['id']])->find()) {
            $result = Db('student')->where(['id' => $_POST['id']])->setField('password', md5($_POST['newPassword']));
        } else {
            $result = Db('counselor')->where(['id' => $_POST['id']])->setField('password', md5($_POST['newPassword']));
        }

        if ($result) {
            $return_data = array();
            $return_data['error_code'] = 0;
            $return_data['msg'] = '修改成功';
            return json($return_data);
        } else {
            // 更新数据执行失败
            $return_data = array();
            $return_data['error_code'] = 5;
            $return_data['msg'] = '修改失败';
            return json($return_data);
        }
    }
}
