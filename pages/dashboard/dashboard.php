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
                <i class="fas fa-paw"></i>
                <span>Sancturia</span>
            </div>
        </div>
        
        <nav class="sidebar-nav">
            <a href="dashboard.php" class="nav-item active">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="../donate/donate.html" class="nav-item">
                <i class="fas fa-hand-holding-heart"></i>
                <span>Donate</span>
            </a>
            <a href="../sanctuaries/sancturies.html" class="nav-item">
                <i class="fas fa-map-marked-alt"></i>
                <span>Sanctuaries</span>
            </a>
            <a href="../adoptions/adoptions.html" class="nav-item">
                <i class="fas fa-heart"></i>
                <span>Adoptions</span>
            </a>
            <a href="../../index.html" class="nav-item">
                <i class="fas fa-globe"></i>
                <span>Website</span>
            </a>
        </nav>

        <div class="sidebar-footer">
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
            <div class="welcome-section">
                <h1>Welcome back, <?php echo htmlspecialchars(explode(' ', $user['name'])[0]); ?>! 👋</h1>
                <p class="subtitle">Here's what's happening with your conservation journey</p>
            </div>
            <div class="user-profile">
                <div class="profile-info">
                    <span class="user-name"><?php echo htmlspecialchars($user['name']); ?></span>
                    <span class="user-email"><?php echo htmlspecialchars($user['email']); ?></span>
                </div>
                <div class="profile-avatar">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </header>

        <!-- Statistics Cards -->
        <section class="stats-grid">
            <div class="stat-card stat-green">
                <div class="stat-icon">
                    <i class="fas fa-donate"></i>
                </div>
                <div class="stat-content">
                    <h3>₹<?php echo number_format($total_donations, 0); ?></h3>
                    <p>Total Donated</p>
                </div>
                <div class="stat-badge">
                    <i class="fas fa-arrow-up"></i>
                </div>
            </div>

            <div class="stat-card stat-blue">
                <div class="stat-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="stat-content">
                    <h3><?php echo $adoptions_count; ?></h3>
                    <p>Animals Adopted</p>
                </div>
                <div class="stat-badge">
                    <i class="fas fa-paw"></i>
                </div>
            </div>

            <div class="stat-card stat-orange">
                <div class="stat-icon">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <div class="stat-content">
                    <h3><?php echo $donations_count; ?></h3>
                    <p>Total Donations</p>
                </div>
                <div class="stat-badge">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>

            <div class="stat-card stat-purple">
                <div class="stat-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-content">
                    <h3><?php echo date('M Y', strtotime($user['created_at'])); ?></h3>
                    <p>Member Since</p>
                </div>
                <div class="stat-badge">
                    <i class="fas fa-star"></i>
                </div>
            </div>
        </section>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Recent Donations -->
            <section class="content-card">
                <div class="card-header">
                    <h2><i class="fas fa-history"></i> Recent Donations</h2>
                    <a href="../donate/donate.html" class="view-all">View All <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="card-body">
                    <?php if (!empty($donations)): ?>
                        <div class="donation-list">
                            <?php foreach ($donations as $donation): ?>
                                <div class="donation-item">
                                    <div class="donation-icon">
                                        <i class="fas fa-hand-holding-heart"></i>
                                    </div>
                                    <div class="donation-info">
                                        <h4><?php echo htmlspecialchars($donation['sanctuary_name']); ?></h4>
                                        <p class="donation-date">
                                            <i class="far fa-calendar"></i>
                                            <?php echo date('M d, Y', strtotime($donation['donation_date'])); ?>
                                        </p>
                                    </div>
                                    <div class="donation-amount">
                                        ₹<?php echo number_format($donation['amount'], 0); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <h3>No donations yet</h3>
                            <p>Start making a difference today!</p>
                            <a href="../donate/donate.html" class="btn-primary">Make a Donation</a>
                        </div>
                    <?php endif; ?>
                </div>
            </section>

            <!-- Recent Adoptions -->
            <section class="content-card">
                <div class="card-header">
                    <h2><i class="fas fa-paw"></i> Your Adoptions</h2>
                    <a href="../adoptions/adoptions.html" class="view-all">View All <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="card-body">
                    <?php if (!empty($adoptions)): ?>
                        <div class="adoption-list">
                            <?php foreach ($adoptions as $adopt): ?>
                                <div class="adoption-item">
                                    <div class="adoption-icon">
                                        <i class="fas fa-paw"></i>
                                    </div>
                                    <div class="adoption-info">
                                        <h4><?php echo htmlspecialchars($adopt['animal_name']); ?></h4>
                                        <p class="adoption-type"><?php echo htmlspecialchars($adopt['animal_type']); ?></p>
                                        <p class="adoption-date">
                                            <i class="far fa-calendar"></i>
                                            Adopted on <?php echo date('M d, Y', strtotime($adopt['adoption_date'])); ?>
                                        </p>
                                    </div>
                                    <div class="adoption-badge">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <i class="fas fa-heart"></i>
                            <h3>No adoptions yet</h3>
                            <p>Adopt an animal and give them a better life!</p>
                            <a href="../adoptions/adoptions.html" class="btn-primary">Browse Animals</a>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </div>

        <!-- Recommended Sanctuaries -->
        <section class="sanctuaries-section">
            <div class="section-header">
                <h2><i class="fas fa-map-marked-alt"></i> Recommended Sanctuaries</h2>
                <a href="../sanctuaries/sancturies.html" class="view-all">View All <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="sanctuaries-grid">
                <?php foreach ($sanctuaries as $sanc): ?>
                    <div class="sanctuary-card">
                        <div class="sanctuary-image">
                            <i class="fas fa-tree"></i>
                        </div>
                        <div class="sanctuary-content">
                            <h3><?php echo htmlspecialchars($sanc['name']); ?></h3>
                            <p class="sanctuary-location">
                                <i class="fas fa-map-marker-alt"></i>
                                <?php echo htmlspecialchars($sanc['location']); ?>
                            </p>
                            <p class="sanctuary-description">
                                <?php echo htmlspecialchars(substr($sanc['description'], 0, 100)); ?>...
                            </p>
                            <a href="<?php echo htmlspecialchars($sanc['website_url']); ?>" target="_blank" class="btn-secondary">
                                Explore Sanctuary <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
</body>
</html>