<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Admin | Online Voting System</title>
    
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
            position: relative;
            height: 100vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #000;
        }

        .content-container {
            text-align: center;
            z-index: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 80%;
        }

        .background-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        h1 {
            font-size: 50px;
            font-weight: bold;
            color: white;
            margin-bottom: 30px;
        }

        .form-container {
            width: 100%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 1;
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

        .toggle-link {
            margin-top: 15px;
            font-size: 16px;
        }

        .toggle-link a {
            color: #3498db;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <video autoplay muted loop class="background-video">
        <source src="assets/img/WhatsApp Video 2025-02-18 at 10.09.29_21d4e56d.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="content-container">
        <h1>ONLINE VOTING SYSTEM FOR SPORT'S MANAGEMENT</h1>

        <div class="form-container" id="login-form-container">
            <form id="login-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            <p class="toggle-link">Don't have an account? <a onclick="toggleForms()">Register here</a></p>
        </div>

        <div class="form-container" id="register-form-container" style="display: none;">
            <form id="register-form">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="register-username" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="register-password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn">Register</button>
            </form>
            <p class="toggle-link">Already have an account? <a onclick="toggleForms()">Login here</a></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function toggleForms() {
            $('#login-form-container').toggle();
            $('#register-form-container').toggle();
        }

        $('#login-form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'ajax.php?action=login',
                method: 'POST',
                data: $(this).serialize(),
                success: function(resp) {
                    if (resp == 1) location.href = 'index.php?page=home';
                    else if (resp == 2) location.href = 'voting.php';
                    else alert('Invalid login credentials');
                }
            });
        });

        $('#register-form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'ajax.php?action=register',
                method: 'POST',
                data: $(this).serialize(),
                success: function(resp) {
                    if (resp == 'success') {
                        alert('Registration successful! Redirecting to voting page...');
                        window.location.href = 'voting.php';
                    } else {
                        alert('Registration failed. Try again.');
                    }
                }
            });
        });
    </script>
</body>
</html>
