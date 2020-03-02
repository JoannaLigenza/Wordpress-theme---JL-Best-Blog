document.addEventListener('DOMContentLoaded', (event) => {
    
    // Toggle mobile menu
    const jlbestblog_toggleMobileMenu = () => {
        const mobileMenuIcon = document.getElementById("mobile-menu-icon");
        const navigation = document.getElementById("navigation");
        if (mobileMenuIcon) {
            mobileMenuIcon.addEventListener("click", function() {
                navigation.classList.toggle("isVisible");
            }, true);
        }
    }
    jlbestblog_toggleMobileMenu();

    // Toggle mobile top menu
    const jlbestblog_toggleMobileTopMenu = () => {
        const mobileMenuIcon = document.getElementById("mobile-top-menu-container");
        const navigation = document.querySelector(".top-menu-class");
        if (mobileMenuIcon) {
                mobileMenuIcon.addEventListener("click", function() {
                navigation.classList.toggle("isVisible");
            }, true);
        }
    }
    jlbestblog_toggleMobileTopMenu();
    
});

