<?php
session_start();
require_once '../../config/database.php';
require_once '../../includes/csrf.php';

// Get sanctuary name from URL or localStorage
$sanctuary_name = isset($_GET['sanctuary']) ? htmlspecialchars($_GET['sanctuary']) : 'General Fund';

// Check if user is logged in
$is_logged_in = isset($_SESSION['user_id']);

// Preserve form data in session if user was redirected from login
$preserved_data = isset($_SESSION['donation_form_data']) ? $_SESSION['donation_form_data'] : [];
$preserved_sanctuary = isset($_SESSION['donation_sanctuary']) ? $_SESSION['donation_sanctuary'] : $sanctuary_name;

// If sanctuary is specified, use it
if ($sanctuary_name !== 'General Fund') {
    $preserved_sanctuary = $sanctuary_name;
}

// Clear preserved data after loading
unset($_SESSION['donation_form_data']);
unset($_SESSION['donation_sanctuary']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <link rel="shortcut icon" href="/Assets_TBU/Background Images/Sancturia Logo Green.png" type="image/x-icon">
    <link rel="stylesheet" href="./donateStyle.css">
    <title>Sancturia Wildlife - Donate</title>
    
    <style>
        /* Hide form when not logged in */
        .login-overlay {
            display: none;
        }
        
        /* Login prompt styling with green theme */
        .login-prompt {
            background: linear-gradient(135deg, #2d5016 0%, #4a7c2f 100%);
            color: white;
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            margin: 30px 0;
            box-shadow: 0 15px 50px rgba(45, 80, 22, 0.3);
        }
        
        .login-prompt h3 {
            margin-bottom: 15px;
            font-size: 28px;
            font-weight: 700;
        }
        
        .login-prompt p {
            margin-bottom: 25px;
            font-size: 16px;
            opacity: 0.95;
        }
        
        .btn-login-to-donate {
            background: white;
            color: #2d5016;
            padding: 16px 45px;
            border: none;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .btn-login-to-donate:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
            background: #f0f0f0;
        }
        
        /* Welcome back message with green theme */
        .welcome-back {
            background: linear-gradient(135deg, #4a7c2f 0%, #2d5016 100%);
            color: white;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            margin: 25px 0;
            box-shadow: 0 8px 25px rgba(45, 80, 22, 0.2);
        }
        
        .welcome-back h4 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <video src="/Assets_TBU/Background Images/wildlifeVideo.mp4" class="bgVid" loop muted autoplay></video>

    <div id="navbar-placeholder"></div>

    <main class="main-content">
        <section class="donation-section">
            <h1>Support Wildlife Sanctuaries</h1>
            <p>Your donations help protect wildlife and natural habitats.</p>
            <div class="donation-tiers">
                <div class="btn tier-card1 tier-card">
                    <div class="tier-info">
                        <h3>₹5001</h3>
                        <p>Tier <br> Soil</p>
                         <video src="/Assets_TBU/Logos Icons/leavesAnim.mp4" id="tier-vid1"></video>
                    </div>
                </div>
                <div class="btn tier-card2 tier-card">
                    <div class="tier-info">
                        <h3>₹7501</h3>
                        <p>Tier <br> Habitat</p>
                         <video src="/Assets_TBU/Logos Icons/elephantAnim.mp4" id="tier-vid2"></video>
                    </div>
                </div>
                <div class="btn tier-card3 tier-card">
                    <div class="tier-info">
                        <h3>₹10001</h3>
                        <p>Tier <br> Earth</p>
                         <video src="/Assets_TBU/Logos Icons/ecologyAnim.mp4" id="tier-vid3"></video>
                    </div>
                </div>
            </div>
            <div class="donation-btn">
                <button class="btn btn-warning btn-outline-dark donate-button">DONATE NOW</button>
            </div>
        </section>
        
        <section id="donationSection">
            <h2>Make a Difference</h2>
            <p>Your contributions help us provide care and protection for wildlife in sanctuaries across India.</p>
            
            <!-- Welcome Back Message -->
            <?php if ($is_logged_in && isset($_GET['from_login'])): ?>
                <div class="welcome-back">
                    <h4>Welcome back! You can now complete your donation.</h4>
                </div>
            <?php endif; ?>

            <!-- Display Sanctuary Name -->
            <?php if ($preserved_sanctuary !== 'General Fund'): ?>
                <div class="alert alert-success" style="background: rgba(76, 175, 80, 0.2); color: #2d5016; padding: 15px; border-radius: 8px; margin: 20px 0; text-align: center; font-size: large;">
                    <strong>Donating to: <?php echo $preserved_sanctuary; ?></strong>
                </div>
            <?php endif; ?>
            
            <!-- Login Prompt for Non-Logged Users -->
            <?php if (!$is_logged_in): ?>
                <div class="login-prompt">
                    <h3>🔐 Login Required</h3>
                    <p>Please log in to make a donation and track your contributions</p>
                    <button class="btn-login-to-donate" onclick="saveFormAndRedirectToLogin()">
                        Log in to Donate
                    </button>
                </div>
            <?php else: ?>
                <hr>
                
                <div class="donor-details-form">
                    <h2>Donor Information</h2>
                   <form action="./process_donation.php" method="POST" id="donationForm">
                    <?php echo csrf_field(); ?>

                    <?php
                        if (isset($_SESSION['error'])) {
                            echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['error']) . '</div>';
                            unset($_SESSION['error']);
                        }
                        if (isset($_SESSION['success'])) {
                            echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['success']) . '</div>';
                            unset($_SESSION['success']);
                        }
                    ?>

                    <div class="mb-3">
                        <label for="donorName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="donorName" name="donorName" 
                               placeholder="Your Name" 
                               value="<?php echo isset($preserved_data['donorName']) ? htmlspecialchars($preserved_data['donorName']) : ''; ?>"
                               required>
                    </div>
                    <div class="mb-3">
                        <label for="donorEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="donorEmail" name="donorEmail" 
                               placeholder="Your Email"
                               value="<?php echo isset($preserved_data['donorEmail']) ? htmlspecialchars($preserved_data['donorEmail']) : ''; ?>"
                               required>
                    </div>
                    <div class="mb-3">
                        <label for="donorPhone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="donorPhone" name="donorPhone" 
                               pattern="[0-9]{10}" maxlength="10" minlength="10"  
                               placeholder="Your Phone Number"
                               value="<?php echo isset($preserved_data['donorPhone']) ? htmlspecialchars($preserved_data['donorPhone']) : ''; ?>"
                               required>
                    </div>
                    <div class="mb-3">
                        <label for="donationAmount" class="form-label">Donation Amount</label>
                        <input type="number" class="form-control" id="donationAmount" name="donationAmount" 
                               placeholder="₹1000"
                               value="<?php echo isset($preserved_data['donationAmount']) ? htmlspecialchars($preserved_data['donationAmount']) : ''; ?>"
                               required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="radio" id="recurringM" name="recurring" value="monthly" 
                               <?php echo (isset($preserved_data['recurring']) && $preserved_data['recurring'] === 'monthly') ? 'checked' : ''; ?>>
                        <label for="recurringM">Make this a Monthly Donation</label>
                        <span>|</span>
                        <input type="radio" id="recurringY" name="recurring" value="yearly"
                               <?php echo (isset($preserved_data['recurring']) && $preserved_data['recurring'] === 'yearly') ? 'checked' : ''; ?>>
                        <label for="recurringY">Make this a Yearly Donation</label>
                    </div>
                    
                    <button type="submit" class="btn btn-warning rounded-pill mt-2" 
                    style="height: 50px; width: 200px; font-size: 22px;">Donate</button>

                    <input type="hidden" name="sanctuary_name" id="sanctuaryName" value="<?php echo htmlspecialchars($preserved_sanctuary); ?>">
                </form>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <div class="footer-info">
            <p>&copy; 2024 Wildlife Support | Privacy Policy</p>
        </div>
        <div class="social-icons">
            <a href="#">LinkedIn</a>
            <a href="#">Twitter</a>
            <a href="#">Instagram</a>
        </div>
    </footer>
    
    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./donate.js"></script>
    <script src="/pages/navbar/navbar.js"></script>
    
    <script>
        // Set sanctuary name from localStorage if available
        window.addEventListener('DOMContentLoaded', function() {
            const sanctuaryFromStorage = localStorage.getItem('DonateSanctuary');
            if (sanctuaryFromStorage && !<?php echo json_encode(isset($_GET['sanctuary'])); ?>) {
                const sanctuaryInput = document.getElementById('sanctuaryName');
                if (sanctuaryInput) {
                    sanctuaryInput.value = sanctuaryFromStorage;
                }
                localStorage.removeItem('DonateSanctuary');
            }
        });

        // Save form data and redirect to login
        function saveFormAndRedirectToLogin() {
            const sanctuaryName = '<?php echo htmlspecialchars($preserved_sanctuary); ?>';
            
            // Save to localStorage
            localStorage.setItem('donation_sanctuary', sanctuaryName);
            
            // Redirect to login with return URL
            window.location.href = '/pages/login-signup/login.php?redirect=donate&sanctuary=' + encodeURIComponent(sanctuaryName);
        }
    </script>
</body>
</html>