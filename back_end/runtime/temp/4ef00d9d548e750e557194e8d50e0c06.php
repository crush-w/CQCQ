<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"E:\phpstudy_pro\WWW\CQCQ\back_end\public/../application/index\view\table\file.html";i:1594181339;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/cqcq/back_end/public/lib/layui-v2.5.5/css/layui.css" media="all">
    <link rel="stylesheet" href="/cqcq/back_end/public/css/public.css" media="all">
    <style>
        body {
            background-color: #ffffff;
        }

        .file-box{ position:relative;width:340px;margin:20px;}
        .txt{ height:28px;line-height:28px; border:1px solid #cdcdcd; width:180px;}
        .btn{width:70px; color:#fff;background-color:#3598dc; border:0 none;height:28px; line-height:16px!important;cursor:pointer;}
        .btn:hover{background-color:#63bfff;color:#fff;}
        .file{ 
            position:absolute; 
            top:0; 
            right:85px; 
            height:30px;
            line-height:30px; 
            filter: alpha(opacity=0);
            opacity: 0;
            width:254px ;
        }

    </style>
    
</head>

<body>
    <meta charset="UTF-8">        
    <div class="file-box"> 
        <form id="uploadForm" action="index.php?s=index/Table/uploadFile" enctype="multipart/form-data" method="post"> 
            <input type="text" id="textfield" class="txt" />
            <input type="button" class="btn" value="浏览..." /> 
            <input type="file" name="upfile" class="file" id="upfile" onchange="document.getElementById('textfield').value=this.files[0].name"/> 
            <input type="submit" class="btn" value="上传" /> 
        </form> 
    </div>
              
    
    <script src="/cqcq/back_end/public/lib/layui-v2.5.5/layui.js" charset="utf-8"></script>
    <script>
        // console.log(document.getElementById("filetext").innerHTML);
        // console.log(document.getElementById("upfile"));
        layui.use(['form'], function () {
            var form = layui.form,
                layer = layui.layer,
                $ = layui.$;

            //监听提交
            // form.on('submit(saveBtn)', function (data) {
            //     console.log(data);
            //     // var upfile = JSON.stringify(data['field'].upfile);
            //     var upfile = data['field'].upfile;
            //     // window.location = "index.php?s=index/Table/uploadFile&upfile=" + upfile;
            //     // console.log(upfile);
            // });

        });

    </script>
</body>

</html>

