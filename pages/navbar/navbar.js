document.addEventListener("DOMContentLoaded", function () {
  // Determine the correct path based on current location
  const isInRoot = !window.location.pathname.includes('/pages/');
  const navbarPath = isInRoot ? "/pages/navbar/navbar.html" : "../navbar/navbar.html";
  
  // Load navbar HTML
  fetch(navbarPath)
    .then(response => {
      if (!response.ok) {
        throw new Error('Navbar not found');
      }
      return response.text();
    })
    .then(data => {
      document.getElementById("navbar-placeholder").innerHTML = data;

      // Check if we're on the home page and apply theme
      applyNavbarTheme();

      // After navbar is loaded, check login status and update buttons
      checkLoginStatus();
      
      // Highlight active page
      highlightActivePage();
    })
    .catch(error => {
      console.error("Error loading navbar:", error);
      // Fallback: show basic navbar structure
      document.getElementById("navbar-placeholder").innerHTML = `
        <nav class="navbar navbar-expand-md navbar-light">
          <div class="container">
            <a class="navbar-brand fw-bold" href="/index.html">Sancturia Wildlife</a>
          </div>
        </nav>
      `;
    });
});

// Function to detect if we're on home page and apply appropriate theme
function isHomePage() {
  const path = window.location.pathname;
  const page = path.split("/").pop();
  return page === "" || page === "index.html" || path === "/" || path.endsWith("/");
}

// Apply navbar theme based on page
function applyNavbarTheme() {
  const navbar = document.querySelector('.navbar');
  const navbarBrand = document.querySelector('.navbar-brand img');
  
  if (isHomePage()) {
    // HOME PAGE: White/Light theme (inverted)
    navbar.classList.remove('navbar-light');
    navbar.classList.add('navbar-dark');
    
    // Change logo to white version (ROOT path)
    if (navbarBrand) {
      navbarBrand.src = '/Assets_TBU/Background Images/Sancturia Logo White.png';
    }
    
    // Change all nav links to outline-light
    document.querySelectorAll("#navBarList .btn").forEach(btn => {
      btn.classList.remove('btn-outline-dark', 'btn-dark');
      btn.classList.add('btn-outline-light');
    });
  } else {
    // OTHER PAGES: Dark/Black theme (default)
    navbar.classList.remove('navbar-dark');
    navbar.classList.add('navbar-light');
    
    // Change logo to black version (ROOT path)
    if (navbarBrand) {
      navbarBrand.src = '/Assets_TBU/Background Images/Sancturia Logo Black.png';
    }
    
    // Keep nav links as outline-dark (already set in HTML)
  }
}

// Function to check if user is logged in
function checkLoginStatus() {
  const isHome = isHomePage();
  const isInRoot = !window.location.pathname.includes('/pages/');
  const sessionPath = isInRoot ? "/pages/auth/check_session.php" : "../auth/check_session.php";
  
  fetch(sessionPath)
    .then(response => response.json())
    .then(data => {
      const authButtonsContainer = document.getElementById("auth-buttons");
      
      if (data.logged_in) {
        // User is logged in - show Dashboard and Logout
        if (isHome) {
          // HOME PAGE: Light buttons
          authButtonsContainer.innerHTML = `
            <span class="text-light me-3 d-none d-md-inline fw-bold">
              <i class="fas fa-user-circle"></i> ${escapeHtml(data.user_name)}
            </span>
            <a href="/pages/dashboard/dashboard.php" class="btn btn-light me-2">
              <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="/pages/login-signup/logout.php" class="btn btn-outline-light">
              <i class="fas fa-sign-out-alt"></i> Logout
            </a>
          `;
        } else {
          // OTHER PAGES: Dark buttons
          authButtonsContainer.innerHTML = `
            <span class="text-dark me-3 d-none d-md-inline fw-bold">
              <i class="fas fa-user-circle"></i> ${escapeHtml(data.user_name)}
            </span>
            <a href="/pages/dashboard/dashboard.php" class="btn btn-success me-2">
              <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="/pages/login-signup/logout.php" class="btn btn-outline-danger">
              <i class="fas fa-sign-out-alt"></i> Logout
            </a>
          `;
        }
      } else {
        // User is not logged in
        if (isHome) {
          // HOME PAGE: Light buttons
          authButtonsContainer.innerHTML = `
            <a href="/pages/login-signup/signup.php" class="btn btn-outline-light me-2">Sign Up</a>
            <a href="/pages/login-signup/login.php" class="btn btn-outline-light">Login</a>
          `;
        } else {
          // OTHER PAGES: Dark buttons
          authButtonsContainer.innerHTML = `
            <a href="/pages/login-signup/signup.php" class="btn btn-outline-dark me-2">Sign Up</a>
            <a href="/pages/login-signup/login.php" class="btn btn-outline-dark">Login</a>
          `;
        }
      }
    })
    .catch(error => {
      console.error("Error checking login status:", error);
      const authButtonsContainer = document.getElementById("auth-buttons");
      if (authButtonsContainer) {
        if (isHome) {
          // HOME PAGE: Light buttons
          authButtonsContainer.innerHTML = `
            <a href="/pages/login-signup/signup.php" class="btn btn-outline-light me-2">Sign Up</a>
            <a href="/pages/login-signup/login.php" class="btn btn-outline-light">Login</a>
          `;
        } else {
          // OTHER PAGES: Dark buttons
          authButtonsContainer.innerHTML = `
            <a href="/pages/login-signup/signup.php" class="btn btn-outline-dark me-2">Sign Up</a>
            <a href="/pages/login-signup/login.php" class="btn btn-outline-dark">Login</a>
          `;
        }
      }
    });
}

// Function to highlight active page in navigation
function highlightActivePage() {
  const currentPath = window.location.pathname;
  const currentPage = currentPath.split("/").pop() || "index.html";
  const isHome = isHomePage();

  document.querySelectorAll("#navBarList a").forEach(link => {
    const linkHref = link.getAttribute("href");
    const linkPage = linkHref.split("/").pop();
    
    // Check if this link matches current page
    if (linkPage === currentPage || 
        (currentPage === "" && linkPage === "index.html") ||
        (currentPath.includes(linkPage.replace(".html", "")))) {
      
      // Remove outline classes and apply active
      if (isHome) {
        // HOME PAGE: Active button is solid light/white
        link.classList.remove("btn-outline-light", "btn-outline-dark");
        link.classList.add("btn-light");
      } else {
        // OTHER PAGES: Active button is solid dark
        link.classList.remove("btn-outline-dark", "btn-outline-light");
        link.classList.add("btn-dark");
      }
    }
  });
}

// Helper function to escape HTML and prevent XSS
function escapeHtml(text) {
  const map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };
  return text.replace(/[&<>"']/g, m => map[m]);
}