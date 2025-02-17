<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Admin | Online Voting System</title>
    <center><h1>ONLINE VOTING SYSTEM FOR SPORT's MANAGEMENT</h1></center>
    <?php include('./header.php'); ?>
    <?php 
    session_start();
    if(isset($_SESSION['login_id'])) 
        header("location:index.php?page=home");
    ?>
    
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: #f5f5f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .image-container {
            width: 100%;
            max-width: 600px;
            text-align: center;
            margin-bottom: 20px;
        }

        .image-container img {
            width: 100%;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
        }

        .form-control:focus {
            border-color: #3498db;
        }

        button.btn {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
        }

        button.btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="image-container">
        <img src="assets/img/vignan.jpg" alt="University Image">
    </div>
    
    <div class="login-container">
        <form id="login-form">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#login-form').submit(function(e){
            e.preventDefault();
            $('button.btn').attr('disabled',true).html('Logging in...');
            $('.alert-danger').remove();
            $.ajax({
                url:'ajax.php?action=login',
                method:'POST',
                data:$(this).serialize(),
                error:err=>{
                    console.log(err);
                    $('button.btn').removeAttr('disabled').html('Login');
                },
                success:function(resp){
                    if(resp == 1){
                        location.href = 'index.php?page=home';
                    } else if(resp == 2){
                        location.href = 'voting.php';
                    } else {
                        $('.login-container').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>');
                        $('button.btn').removeAttr('disabled').html('Login');
                    }
                }
            })
        })
    </script>
</body>
</html>
