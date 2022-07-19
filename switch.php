<?php
$app_key = "base64:GgorEGxR1ZxcsqbQZZst6oz5m3ZYQu+5oHIM8IOIlaA=";

$student_reg = $_POST["student_reg"];
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];

$challenge_key = md5($app_key."-".$student_reg);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>PSU-Middleware</title>
</head>

<body>
<nav class="navbar navbar-inverse" role="navigation" style="border-radius:0px;">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".main-nav">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="." style="color:#fff;">
                <i class="fa fa-desktop"></i>&nbsp;SMIS Redirector
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse main-nav">
            <ul class="nav navbar-nav navbar-right">
                <p class="navbar-text" style="color:#fff;">Smart APIs</p>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>
    <div class="container">
        <div class="col-sm-3">

        </div>
        <div class="col-sm-6">
            <div class="panel panel-default" style="margin-top:50px;background-color:#fafafa;border-radius:0px;">
                <div class="panel-body">
                    <form action="http://localhost:8000/student-auth/login" method="POST" role="form">
                        <legend>Logged In</legend>
                        <input type="hidden" name="challenge_key" value="<?php echo $challenge_key;?>">
                        <input type="hidden" name="student_reg" value="<?php echo $student_reg;?>">
                        <input type="hidden" name="first_name" value="<?php echo $first_name;?>">
                        <input type="hidden" name="last_name" value="<?php echo $last_name;?>">

                        <button type="submit" class="btn btn-primary btn-sm" style="border-radius:0px;">
                            <i class="glyphicon glyphicon-export"></i>&nbsp;Go to PSU-MIS
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>


<script src="./assets/js/jquery-2.1.3.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $("#fetch-btn").on('click',function(){
            var fetch_url = "http://localhost:8082/students/get/random";
            console.log(fetch_url);
            $.ajax({
                url:fetch_url,
                type:"GET",
                success:function(data,err){
                    var bits = data.reg_num.toString().split("/");
                    var username = bits[0]+bits[1]+"-"+data.firstname.toString().charAt(0)+data.surname;
                    $("#username").val(username.toString().toLowerCase());
                    $("#reg-num").val(data.reg_num);
                    $("#student-id").val(data.id);
                    $("#firstname").val(data.firstname);
                    $("#surname").val(data.surname);

                },
                error:function(err){
                    console.log(err.toString());
                }
            })
        });
    })
</script>
</body>

</html>