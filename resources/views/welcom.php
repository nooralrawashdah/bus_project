<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S-Bus Pro | Group 1 Full System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root { --accent: #7C3AED; --bg: #050507; --glass: rgba(20, 20, 25, 0.9); --border: rgba(255, 255, 255, 0.1); }
        body { background: var(--bg); color: #fff; font-family: 'Outfit', sans-serif; min-height: 100vh; margin: 0; overflow-x: hidden; }
        .hidden { display: none !important; }

        /* Glassmorphism Design */
        .glass-card { background: var(--glass); backdrop-filter: blur(25px); border: 1px solid var(--border); border-radius: 30px; padding: 35px; box-shadow: 0 25px 50px rgba(0,0,0,0.7); }
        .modern-input { background: rgba(0,0,0,0.3); border: 1px solid var(--border); color: white; border-radius: 14px; padding: 12px; width: 100%; margin-bottom: 15px; outline: none; transition: 0.3s; }
        .modern-input:focus { border-color: var(--accent); box-shadow: 0 0 15px rgba(124, 58, 237, 0.2); }
        .btn-glow { background: var(--accent); color: white; border: none; border-radius: 14px; padding: 12px; width: 100%; font-weight: 700; transition: 0.3s; cursor: pointer; }
        .btn-glow:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(124, 58, 237, 0.5); }

        /* Sidebar */
        .sidebar { width: 85px; height: 90vh; position: fixed; left: 20px; top: 5vh; background: var(--glass); border: 1px solid var(--border); border-radius: 25px; display: flex; flex-direction: column; align-items: center; padding: 30px 0; z-index: 1000; }
        .nav-icon { font-size: 22px; color: #52525b; margin-bottom: 35px; cursor: pointer; transition: 0.3s; }
        .nav-icon.active, .nav-icon:hover { color: var(--accent); }
        .main-content { margin-left: 125px; padding: 40px; }

        /* Seats */
        .seat { width: 35px; height: 35px; background: rgba(255,255,255,0.03); border: 1px solid var(--border); border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 10px; transition: 0.2s; }
        .seat.available { border-color: #10b981; color: #10b981; }
        .seat.occupied { background: #18181b; color: #3f3f46; cursor: not-allowed; border: none; }
        .seat.selected { background: var(--accent); color: white; transform: scale(1.1); box-shadow: 0 0 15px var(--accent); }

        .success-banner { background: rgba(16, 185, 129, 0.1); border: 1px solid #10b981; color: #10b981; padding: 10px; border-radius: 12px; margin-bottom: 15px; text-align: center; font-size: 13px; }
        .map-frame { width: 100%; height: 350px; border-radius: 20px; border: 1px solid var(--border); filter: invert(90%) hue-rotate(180deg); }
    </style>
</head>
<body>

    <div id="auth-section" class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="glass-card w-100" style="max-width: 420px;">

            <div id="login-view">
                <div class="text-center mb-4">
                    <i class="fas fa-bus-alt text-accent fa-3x mb-3" style="color:var(--accent)"></i>
                    <h2 class="fw-bold">S-Bus Pro</h2>
                    <p class="text-muted small">Group 1 Project</p>
                </div>
                <div id="auth-alert" class="success-banner hidden"></div>

                <select id="user-role" class="modern-input">
                    <option value="student">Student</option>
                    <option value="driver">Driver</option>
                    <option value="admin">Admin</option>
                </select>
                <input type="text" id="login-id" class="modern-input" placeholder="ID Number">
                <input type="password" id="login-pass" class="modern-input" placeholder="Password">
                <button class="btn-glow mb-4" onclick="handleLogin()">Sign In</button>

                <div class="d-flex justify-content-between small">
                    <a href="javascript:void(0)" class="text-muted text-decoration-none" onclick="showAuth('forgot')">Forgot Password?</a>
                    <a href="javascript:void(0)" class="fw-bold text-decoration-none" onclick="showAuth('register')" style="color:var(--accent)">Create Account</a>
                </div>
            </div>

            <div id="register-view" class="hidden">
                <h3 class="fw-bold mb-4">New Account</h3>
                <input type="text" id="reg-name" class="modern-input" placeholder="Full Name">
                <input type="text" id="reg-id" class="modern-input" placeholder="University ID">
                <input type="password" id="reg-pass" class="modern-input" placeholder="Password">
                <button class="btn-glow mb-3" onclick="handleRegister()">Register</button>
                <center><a href="javascript:void(0)" class="text-muted small" onclick="showAuth('login')">Back to Login</a></center>
            </div>

            <div id="forgot-view" class="hidden">
                <h3 class="fw-bold mb-3">Reset Password</h3>
                <p class="text-muted small">Enter your email to receive a reset code.</p>
                <div id="forgot-step1">
                    <input type="email" id="reset-email" class="modern-input" placeholder="Email Address">
                    <button class="btn-glow mb-3" onclick="handleForgot()">Send Code</button>
                </div>
                <div id="forgot-step2" class="hidden">
                    <input type="text" class="modern-input" placeholder="Enter 6-digit Code">
                    <input type="password" id="new-password" class="modern-input" placeholder="New Password">
                    <button class="btn-glow mb-3" onclick="handleResetFinal()">Reset Now</button>
                </div>
                <center><a href="javascript:void(0)" class="text-muted small" onclick="showAuth('login')">Cancel</a></center>
            </div>

        </div>
    </div>

    <div id="app-section" class="hidden">
        <aside class="sidebar">
            <i class="fas fa-home nav-icon active"></i>
            <i class="fas fa-route nav-icon"></i>
            <i class="fas fa-sign-out-alt nav-icon mt-auto text-danger" onclick="location.reload()"></i>
        </aside>

        <main class="main-content">
            <header class="d-flex justify-content-between align-items-center mb-5">
                <div>
                    <h1 class="fw-bold mb-0" id="dash-title">Dashboard</h1>
                    <p class="text-muted">Welcome, <span id="user-name-span" class="text-white">User</span></p>
                </div>
                <div class="glass-card py-2 px-4 border-0">
                    <span class="text-success small fw-bold">● System Live</span>
                </div>
            </header>

            <div id="student-content" class="hidden">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="glass-card">
                            <h5 class="mb-4">Book Your Seat</h5>
                            <div class="d-grid mb-4" style="grid-template-columns: repeat(4, 35px); gap: 10px; justify-content: center;" id="seat-grid"></div>
                            <div id="booking-actions">
                                <button id="confirm-btn" class="btn-glow" disabled onclick="confirmBooking()">Confirm Seat</button>
                            </div>
                            <div id="cancel-actions" class="hidden text-center">
                                <div class="success-banner">Reserved Seat: <span id="my-seat-id"></span></div>
                                <button class="btn btn-outline-danger w-100 rounded-4" onclick="cancelBooking()">Cancel Booking</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="glass-card">
                            <h5>Live Tracking</h5>
                            <iframe class="map-frame" src="https://www.openstreetmap.org/export/embed.html?bbox=35.8,32.4,36.0,32.6&layer=mapnik"></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <div id="driver-content" class="hidden">
                <div class="row g-3 mb-4">
                    <div class="col-md-4"><div class="glass-card text-center"><h3>24</h3><p class="small text-muted">Total Seats</p></div></div>
                    <div class="col-md-4"><div class="glass-card text-center text-accent"><h3>16</h3><p class="small text-muted">Passengers</p></div></div>
                    <div class="col-md-4"><div class="glass-card text-center text-success"><h3>Trip Ready</h3><p class="small text-muted">Status</p></div></div>
                </div>
                <div class="glass-card">
                    <button class="btn-glow w-auto px-5 mb-4" onclick="this.innerText='Trip Started...'">Start Tracking</button>
                    <iframe class="map-frame" src="https://www.openstreetmap.org/export/embed.html?bbox=35.8,32.4,36.0,32.6&layer=mapnik"></iframe>
                </div>
            </div>

            <div id="admin-content" class="hidden">
                <div class="row g-4">
                    <div class="col-md-8">
                        <div class="glass-card">
                            <h5>Fleet Management</h5>
                            <table class="table table-dark table-hover mt-3 small">
                                <thead><tr><th>Bus</th><th>Driver</th><th>Route</th><th>Status</th></tr></thead>
                                <tbody>
                                    <tr><td>B-101</td><td>Mahmoud Iyad</td><td>Campus A</td><td><span class="badge bg-success">On Trip</span></td></tr>
                                    <tr><td>B-202</td><td>Aisha Belal</td><td>Campus B</td><td><span class="badge bg-warning">Delayed</span></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="glass-card text-center">
                            <h5>Total Efficiency</h5>
                            <h1 class="display-4 fw-bold text-accent">94%</h1>
                            <p class="text-muted">Daily Goal Met</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        let currentRole = 'student';
        let selectedSeatId = null;

        // Navigation for Auth Views
        function showAuth(view) {
            document.getElementById('login-view').classList.toggle('hidden', view !== 'login');
            document.getElementById('register-view').classList.toggle('hidden', view !== 'register');
            document.getElementById('forgot-view').classList.toggle('hidden', view !== 'forgot');
        }

        // Handle Registration
        function handleRegister() {
            const name = document.getElementById('reg-name').value;
            const id = document.getElementById('reg-id').value;
            if(!name || !id) { alert("Fill all fields"); return; }
            localStorage.setItem('u_name', name);
            localStorage.setItem('u_id', id);
            showAuth('login');
            const alertBox = document.getElementById('auth-alert');
            alertBox.innerText = "Account Created! Login Now.";
            alertBox.classList.remove('hidden');
            document.getElementById('login-id').value = id;
        }

        // Handle Forgot Password
        function handleForgot() {
            if(!document.getElementById('reset-email').value) { alert("Enter email"); return; }
            document.getElementById('forgot-step1').classList.add('hidden');
            document.getElementById('forgot-step2').classList.remove('hidden');
        }
        function handleResetFinal() {
            showAuth('login');
            const alertBox = document.getElementById('auth-alert');
            alertBox.innerText = "Password Updated!";
            alertBox.classList.remove('hidden');
        }

        // Handle Login
        function handleLogin() {
            currentRole = document.getElementById('user-role').value;
            const enteredId = document.getElementById('login-id').value;
            const savedId = localStorage.getItem('u_id');
            const name = (enteredId === savedId) ? localStorage.getItem('u_name') : "Authorized " + currentRole;

            document.getElementById('auth-section').classList.add('hidden');
            document.getElementById('app-section').classList.remove('hidden');
            document.getElementById('user-name-span').innerText = name;
            document.getElementById('dash-title').innerText = currentRole.toUpperCase() + " HUB";

            ['student', 'driver', 'admin'].forEach(r => {
                document.getElementById(r + '-content').classList.toggle('hidden', r !== currentRole);
            });

            if(currentRole === 'student') initSeats();
        }

        // Seat Logic
        function initSeats() {
            const grid = document.getElementById('seat-grid');
            grid.innerHTML = '';
            const taken = [2, 6, 11, 19];
            for(let i=1; i<=24; i++) {
                if(i % 4 === 3) { let aisle = document.createElement('div'); aisle.style.width = '10px'; grid.appendChild(aisle); }
                let s = document.createElement('div');
                s.className = 'seat ' + (taken.includes(i) ? 'occupied' : 'available');
                s.innerText = i;
                if(!taken.includes(i)) {
                    s.onclick = function() {
                        document.querySelectorAll('.seat').forEach(el => el.classList.remove('selected'));
                        this.classList.add('selected');
                        selectedSeatId = i;
                        document.getElementById('confirm-btn').disabled = false;
                        document.getElementById('confirm-btn').innerText = "Book Seat #" + i;
                    };
                }
                grid.appendChild(s);
            }
        }

        function confirmBooking() {
            document.getElementById('booking-actions').classList.add('hidden');
            document.getElementById('cancel-actions').classList.remove('hidden');
            document.getElementById('my-seat-id').innerText = "#" + selectedSeatId;
            alert("Booking Saved Successfully!");
        }

        function cancelBooking() {
            if(confirm("Cancel this reservation?")) {
                document.getElementById('booking-actions').classList.remove('hidden');
                document.getElementById('cancel-actions').classList.add('hidden');
                selectedSeatId = null;
                initSeats();
            }
        }
    </script>
</body>
</html>
