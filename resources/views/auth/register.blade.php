<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kayıt Ol - {{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .auth-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
        }
        .auth-header {
            text-align: center;
            margin-bottom: 32px;
        }
        .auth-title {
            font-size: 28px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 8px;
        }
        .auth-subtitle {
            color: #666;
            font-size: 16px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }
        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        .form-input:focus {
            outline: none;
            border-color: #667eea;
        }
        .btn-primary {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
        }
        .btn-secondary {
            width: 100%;
            padding: 12px;
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 12px;
        }
        .btn-secondary:hover {
            background: #667eea;
            color: white;
        }
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <h1 class="auth-title">Kayıt Ol</h1>
            <p class="auth-subtitle">Yeni hesap oluşturun</p>
        </div>

        <div id="alertContainer"></div>

        <form id="registerForm">
            <div class="form-group">
                <label class="form-label" for="name">Ad Soyad</label>
                <input type="text" id="name" class="form-input" placeholder="Adınız Soyadınız" required>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="email">E-posta</label>
                <input type="email" id="email" class="form-input" placeholder="ornek@email.com" required>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="password">Şifre</label>
                <input type="password" id="password" class="form-input" placeholder="••••••••" required minlength="6">
            </div>

            <button type="submit" class="btn-primary" id="registerBtn">
                Kayıt Ol
            </button>
        </form>

        <button type="button" class="btn-secondary" ;onclick="window.location.href='{{ route('login') }}'">
            Zaten hesabınız var mı? Giriş Yap
        </button>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const registerBtn = document.getElementById('registerBtn');
            const alertContainer = document.getElementById('alertContainer');
            
            // Show loading state
            registerBtn.textContent = 'Kayıt oluşturuluyor...';
            registerBtn.classList.add('loading');
            
            try {
                const response = await fetch('/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ name, email, password })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    localStorage.setItem('api_token', data.data.token);
                    localStorage.setItem('user', JSON.stringify(data.data.user));
                    
                    showAlert('Kayıt başarılı! Yönlendiriliyorsunuz...', 'success');
                    
                    setTimeout(() => {
                        window.location.href = '/dashboard';
                    }, 1500);
                } else {
                    showAlert(data.message || 'Kayıt başarısız', 'error');
                }
            } catch (error) {
                showAlert('Bir hata oluştu: ' + error.message, 'error');
            } finally {
                registerBtn.textContent = 'Kayıt Ol';
                registerBtn.classList.remove('loading');
            }
        });
        
        function showAlert(message, type) {
            const alertContainer = document.getElementById('alertContainer');
            alertContainer.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
            
            setTimeout(() => {
                alertContainer.innerHTML = '';
            }, 5000);
        }
    </script>
</body>
</html>
