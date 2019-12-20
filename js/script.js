document.addEventListener('DOMContentLoaded', (event) => {
    
    // Toggle mobile menu
    const toggleMobileMenu = () => {
        const mobileMenuIcon = document.getElementById("mobile-menu-icon");
        const navigation = document.getElementById("navigation");
        mobileMenuIcon.addEventListener("click", function() {
            navigation.classList.toggle("isVisible");
        }, true);
    }
    toggleMobileMenu();


});

