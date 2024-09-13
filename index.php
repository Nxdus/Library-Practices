<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Library - Store</title>
        
        <link rel="stylesheet" href="./styles/index.css">
    </head>

    <body>
        <h2 class="title">Library - Store</h2>

        <hr>

        <section class="login-section">
            <div class="login-box">
                <h2>Login</h2>
                
                <form action="./functions/login.php" method="POST">
                    <label for="username">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width: 32px; padding: 12px;">
                            <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                        </svg>
                        <input id="username" type="text" name="login-username" placeholder="Username" required>
                    </label>
                    <br>
                    <label for="password">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width: 32px; padding: 12px;">
                            <path fill-rule="evenodd" d="M8 7a5 5 0 113.61 4.804l-1.903 1.903A1 1 0 019 14H8v1a1 1 0 01-1 1H6v1a1 1 0 01-1 1H3a1 1 0 01-1-1v-2a1 1 0 01.293-.707L8.196 8.39A5.002 5.002 0 018 7zm5-3a.75.75 0 000 1.5A1.5 1.5 0 0114.5 7 .75.75 0 0016 7a3 3 0 00-3-3z" clip-rule="evenodd" />
                        </svg>
                        <input id="password" type="password" name="login-password" placeholder="Password" required>
                    </label>
                    <br>
                    <input type="submit" name="login-submit" value="Login">
                    <a href="./components/forgot_password.php">ลืมรหัสผ่าน ?</a>
                </form>
                
                <a href="./components/register.php">ยังไม่มีบัญชีผู้ใช้ ?</a>
            </div>

            <div class="text-box">
                <h2>ยินดีต้อนรับ</h2>
                <h4>เข้าสู่ระบบยืมคืนหนังสือ Library - Store</h4>
            </div>
        </section>
    </body>

</html>