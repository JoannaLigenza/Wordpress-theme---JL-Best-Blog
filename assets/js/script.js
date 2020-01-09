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

    // Toggle mobile top menu
    const toggleMobileTopMenu = () => {
        const mobileMenuIcon = document.getElementById("mobile-top-menu-container");
        const navigation = document.querySelector(".top-menu-class");
        mobileMenuIcon.addEventListener("click", function() {
            navigation.classList.toggle("isVisible");
        }, true);
    }
    toggleMobileTopMenu();


});

