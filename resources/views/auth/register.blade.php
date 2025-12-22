<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - إنشاء حساب جديد</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=tajawal:300,400,500,700" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
            --accent-color: #4cc9f0;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --gray-color: #6c757d;
            --success-color: #38b000;
            --error-color: #f72585;
            --warning-color: #ff9e00;
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

        .register-container {
            width: 100%;
            max-width: 520px;
            margin: 0 auto;
        }

        .register-card {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .register-card:before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--accent-color), var(--secondary-color));
        }

        .register-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .register-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .logo-icon {
            background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
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

        .register-header h1 {
            color: var(--dark-color);
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .register-header p {
            color: var(--gray-color);
            font-size: 16px;
            line-height: 1.6;
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

        .form-label.required:after {
            content: ' *';
            color: var(--error-color);
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
            border-color: var(--accent-color);
            background-color: white;
            box-shadow: 0 0 0 3px rgba(76, 201, 240, 0.1);
        }

        .form-control.error {
            border-color: var(--error-color);
        }

        .form-control.success {
            border-color: var(--success-color);
        }

        .password-strength {
            margin-top: 8px;
            display: none;
        }

        .strength-meter {
            height: 6px;
            background-color: #e2e8f0;
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            border-radius: 3px;
            transition: var(--transition);
        }

        .strength-text {
            font-size: 12px;
            color: var(--gray-color);
        }

        .password-match {
            margin-top: 8px;
            font-size: 13px;
            display: none;
        }

        .password-match.matching {
            color: var(--success-color);
        }

        .password-match.not-matching {
            color: var(--error-color);
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

        .terms-section {
            margin-bottom: 30px;
            padding: 15px;
            background-color: #f8fafc;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }

        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .terms-checkbox input[type="checkbox"] {
            margin-top: 3px;
            accent-color: var(--accent-color);
        }

        .terms-label {
            font-size: 14px;
            color: var(--dark-color);
            line-height: 1.5;
        }

        .terms-link {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 500;
        }

        .terms-link:hover {
            text-decoration: underline;
        }

        .register-button {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
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
            margin-bottom: 25px;
        }

        .register-button:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(76, 201, 240, 0.3);
        }

        .register-button:active:not(:disabled) {
            transform: translateY(0);
        }

        .register-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .login-link-section {
            text-align: center;
            padding-top: 25px;
            border-top: 1px solid #e2e8f0;
        }

        .login-link {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .login-link:hover {
            color: var(--secondary-color);
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

        .session-status.warning {
            background-color: #fef3c7;
            color: #92400e;
        }

        .form-group.focused .form-label {
            color: var(--accent-color);
        }

        .password-requirements {
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #f8fafc;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            font-size: 13px;
            color: var(--gray-color);
        }

        .requirement {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 5px;
        }

        .requirement i {
            font-size: 12px;
        }

        .requirement.met {
            color: var(--success-color);
        }

        .requirement.not-met {
            color: var(--gray-color);
        }

        @media (max-width: 576px) {
            .register-card {
                padding: 30px 25px;
            }

            .register-header h1 {
                font-size: 24px;
            }

            .terms-section {
                padding: 12px;
            }
        }

        .progress-animation {
            animation: progressFill 0.5s ease-out forwards;
        }

        @keyframes progressFill {
            from { width: 0%; }
            to { width: var(--target-width); }
        }
    </style>
</head>
<body>
    <div class="register-container">
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

        <div class="register-card">
            <div class="register-header">
                <div class="register-logo">
                    <div class="logo-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
                <h1>{{ __('إنشاء حساب جديد') }}</h1>
                <p>{{ __('انضم إلينا وابدأ رحلتك معنا') }}</p>
            </div>

            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label for="name" class="form-label required">{{ __('الاسم الكامل') }}</label>
                    <div class="input-with-icon">
                        <span class="input-icon"><i class="fas fa-user"></i></span>
                        <input 
                            id="name" 
                            class="form-control @error('name') error @enderror" 
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}" 
                            required 
                            autofocus 
                            autocomplete="name"
                            placeholder="أدخل اسمك الكامل"
                        >
                    </div>
                    @error('name')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            <span class="error-text">{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label required">{{ __('البريد الإلكتروني') }}</label>
                    <div class="input-with-icon">
                        <span class="input-icon"><i class="fas fa-envelope"></i></span>
                        <input 
                            id="email" 
                            class="form-control @error('email') error @enderror" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autocomplete="email"
                            placeholder="example@domain.com"
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
                    <label for="password" class="form-label required">{{ __('كلمة المرور') }}</label>
                    <div class="input-with-icon">
                        <span class="input-icon"><i class="fas fa-key"></i></span>
                        <input 
                            id="password" 
                            class="form-control @error('password') error @enderror"
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="new-password"
                            placeholder="أنشئ كلمة مرور قوية"
                        >
                        <span id="passwordToggle" class="password-toggle">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    
                    <!-- Password Strength Meter -->
                    <div class="password-strength" id="passwordStrength">
                        <div class="strength-meter">
                            <div class="strength-fill" id="strengthFill"></div>
                        </div>
                        <div class="strength-text" id="strengthText"></div>
                    </div>
                    
                    <!-- Password Requirements -->
                    <div class="password-requirements" id="passwordRequirements">
                        <div class="requirement" id="reqLength">
                            <i class="fas fa-circle"></i>
                            <span>8 أحرف على الأقل</span>
                        </div>
                        <div class="requirement" id="reqUppercase">
                            <i class="fas fa-circle"></i>
                            <span>حرف كبير واحد على الأقل</span>
                        </div>
                        <div class="requirement" id="reqLowercase">
                            <i class="fas fa-circle"></i>
                            <span>حرف صغير واحد على الأقل</span>
                        </div>
                        <div class="requirement" id="reqNumber">
                            <i class="fas fa-circle"></i>
                            <span>رقم واحد على الأقل</span>
                        </div>
                        <div class="requirement" id="reqSpecial">
                            <i class="fas fa-circle"></i>
                            <span>رمز خاص واحد على الأقل</span>
                        </div>
                    </div>
                    
                    @error('password')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            <span class="error-text">{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label required">{{ __('تأكيد كلمة المرور') }}</label>
                    <div class="input-with-icon">
                        <span class="input-icon"><i class="fas fa-key"></i></span>
                        <input 
                            id="password_confirmation" 
                            class="form-control @error('password_confirmation') error @enderror"
                            type="password" 
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password"
                            placeholder="أعد إدخال كلمة المرور"
                        >
                        <span id="confirmPasswordToggle" class="password-toggle">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    <div class="password-match" id="passwordMatch"></div>
                    @error('password_confirmation')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            <span class="error-text">{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Terms and Conditions -->
                <div class="terms-section">
                    <div class="terms-checkbox">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms" class="terms-label">
                            {{ __('أوافق على') }} 
                            <a href="#" class="terms-link">{{ __('الشروط والأحكام') }}</a>
                            {{ __('و') }}
                            <a href="#" class="terms-link">{{ __('سياسة الخصوصية') }}</a>
                        </label>
                    </div>
                    @error('terms')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            <span class="error-text">{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <button type="submit" class="register-button" id="registerButton">
                    <i class="fas fa-user-plus"></i>
                    <span>{{ __('إنشاء حساب') }}</span>
                </button>
            </form>

            <div class="login-link-section">
                <a class="login-link" href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>{{ __('لديك حساب بالفعل؟ سجل الدخول') }}</span>
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // عناصر DOM
            const registerForm = document.getElementById('registerForm');
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const passwordToggle = document.getElementById('passwordToggle');
            const confirmPasswordToggle = document.getElementById('confirmPasswordToggle');
            const passwordStrength = document.getElementById('passwordStrength');
            const strengthFill = document.getElementById('strengthFill');
            const strengthText = document.getElementById('strengthText');
            const passwordMatch = document.getElementById('passwordMatch');
            const registerButton = document.getElementById('registerButton');
            const termsCheckbox = document.getElementById('terms');
            const passwordRequirements = document.getElementById('passwordRequirements');
            
            // متطلبات كلمة المرور
            const requirements = {
                length: document.getElementById('reqLength'),
                uppercase: document.getElementById('reqUppercase'),
                lowercase: document.getElementById('reqLowercase'),
                number: document.getElementById('reqNumber'),
                special: document.getElementById('reqSpecial')
            };
            
            // إظهار/إخفاء كلمة المرور
            if (passwordToggle && passwordInput) {
                passwordToggle.addEventListener('click', function() {
                    togglePasswordVisibility(passwordInput, this);
                });
            }
            
            if (confirmPasswordToggle && confirmPasswordInput) {
                confirmPasswordToggle.addEventListener('click', function() {
                    togglePasswordVisibility(confirmPasswordInput, this);
                });
            }
            
            function togglePasswordVisibility(input, toggleBtn) {
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                
                const icon = toggleBtn.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            }
            
            // التحقق من قوة كلمة المرور
            passwordInput.addEventListener('input', function() {
                checkPasswordStrength(this.value);
                checkPasswordMatch();
                updatePasswordRequirements(this.value);
                updateFormValidity();
            });
            
            confirmPasswordInput.addEventListener('input', function() {
                checkPasswordMatch();
                updateFormValidity();
            });
            
            termsCheckbox.addEventListener('change', function() {
                updateFormValidity();
            });
            
            // تأثير التركيز على الحقول
            const formControls = document.querySelectorAll('.form-control');
            formControls.forEach(control => {
                const formGroup = control.closest('.form-group');
                
                control.addEventListener('focus', function() {
                    formGroup.classList.add('focused');
                    hideError(this);
                });
                
                control.addEventListener('blur', function() {
                    if (!this.value) {
                        formGroup.classList.remove('focused');
                    }
                    validateField(this);
                });
                
                // إضافة focused class إذا كان الحقل مملوء بالفعل
                if (control.value) {
                    formGroup.classList.add('focused');
                }
            });
            
            // تحقق من قوة كلمة المرور
            function checkPasswordStrength(password) {
                if (!password) {
                    passwordStrength.style.display = 'none';
                    strengthFill.style.width = '0%';
                    return;
                }
                
                passwordStrength.style.display = 'block';
                
                let strength = 0;
                let messages = [];
                
                // طول كلمة المرور
                if (password.length >= 8) {
                    strength += 20;
                    if (password.length >= 12) strength += 10;
                }
                
                // أحرف كبيرة
                if (/[A-Z]/.test(password)) {
                    strength += 20;
                }
                
                // أحرف صغيرة
                if (/[a-z]/.test(password)) {
                    strength += 20;
                }
                
                // أرقام
                if (/[0-9]/.test(password)) {
                    strength += 20;
                }
                
                // رموز خاصة
                if (/[^A-Za-z0-9]/.test(password)) {
                    strength += 20;
                }
                
                // تحديث شريط القوة
                strengthFill.style.width = strength + '%';
                strengthFill.classList.add('progress-animation');
                
                // تحديث نص القوة
                let strengthMessage = '';
                let fillColor = '';
                
                if (strength < 40) {
                    strengthMessage = 'ضعيفة';
                    fillColor = '#f72585';
                } else if (strength < 70) {
                    strengthMessage = 'متوسطة';
                    fillColor = '#ff9e00';
                } else if (strength < 90) {
                    strengthMessage = 'جيدة';
                    fillColor = '#4cc9f0';
                } else {
                    strengthMessage = 'قوية جداً';
                    fillColor = '#38b000';
                }
                
                strengthFill.style.backgroundColor = fillColor;
                strengthText.textContent = `قوة كلمة المرور: ${strengthMessage}`;
                strengthText.style.color = fillColor;
                
                // إزالة class التحريك بعد الانتهاء
                setTimeout(() => {
                    strengthFill.classList.remove('progress-animation');
                }, 500);
            }
            
            // التحقق من تطابق كلمتي المرور
            function checkPasswordMatch() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;
                
                if (!password || !confirmPassword) {
                    passwordMatch.style.display = 'none';
                    confirmPasswordInput.classList.remove('success', 'error');
                    return;
                }
                
                passwordMatch.style.display = 'block';
                
                if (password === confirmPassword) {
                    passwordMatch.textContent = 'كلمتا المرور متطابقتان ✓';
                    passwordMatch.className = 'password-match matching';
                    confirmPasswordInput.classList.remove('error');
                    confirmPasswordInput.classList.add('success');
                } else {
                    passwordMatch.textContent = 'كلمتا المرور غير متطابقتان ✗';
                    passwordMatch.className = 'password-match not-matching';
                    confirmPasswordInput.classList.remove('success');
                    confirmPasswordInput.classList.add('error');
                }
            }
            
            // تحديث متطلبات كلمة المرور
            function updatePasswordRequirements(password) {
                const checks = {
                    length: password.length >= 8,
                    uppercase: /[A-Z]/.test(password),
                    lowercase: /[a-z]/.test(password),
                    number: /[0-9]/.test(password),
                    special: /[^A-Za-z0-9]/.test(password)
                };
                
                // تحديث كل شرط
                Object.keys(checks).forEach(key => {
                    const requirement = requirements[key];
                    const met = checks[key];
                    
                    requirement.classList.toggle('met', met);
                    requirement.classList.toggle('not-met', !met);
                    
                    const icon = requirement.querySelector('i');
                    icon.className = met ? 'fas fa-check-circle' : 'fas fa-circle';
                    icon.style.color = met ? 'var(--success-color)' : 'var(--gray-color)';
                });
            }
            
            // التحقق من صحة الحقل
            function validateField(field) {
                const value = field.value.trim();
                const fieldId = field.id;
                let isValid = true;
                let errorMessage = '';
                
                if (fieldId === 'name') {
                    if (!value) {
                        errorMessage = 'الاسم مطلوب';
                        isValid = false;
                    } else if (value.length < 2) {
                        errorMessage = 'الاسم يجب أن يكون على الأقل حرفين';
                        isValid = false;
                    }
                }
                
                if (fieldId === 'email') {
                    if (!value) {
                        errorMessage = 'البريد الإلكتروني مطلوب';
                        isValid = false;
                    } else if (!isValidEmail(value)) {
                        errorMessage = 'البريد الإلكتروني غير صالح';
                        isValid = false;
                    }
                }
                
                if (fieldId === 'password') {
                    if (!value) {
                        errorMessage = 'كلمة المرور مطلوبة';
                        isValid = false;
                    } else if (value.length < 8) {
                        errorMessage = 'كلمة المرور يجب أن تكون 8 أحرف على الأقل';
                        isValid = false;
                    }
                }
                
                if (fieldId === 'password_confirmation') {
                    if (!value) {
                        errorMessage = 'تأكيد كلمة المرور مطلوب';
                        isValid = false;
                    } else if (passwordInput.value !== value) {
                        errorMessage = 'كلمتا المرور غير متطابقتان';
                        isValid = false;
                    }
                }
                
                if (!isValid) {
                    showError(field, errorMessage);
                }
                
                return isValid;
            }
            
            // التحقق من صحة البريد الإلكتروني
            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }
            
            // عرض رسالة الخطأ
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
                    errorDiv.style.display = 'flex';
                }
                
                input.classList.add('error');
            }
            
            // إخفاء رسالة الخطأ
            function hideError(input) {
                const formGroup = input.closest('.form-group');
                const errorDiv = formGroup.querySelector('.custom-error');
                if (errorDiv) {
                    errorDiv.style.display = 'none';
                }
                input.classList.remove('error');
            }
            
            // تحديث حالة زر التسجيل
            function updateFormValidity() {
                const isFormValid = 
                    nameInput.value.trim() && 
                    emailInput.value.trim() && 
                    isValidEmail(emailInput.value) &&
                    passwordInput.value.length >= 8 &&
                    passwordInput.value === confirmPasswordInput.value &&
                    termsCheckbox.checked;
                
                registerButton.disabled = !isFormValid;
            }
            
            // التحقق من صحة النموذج عند الإرسال
            registerForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                let isValid = true;
                
                // التحقق من جميع الحقول
                const fields = [nameInput, emailInput, passwordInput, confirmPasswordInput];
                fields.forEach(field => {
                    if (!validateField(field)) {
                        isValid = false;
                    }
                });
                
                // التحقق من الشروط والأحكام
                if (!termsCheckbox.checked) {
                    showError(termsCheckbox, 'يجب الموافقة على الشروط والأحكام');
                    isValid = false;
                }
                
                if (isValid) {
                    // إرسال النموذج
                    this.submit();
                }
            });
            
            // Auto-hide session messages
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
            
            // تهيئة تحقق كلمة المرور إذا كان هناك قيمة
            if (passwordInput.value) {
                checkPasswordStrength(passwordInput.value);
                updatePasswordRequirements(passwordInput.value);
            }
            
            if (confirmPasswordInput.value) {
                checkPasswordMatch();
            }
            
            updateFormValidity();
        });
    </script>
</body>
</html>