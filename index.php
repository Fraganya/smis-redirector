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
                    <form action="./switch.php" method="POST" role="form">
                        <legend>Enter Sample SMIS Details</legend>
                        <input type="hidden" name="challenge_key" value="base64:GgorEGxR1ZxcsqbQZZst6oz5m3ZYQu+5oHIM8IOIlaA=">
                
                        <div class="form-group">
                            <label for="">Registration Number</label>
                            <input type="text" class="form-control" id="reg-num" style=""   name="student_reg" placeholder="registration number">
                        </div>
                        <div class="form-group">
                            <label for="">Firstname</label>
                            <input type="text" class="form-control" id="firstname" name="first_name" placeholder="firstname">
                        </div>
                        <div class="form-group">
                            <label for="">Surname</label>
                            <input type="text" class="form-control" id="surname" name="last_name" placeholder="surname">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm" style="border-radius:0px;">
                            <i class="glyphicon glyphicon-export"></i>&nbsp;Login
                        </button>
                        <button type="button" id="fetch-btn" class="btn btn-primary btn-sm" style="border-radius:0px;">
                            <i class="glyphicon glyphicon-import"></i>&nbsp;Fetch
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