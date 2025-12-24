<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Bus System - Fixed Links</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">

    <style>
        :root { --gold: #ffcc00; --dark: #000000; --gray: #2c3e50; }

        body {
            margin: 0; padding: 0; min-height: 100vh;
            background: radial-gradient(circle, #2c3e50, #000000);
            font-family: 'Segoe UI', sans-serif; color: white;
        }

        .hidden { display: none !important; }

        /* تصميم الكروت المركزية */
        .auth-card {
            width: 400px; padding: 35px; background: rgba(0, 0, 0, 0.9);
            border: 2px solid var(--gold); border-radius: 25px;
            box-shadow: 0 0 30px rgba(255, 204, 0, 0.4);
            margin: 50px auto; text-align: center;
        }

        .input-group-custom { margin-bottom: 15px; }
        .input-group-custom input, .input-group-custom select {
            width: 100%; padding: 12px; border-radius: 20px; border: none;
            text-align: center; font-size: 14px; outline: none;
        }

        .btn-gold {
            background: var(--gold); color: black; font-weight: bold;
            border-radius: 20px; padding: 12px; border: none; width: 100%;
            transition: 0.3s; cursor: pointer;
        }
        .btn-gold:hover { transform: scale(1.03); box-shadow: 0 0 15px white; }

        .link-switch {
            color: var(--gold);
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            display: block;
            margin-top: 15px;
            transition: 0.2s;
        }
        .link-switch:hover { color: #fff; text-shadow: 0 0 5px var(--gold); }

        /* تصميم صفحة الحجز */
        .booking-container { max-width: 850px; margin: 40px auto; background: rgba(0,0,0,0.85); padding: 30px; border-radius: 25px; border: 1px solid var(--gold); }
        .bus-layout {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px;
            max-width: 320px; margin: 20px auto; background: #111; padding: 20px; border-radius: 15px;
        }
        .seat { width: 45px; height: 45px; background: #444; border-radius: 8px; cursor: pointer; line-height: 45px; text-align: center; font-size: 13px; }
        .seat.selected { background: var(--gold); color: black; box-shadow: 0 0 10px var(--gold); }
        .seat.occupied { background: #ff4444; cursor: not-allowed; opacity: 0.5; }

        /* صفحة السائق */
        .driver-card { background: white; color: black; border-radius: 15px; padding: 25px; text-align: center; border-bottom: 5px solid var(--gold); }

        .fade-in { animation: fadeIn 0.6s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>

    <div id="register-page" class="fade-in">
        <div class="auth-card">
            <h2 style="color: var(--gold);">Create Account</h2>
            <p class="text-secondary small">Join our smart bus network</p>
            <form onsubmit="event.preventDefault(); alert('Account Created Successfully!'); showPage('login-page');">
                <div class="input-group-custom"><input type="text" placeholder="Full Name" required></div>
                <div class="input-group-custom"><input type="email" placeholder="Email Address" required></div>
                <div class="input-group-custom"><input type="text" id="regDob" placeholder="Date of Birth" required></div>
                <div class="input-group-custom">
                    <select required>
                        <option value="">User Type</option>
                        <option value="1">Student</option>
                        <option value="2">Driver</option>
                    </select>
                </div>
                <div class="input-group-custom"><input type="password" placeholder="Create Password" required></div>
                <button type="submit" class="btn-gold">Sign Up</button>
            </form>
            <div class="link-switch" onclick="showPage('login-page')">Already have an account? Login here</div>
        </div>
    </div>

    <div id="login-page" class="hidden fade-in">
        <div class="auth-card">
            <h2 style="color: var(--gold);">Login Portal</h2>
            <p class="text-secondary small">Access your dashboard</p>
            <form id="loginForm">
                <div class="input-group-custom"><input type="text" id="userId" placeholder="Student/Driver ID" required></div>
                <div class="input-group-custom"><input type="password" placeholder="Password" required></div>
                <button type="submit" class="btn-gold">Login</button>
            </form>
            <div class="link-switch" onclick="showPage('forgot-page')">Forgot Password?</div>
            <div class="link-switch" onclick="showPage('register-page')">New user? Create an account</div>
        </div>
    </div>

    <div id="forgot-page" class="hidden fade-in">
        <div class="auth-card">
            <h2 style="color: var(--gold);">Reset Password</h2>
            <p class="text-secondary small">Recovery link will be sent to your email</p>
            <form onsubmit="event.preventDefault(); alert('Reset link sent!'); showPage('login-page');">
                <div class="input-group-custom"><input type="email" placeholder="Enter your Email" required></div>
                <button type="submit" class="btn-gold">Send Link</button>
            </form>
            <div class="link-switch" onclick="showPage('login-page')">Return to Login</div>
        </div>
    </div>

    <div id="student-page" class="hidden fade-in">
        <div class="container booking-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 style="color: var(--gold);">Student Booking</h3>
                <button class="btn btn-outline-danger btn-sm" onclick="logout()">Logout</button>
            </div>
            <div class="bus-layout" id="seatGrid"></div>
            <div class="text-center mt-4">
                <p class="fs-4">Total: <span id="price">0</span> JOD</p>
                <button class="btn-gold w-50" onclick="alert('Confirmed!')">Confirm Selection</button>
            </div>
        </div>
    </div>

    <div id="driver-page" class="hidden fade-in">
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h2 style="color: var(--gold);">Driver Dashboard</h2>
                <button class="btn btn-danger" onclick="logout()">Logout</button>
            </div>
            <div class="row g-4">
                <div class="col-md-4"><div class="driver-card"><h5>Current Route</h5><p>Campus Express</p></div></div>
                <div class="col-md-4"><div class="driver-card"><h5>Schedule</h5><p>Next: 08:30 AM</p></div></div>
                <div class="col-md-4"><div class="driver-card"><h5>Students</h5><p>18 On Board</p></div></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // تفعيل التقويم
        flatpickr("#regDob", { dateFormat: "Y-m-d" });

        // الدالة المسؤولة عن التنقل بين جميع الصفحات
        function showPage(pageId) {
            // إخفاء كل الصفحات أولاً
            const pages = ['register-page', 'login-page', 'forgot-page', 'student-page', 'driver-page'];
            pages.forEach(p => {
                const element = document.getElementById(p);
                if(element) element.classList.add('hidden');
            });

            // إظهار الصفحة المطلوبة فقط
            const target = document.getElementById(pageId);
            if(target) target.classList.remove('hidden');
        }

        // معالجة تسجيل الدخول
        document.getElementById('loginForm').onsubmit = (e) => {
            e.preventDefault();
            const id = document.getElementById('userId').value;
            if(id.startsWith('2')) {
                showPage('driver-page');
            } else {
                showPage('student-page');
                renderSeats();
            }
        };

        function logout() { location.reload(); }

        function renderSeats() {
            const grid = document.getElementById('seatGrid');
            grid.innerHTML = '';
            for(let i=1; i<=20; i++) {
                const seat = document.createElement('div');
                seat.className = 'seat';
                seat.innerText = i;
                if(Math.random() < 0.2) seat.classList.add('occupied');
                seat.onclick = () => {
                    if(!seat.classList.contains('occupied')) {
                        seat.classList.toggle('selected');
                        const count = document.querySelectorAll('.seat.selected').length;
                        document.getElementById('price').innerText = (count * 2.5).toFixed(2);
                    }
                };
                grid.appendChild(seat);
            }
        }
    </script>
</body>
</html>

