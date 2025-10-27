<?php
session_start();
require_once '../../config/database.php';
require_once '../../includes/auth.php';

// Check if user is logged in
if (!check_login()) {
    header("Location: ../login-signup/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user profile
$user = get_user_data($user_id);

// Fetch recent donations
$stmt = $pdo->prepare("SELECT * FROM donations WHERE user_id = ? ORDER BY donation_date DESC LIMIT 5");
$stmt->execute([$user_id]);
$donations = $stmt->fetchAll();

// Fetch recent adoptions
$stmt = $pdo->prepare("SELECT * FROM adoptions WHERE user_id = ? ORDER BY adoption_date DESC LIMIT 3");
$stmt->execute([$user_id]);
$adoptions = $stmt->fetchAll();

// Fetch recommended sanctuaries
$stmt = $pdo->query("SELECT * FROM sanctuaries ORDER BY RAND() LIMIT 3");
$sanctuaries = $stmt->fetchAll();

// Calculate statistics
$total_donations = $user['donation_total'] ?? 0;
$adoptions_count = $user['adoptions_count'] ?? 0;
$donations_count = count($donations);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sancturia Wildlife</title>
    <link rel="shortcut icon" href="/Assets_TBU/Background Images/Sancturia Logo Green.png" type="image/x-icon">
    <link rel="stylesheet" href="dashboard-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-leaf"></i>
                <span>Sancturia</span>
            </div>
        </div>
        
        <nav class="sidebar-nav">
            <a href="dashboard.php" class="nav-item active">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
            <a href="../../index.html" class="nav-item">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
            <a href="../about/about.html" class="nav-item">
                <i class="fas fa-info-circle"></i>
                <span>About</span>
            </a>
            <a href="../donate/donate.php" class="nav-item">
                <i class="fas fa-hand-holding-heart"></i>
                <span>Donate</span>
            </a>
            <a href="../sanctuaries/sancturies.html" class="nav-item">
                <i class="fas fa-map-marked-alt"></i>
                <span>Sanctuaries</span>
            </a>
            <a href="../adopt/adopt.html" class="nav-item">
                <i class="fas fa-paw"></i>
                <span>Adopt</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-profile-sidebar">
                <div class="profile-avatar-small">
                    <i class="fas fa-user"></i>
                </div>
                <div class="profile-details">
                    <span class="profile-name"><?php echo htmlspecialchars(explode(' ', $user['name'])[0]); ?></span>
                    <span class="profile-email"><?php echo htmlspecialchars($user['email']); ?></span>
                </div>
            </div>
            <a href="../login-signup/logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Bar -->
        <header class="top-bar">
            <div class="breadcrumb">
                <span class="breadcrumb-item">Dashboard</span>
            </div>
            <div class="top-actions">
                <span class="date-display"><?php echo date('l, F d, Y'); ?></span>
            </div>
        </header>

        <!-- Welcome Section -->
        <section class="welcome-banner">
            <h1>Welcome back, <?php echo htmlspecialchars(explode(' ', $user['name'])[0]); ?></h1>
            <p>Track your conservation impact and manage your contributions</p>
        </section>

        <!-- Statistics Cards -->
        <section class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-label">Total Donated</span>
                    <i class="fas fa-donate stat-icon-sm"></i>
                </div>
                <div class="stat-value">₹<?php echo number_format($total_donations, 0); ?></div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-label">Animals Adopted</span>
                    <i class="fas fa-heart stat-icon-sm"></i>
                </div>
                <div class="stat-value"><?php echo $adoptions_count; ?></div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-label">Donations Made</span>
                    <i class="fas fa-hand-holding-usd stat-icon-sm"></i>
                </div>
                <div class="stat-value"><?php echo $donations_count; ?></div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-label">Member Since</span>
                    <i class="fas fa-calendar-check stat-icon-sm"></i>
                </div>
                <div class="stat-value"><?php echo date('M Y', strtotime($user['created_at'])); ?></div>
            </div>
        </section>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Recent Donations -->
            <section class="content-card">
                <div class="card-header">
                    <h2>Recent Donations</h2>
                    <a href="../donate/donate.php" class="link-view">View All →</a>
                </div>
                <div class="card-body">
                    <?php if (!empty($donations)): ?>
                        <div class="list-items">
                            <?php foreach ($donations as $donation): ?>
                                <div class="list-item">
                                    <div class="item-info">
                                        <span class="item-title"><?php echo htmlspecialchars($donation['sanctuary_name']); ?></span>
                                        <span class="item-date"><?php echo date('M d, Y', strtotime($donation['donation_date'])); ?></span>
                                    </div>
                                    <div class="item-amount">₹<?php echo number_format($donation['amount'], 0); ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <p>No donations yet</p>
                            <a href="../donate/donate.php" class="btn-minimal">Make a Donation</a>
                        </div>
                    <?php endif; ?>
                </div>
            </section>

            <!-- Recent Adoptions -->
            <section class="content-card">
                <div class="card-header">
                    <h2>Your Adoptions</h2>
                    <a href="../adopt/adopt.html" class="link-view">View All →</a>
                </div>
                <div class="card-body">
                    <?php if (!empty($adoptions)): ?>
                        <div class="list-items">
                            <?php foreach ($adoptions as $adopt): ?>
                                <div class="list-item">
                                    <div class="item-info">
                                        <span class="item-title"><?php echo htmlspecialchars($adopt['animal_name']); ?></span>
                                        <span class="item-subtitle"><?php echo htmlspecialchars($adopt['animal_type']); ?></span>
                                        <span class="item-date">Adopted <?php echo date('M d, Y', strtotime($adopt['adoption_date'])); ?></span>
                                    </div>
                                    <i class="fas fa-paw item-icon"></i>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <p>No adoptions yet</p>
                            <a href="../adopt/adopt.html" class="btn-minimal">Coming Soon</a>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </div>

        <!-- Recommended Sanctuaries -->
        <section class="sanctuaries-section">
            <div class="section-header">
                <h2>Recommended Sanctuaries</h2>
                <a href="../sanctuaries/sancturies.html" class="link-view">View All →</a>
            </div>
            <div class="sanctuaries-grid">
                <?php foreach ($sanctuaries as $sanc): ?>
                    <div class="sanctuary-card">
                        <div class="sanctuary-header">
                            <h3><?php echo htmlspecialchars($sanc['name']); ?></h3>
                            <span class="sanctuary-location"><?php echo htmlspecialchars($sanc['location']); ?></span>
                        </div>
                        <p class="sanctuary-description"><?php echo htmlspecialchars(substr($sanc['description'], 0, 80)); ?>...</p>
                        <a href="<?php echo htmlspecialchars($sanc['website_url']); ?>" target="_blank" class="btn-minimal">
                            Explore →
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
</body>
</html>