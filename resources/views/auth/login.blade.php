<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - تسجيل الدخول</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=tajawal:300,400,500,700" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Tajawal', sans-serif;
        }

        :root {
            --primary-color: #4361ee;
            --primary-dark: #3a56d4;
            --secondary-color: #7209b7;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --gray-color: #6c757d;
            --success-color: #4cc9f0;
            --error-color: #f72585;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --border-radius: 16px;
            --transition: all 0.3s ease;
        }

        body {
            background-color: #f5f7ff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background-image: linear-gradient(135deg, #f5f7ff 0%, #e3e6ff 100%);
        }

        .login-container {
            width: 100%;
            max-width: 480px;
            margin: 0 auto;
        }

        .login-card {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .login-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .login-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .logo-icon {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .logo-icon i {
            font-size: 30px;
            color: white;
        }

        .login-header h1 {
            color: var(--dark-color);
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .login-header p {
            color: var(--gray-color);
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            display: block;
            color: var(--dark-color);
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 15px;
            transition: var(--transition);
        }

        .input-with-icon {
            position: relative;
        }

        .input-icon {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-color);
            font-size: 18px;
        }

        .form-control {
            width: 100%;
            padding: 16px 50px 16px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 16px;
            transition: var(--transition);
            background-color: #f8fafc;
            color: var(--dark-color);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: white;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        .form-control.error {
            border-color: var(--error-color);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            position: relative;
            cursor: pointer;
        }

        .checkbox-container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .checkmark {
            width: 20px;
            height: 20px;
            border: 2px solid #cbd5e0;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .checkbox-container input:checked ~ .checkmark {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .checkmark:after {
            content: "✓";
            color: white;
            font-size: 14px;
            font-weight: bold;
            opacity: 0;
            transition: var(--transition);
        }

        .checkbox-container input:checked ~ .checkmark:after {
            opacity: 1;
        }

        .checkbox-label {
            color: var(--dark-color);
            font-size: 15px;
            margin-right: 8px;
        }

        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: var(--transition);
        }

        .forgot-password:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .login-button {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .login-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e2e8f0;
            color: var(--gray-color);
            font-size: 15px;
        }

        .footer-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .footer-link:hover {
            text-decoration: underline;
        }

        .error-message {
            color: var(--error-color);
            font-size: 14px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .session-status {
            background-color: #d1fae5;
            color: #065f46;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            text-align: center;
        }

        .session-status.success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .session-status.error {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .password-toggle {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-color);
            cursor: pointer;
            font-size: 18px;
        }

        /* تصميم متجاوب */
        @media (max-width: 576px) {
            .login-card {
                padding: 30px 25px;
            }

            .login-header h1 {
                font-size: 24px;
            }

            .remember-forgot {
                flex-direction: column;
                align-items: flex-start;
            }

            .forgot-password {
                margin-top: 5px;
            }
        }

        .login-card:before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        .form-group.focused .form-label {
            color: var(--primary-color);
        }

        .text-input-error {
            border-color: var(--error-color) !important;
        }

        .input-error {
            color: var(--error-color);
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Session Status -->
        @if (session('status'))
            <div class="session-status success">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="session-status error">
                {{ session('error') }}
            </div>
        @endif

        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">
                    <div class="logo-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                </div>
                <h1>{{ __('تسجيل الدخول') }}</h1>
                <p>{{ __('أدخل بيانات الدخول للوصول إلى حسابك') }}</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">{{ __('البريد الإلكتروني') }}</label>
                    <div class="input-with-icon">
                        <span class="input-icon"><i class="fas fa-envelope"></i></span>
                        <input 
                            id="email" 
                            class="form-control @error('email') error @enderror" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus 
                            autocomplete="username"
                            placeholder="أدخل بريدك الإلكتروني"
                        >
                    </div>
                    @error('email')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            <span class="error-text">{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">{{ __('كلمة المرور') }}</label>
                    <div class="input-with-icon">
                        <span class="input-icon"><i class="fas fa-key"></i></span>
                        <input 
                            id="password" 
                            class="form-control @error('password') error @enderror"
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="current-password"
                            placeholder="أدخل كلمة المرور"
                        >
                        <span id="passwordToggle" class="password-toggle">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    @error('password')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            <span class="error-text">{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="remember-forgot">
                    <div class="remember-me">
                        <label class="checkbox-container">
                            <input id="remember_me" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            <span class="checkbox-label">{{ __('تذكرني') }}</span>
                        </label>
                    </div>
                    <div>
                        @if (Route::has('password.request'))
                            <a class="forgot-password" href="{{ route('password.request') }}">
                                {{ __('نسيت كلمة المرور؟') }}
                            </a>
                        @endif
                    </div>
                </div>

                <button type="submit" class="login-button">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>{{ __('تسجيل الدخول') }}</span>
                </button>
            </form>

            @if (Route::has('register'))
                <div class="login-footer">
                    <p>{{ __('ليس لديك حساب؟') }} <a href="{{ route('register') }}" class="footer-link">{{ __('إنشاء حساب جديد') }}</a></p>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // إظهار/إخفاء كلمة المرور
            const passwordToggle = document.getElementById('passwordToggle');
            const passwordInput = document.getElementById('password');
            
            if (passwordToggle && passwordInput) {
                passwordToggle.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    // تغيير الأيقونة
                    const icon = this.querySelector('i');
                    if (type === 'text') {
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            }
            
            // تأثيرات التركيز على الحقول
            const formControls = document.querySelectorAll('.form-control');
            formControls.forEach(control => {
                const formGroup = control.closest('.form-group');
                
                control.addEventListener('focus', function() {
                    formGroup.classList.add('focused');
                });
                
                control.addEventListener('blur', function() {
                    if (!this.value) {
                        formGroup.classList.remove('focused');
                    }
                });
                
                // إضافة focused class إذا كان الحقل مملوء بالفعل
                if (control.value) {
                    formGroup.classList.add('focused');
                }
            });
            
            // إخفاء رسائل الخطأ عند التركيز على الحقل
            const errorMessages = document.querySelectorAll('.error-message');
            formControls.forEach(control => {
                control.addEventListener('focus', function() {
                    const formGroup = this.closest('.form-group');
                    const errorMessage = formGroup.querySelector('.error-message');
                    if (errorMessage) {
                        errorMessage.style.display = 'none';
                    }
                });
            });
            
            // التحقق من صحة النموذج قبل الإرسال (client-side validation)
            const loginForm = document.querySelector('form');
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    let isValid = true;
                    const email = document.getElementById('email');
                    const password = document.getElementById('password');
                    
                    // التحقق من البريد الإلكتروني
                    if (!email.value.trim()) {
                        showError(email, 'البريد الإلكتروني مطلوب');
                        isValid = false;
                    } else if (!isValidEmail(email.value)) {
                        showError(email, 'البريد الإلكتروني غير صالح');
                        isValid = false;
                    }
                    
                    // التحقق من كلمة المرور
                    if (!password.value.trim()) {
                        showError(password, 'كلمة المرور مطلوبة');
                        isValid = false;
                    }
                    
                    if (!isValid) {
                        e.preventDefault();
                    }
                });
            }
            
            function showError(input, message) {
                const formGroup = input.closest('.form-group');
                let errorDiv = formGroup.querySelector('.custom-error');
                
                if (!errorDiv) {
                    errorDiv = document.createElement('div');
                    errorDiv.className = 'error-message custom-error';
                    errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i><span class="error-text">${message}</span>`;
                    formGroup.appendChild(errorDiv);
                } else {
                    errorDiv.querySelector('.error-text').textContent = message;
                }
                
                input.classList.add('error');
            }
            
            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }
            
            // Auto-hide session messages after 5 seconds
            const sessionMessages = document.querySelectorAll('.session-status');
            sessionMessages.forEach(message => {
                setTimeout(() => {
                    message.style.transition = 'opacity 0.5s ease';
                    message.style.opacity = '0';
                    setTimeout(() => {
                        message.style.display = 'none';
                    }, 500);
                }, 5000);
            });
        });
    </script>
</body>
</html>