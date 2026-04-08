<?php
session_start();

$dataFile = "../data/users.json";
$users = json_decode(file_get_contents($dataFile), true);

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    foreach ($users as $user) {
        if ($user['email'] == $email && $user['password'] == $password) {

            $_SESSION['login'] = true;
            $_SESSION['role'] = $user['role'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['nim']  = $user['nim'] ?? null;

            if ($user['role'] == 'admin') {
                header("Location: ../admin/dashboard.php");
            } elseif ($user['role'] == 'dosen') {
                header("Location: ../dosen/dashboard.php");
            } else {
                header("Location: ../mahasiswa/dashboard.php");
            }
            exit;
        }
    }

    $error = "Login gagal!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login SIAKAD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    height: 100vh;
    background: linear-gradient(135deg, #020c1b, #0a192f, #112240);
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Glass card */
.login-box {
    width: 370px;
    padding: 35px;
    border-radius: 18px;
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(10px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.3);
    animation: fadeIn 0.7s ease;
}

@keyframes fadeIn {
    from {opacity:0; transform: translateY(30px);}
    to {opacity:1; transform: translateY(0);}
}

h2 {
    text-align: center;
    color: #0a192f;
}

.subtitle {
    text-align: center;
    font-size: 13px;
    color: #666;
    margin-bottom: 25px;
}

/* Floating input */
.form-group {
    position: relative;
    margin-bottom: 22px;
}

.form-group input {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #ccc;
    outline: none;
    font-size: 14px;
    transition: 0.3s;
    background: transparent;
}

.form-group label {
    position: absolute;
    top: 12px;
    left: 12px;
    color: #888;
    font-size: 13px;
    background: white;
    padding: 0 5px;
    transition: 0.3s;
    pointer-events: none;
}

.form-group input:focus {
    border-color: #0a192f;
    box-shadow: 0 0 8px rgba(10,25,47,0.2);
}

.form-group input:focus + label,
.form-group input:valid + label {
    top: -8px;
    font-size: 11px;
    color: #0a192f;
}

/* Password toggle */
.password-wrapper {
    position: relative;
}

.toggle-password {
    position: absolute;
    right: 12px;
    top: 12px;
    cursor: pointer;
    font-size: 12px;
    color: #0a192f;
}

/* Button */
button {
    width: 100%;
    padding: 13px;
    border-radius: 10px;
    border: none;
    background: linear-gradient(135deg, #0a192f, #112240);
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

/* Loading state */
button.loading {
    opacity: 0.7;
    pointer-events: none;
}

/* Error */
.error {
    background: #ffe6e6;
    color: #cc0000;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 15px;
    text-align: center;
    font-size: 13px;
}

/* Footer */
.footer {
    text-align: center;
    margin-top: 18px;
    font-size: 12px;
    color: #999;
}

</style>
</head>

<body>

<div class="login-box">
    <h2>SIAKAD</h2>
    <h2>BISNIS DIGITAL</h2>
    <div class="subtitle">Login ke sistem akademik bisnis digital</div>

    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="POST" onsubmit="handleLogin()">
        
        <div class="form-group">
            <input type="email" name="email" required>
            <label>Email</label>
        </div>

        <div class="form-group password-wrapper">
            <input type="password" name="password" id="password" required>
            <label>Password</label>
            <span class="toggle-password" onclick="togglePassword()">👁</span>
        </div>

        <button id="loginBtn" name="login">Login</button>
    </form>

    <div class="footer">
        © 2026 Sistem Akademik
    </div>
</div>

<script>
function togglePassword() {
    var pass = document.getElementById("password");
    pass.type = pass.type === "password" ? "text" : "password";
}

function handleLogin() {
    const btn = document.getElementById("loginBtn");
    btn.classList.add("loading");
    btn.innerText = "Memproses...";
}
</script>

</body>
</html>