<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Login Form</title>
    <link rel="stylesheet" href="./public/css/style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2>Prodent</h2>
                <p>Ingrese sus credenciales para acceder a su cuenta</p>
            </div>

            <form class="login-form" id="loginForm" novalidate>
                <!-- <div class="form-group">
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" required autocomplete="email">
                        <label for="email">Email Address</label>
                    </div>
                    <span class="error-message" id="emailError"></span>
                </div> -->

                <div class="form-group">
                    <div class="input-wrapper password-wrapper">
                        <input type="password" id="password" name="password" required autocomplete="current-password">
                        <label for="password">Password</label>
                        <button type="button" class="password-toggle" id="passwordToggle" aria-label="Show password" aria-pressed="false">
                            <span class="eye-icon"></span>
                        </button>
                    </div>
                    <span class="error-message" id="passwordError"></span>
                </div>

                <div class="form-options">
                    <label class="remember-wrapper">
                        <input type="checkbox" id="remember" name="remember">
                        <span class="checkbox-label">
                            <span class="checkmark"></span>
                            Recuerdame
                        </span>
                    </label>
                    <a href="#" class="forgot-password">¿Has olvidado tu contraseña?</a>
                </div>

                <button type="submit" class="login-btn">
                    <span class="btn-text">Iniciar sesión</span>
                    <span class="btn-loader"></span>
                </button>
            </form>

            <!-- <div class="signup-link">
                <p>Don't have an account? <a href="#">Create one</a></p>
            </div> -->

            <div class="success-message" id="successMessage">
                <div class="success-icon">✓</div>
                <h3>Login Successful!</h3>
                <p>Redirecting to your dashboard...</p>
            </div>
        </div>
    </div>

    <script src="./public/js/form-utils.js"></script>
    <script src="./public/js/script.js"></script>
</body>
</html>
