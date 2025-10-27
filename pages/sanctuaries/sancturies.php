<?php
session_start();
require_once '../../config/database.php';

// Fetch all sanctuaries from database
try {
    $stmt = $pdo->query("SELECT * FROM sanctuaries ORDER BY RAND()"); 
    $sanctuaries = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching sanctuaries: " . $e->getMessage());
}

// Handle search if submitted
$searched_sanctuary = null;
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_term = trim($_GET['search']);
    try {
        $stmt = $pdo->prepare("SELECT * FROM sanctuaries WHERE name LIKE ? LIMIT 1");
        $stmt->execute([$search_term . '%']);
        $searched_sanctuary = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$searched_sanctuary) {
            $search_error = "No Such Sanctuary in List!";
        }
    } catch (PDOException $e) {
        $search_error = "Search error occurred.";
    }
}

// Handle localStorage sanctuary search from homepage
$homepage_sanctuary = isset($_GET['from_home']) ? $_GET['from_home'] : null;
if ($homepage_sanctuary) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM sanctuaries WHERE name LIKE ? LIMIT 1");
        $stmt->execute([$homepage_sanctuary . '%']);
        $searched_sanctuary = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Silent fail
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <link rel="stylesheet" href="./sancturiesStyle.css">
    <link rel="shortcut icon" href="/Assets_TBU/Background Images/Sancturia Logo Green.png" type="image/x-icon">
    <title>Sancturia Wildlife - Sanctuaries</title>
    
    <style>
        /* Modal styles */
        .searchedModal {
            display: <?php echo $searched_sanctuary ? 'block' : 'none'; ?>;
            position: fixed;
            top: 10%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            max-width: 600px;
            width: 90%;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            animation: slideDown 0.5s ease;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateX(-50%) scale(0.8);
            }
            to {
                opacity: 1;
                transform: translateX(-50%) scale(1);
            }
        }
        
        .modal-backdrop-custom {
            display: <?php echo $searched_sanctuary ? 'block' : 'none'; ?>;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        
        .alert-danger {
            background: rgba(255, 0, 0, 0.1);
            color: red;
            padding: 10px;
            border-radius: 5px;
            margin: 20px auto;
            max-width: 500px;
            text-align: center;
        }
        
        /* Donate button styling */
        .btn-donate {
            background-color: #FFA500;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: .3s;
            margin-top: 10px;
        }
        
        .btn-donate:hover {
            background-color: #FF8C00;
            transform: scale(1.02);
        }
        
        .sanctuary-content {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <img src="/Assets_TBU/Background Images/SancturiesBg.jpeg" alt="Background" class="backBg">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-light" style="backdrop-filter: blur(1px);">
        <div class="container" id="navBar">
            <a class="navbar-brand fw-bold fs-4" href="/index.html">
                <img src="/Assets_TBU/Background Images/Sancturia Logo Black.png" alt="logo" style="height: 40px;">
                Sancturia Wildlife
            </a>

            <button class="navbar-toggler" type="button" 
                data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-around" id="navbarNav">
                <ul class="navbar-nav mx-auto" id="navBarList">
                    <li class="nav-item">
                        <a class="btn btn-outline-dark me-4 my-2" href="/index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-dark me-4 my-2" href="/pages/about/about.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-dark me-4 my-2" href="/pages/donate/donate.php">Donate</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-dark me-4 my-2" href="/pages/sanctuaries/sancturies.php">Sanctuaries</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-dark me-4 my-2" href="/pages/adopt/adopt.html">Adopt</a>
                    </li>
                </ul>

                <!-- Search Form -->
                <form method="GET" action="sancturies.php" class="d-flex">
                    <input type="text" name="search" placeholder="Explore Wildlife" class="searchBar" 
                           value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button type="submit" class="searchBtn btn btn-outline-dark me-2">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Error Message -->
    <?php if (isset($search_error)): ?>
        <div class="alert-danger">
            <?php echo htmlspecialchars($search_error); ?>
        </div>
    <?php endif; ?>

    <!-- Modal Backdrop -->
    <div class="modal-backdrop-custom" onclick="closeModal()"></div>

    <!-- Search Result Modal -->
    <?php if ($searched_sanctuary): ?>
    <div class="searchedModal">
        <div class="sanctuary-card">
            <div class="sanctuary-image-bg">
                <img src="<?php echo htmlspecialchars($searched_sanctuary['image_path']); ?>" 
                     class="sanctuary-image img-fluid" 
                     alt="<?php echo htmlspecialchars($searched_sanctuary['name']); ?>">
            </div>
            <div class="sanctuary-content">
                <h3><?php echo htmlspecialchars($searched_sanctuary['name']); ?></h3>
                <p>Location: <?php echo htmlspecialchars($searched_sanctuary['location']); ?></p>
                <p><?php echo htmlspecialchars($searched_sanctuary['description']); ?></p>
                <div class="button-group">
                    <button>
                        <a href="<?php echo htmlspecialchars($searched_sanctuary['website_url']); ?>" 
                           target="_blank" 
                           style="text-decoration: none; color: white;">
                            Get Info Here
                        </a>
                    </button>
                    <button class="btn-donate" onclick="donateToSanctuary('<?php echo htmlspecialchars($searched_sanctuary['name'], ENT_QUOTES); ?>')">
                        Donate Now
                    </button>
                </div>
                <button class="btn btn-danger my-2" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Sanctuary Grid -->
    <section class="sanctuary-grid">
        <?php if (!empty($sanctuaries)): ?>
            <?php foreach ($sanctuaries as $sanctuary): ?>
                <div class="sanctuary-card">
                    <div class="sanctuary-image-bg">
                        <img src="<?php echo htmlspecialchars($sanctuary['image_path']); ?>" 
                             class="sanctuary-image img-fluid" 
                             alt="<?php echo htmlspecialchars($sanctuary['name']); ?>">
                    </div>
                    <div class="sanctuary-content">
                        <h3><?php echo htmlspecialchars($sanctuary['name']); ?></h3>
                        <p>Location: <?php echo htmlspecialchars($sanctuary['location']); ?></p>
                        <p><?php echo htmlspecialchars($sanctuary['description']); ?></p>
                        <div class="button-group">
                            <button>
                                <a href="<?php echo htmlspecialchars($sanctuary['website_url']); ?>" 
                                   target="_blank" 
                                   style="text-decoration: none; color: white;">
                                    Get Info Here
                                </a>
                            </button>
                            <button class="btn-donate" onclick="donateToSanctuary('<?php echo htmlspecialchars($sanctuary['name'], ENT_QUOTES); ?>')">
                                Donate Now
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; padding: 20px;">No sanctuaries found.</p>
        <?php endif; ?>
    </section>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Close modal function
        function closeModal() {
            const modal = document.querySelector('.searchedModal');
            const backdrop = document.querySelector('.modal-backdrop-custom');
            if (modal) modal.style.display = 'none';
            if (backdrop) backdrop.style.display = 'none';
            
            // Remove search parameter from URL
            const url = new URL(window.location);
            url.searchParams.delete('search');
            url.searchParams.delete('from_home');
            window.history.replaceState({}, '', url);
        }

        // Donate to specific sanctuary
        function donateToSanctuary(sanctuaryName) {
            // Store sanctuary name in localStorage
            localStorage.setItem('DonateSanctuary', sanctuaryName);
            // Redirect to donate page
            window.location.href = '/pages/donate/donate.php?sanctuary=' + encodeURIComponent(sanctuaryName);
        }

        // Auto-scroll to top when modal is shown
        <?php if ($searched_sanctuary): ?>
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        <?php endif; ?>

        // Handle localStorage sanctuary search from homepage
        window.addEventListener('DOMContentLoaded', function() {
            const sanctuaryName = localStorage.getItem('SanctuaryName');
            if (sanctuaryName) {
                window.location.href = 'sancturies.php?from_home=' + encodeURIComponent(sanctuaryName);
                localStorage.removeItem('SanctuaryName');
            }
        });
    </script>
</body>
</html>