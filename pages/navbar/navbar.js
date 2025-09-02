document.addEventListener("DOMContentLoaded", function () {
  fetch("/pages/navbar/navbar.html") // adjust if navbar.html is not in root
    .then(response => response.text())
    .then(data => {
      document.getElementById("navbar-placeholder").innerHTML = data;

      // Get current file name (e.g. "about.html")
      const currentPage = window.location.pathname.split("/").pop();

      // Loop through navbar links
      document.querySelectorAll("#navBarList a").forEach(link => {
        const linkPage = link.getAttribute("href").split("/").pop(); 
        if (linkPage === currentPage) {
          // Remove outline classes and apply active
          link.classList.remove("btn-outline-dark", "btn-outline-light");
          link.classList.add("btn-dark");
        }
      });
    })
    .catch(error => console.error("Error loading navbar:", error));
});
