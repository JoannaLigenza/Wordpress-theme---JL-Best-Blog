document.addEventListener('DOMContentLoaded', (event) => {
    
    // Toggle mobile menu
    const jlbestblog_toggleMobileMenu = () => {
        const mobileMenuIcon = document.getElementById("mobile-menu-icon");
        const navigation = document.getElementById("navigation");
        if (mobileMenuIcon) {
            mobileMenuIcon.addEventListener("mousedown", function() {
                navigation.classList.toggle("isVisible");
            }, true);
            mobileMenuIcon.addEventListener("focus", function() {
                navigation.classList.add("isVisible");
            }, true);
            mobileMenuIcon.addEventListener("keydown", function(e) {
                const code = e.which;
                if ( code === 13 ) {
                    navigation.classList.toggle("isVisible");
		        }
            }, true);
        }
    }
    jlbestblog_toggleMobileMenu();

    // Toggle mobile top menu
    const jlbestblog_toggleMobileTopMenu = () => {
        const mobileMenuIcon = document.getElementById("mobile-top-menu-container");
        const navigation = document.querySelector(".mobile-top-menu-class");
        if (mobileMenuIcon) {
            mobileMenuIcon.addEventListener("mousedown", function() {
                navigation.classList.toggle("isVisible");
            }, true);
            mobileMenuIcon.addEventListener("focus", function() {
                navigation.classList.add("isVisible");
            }, true);
            mobileMenuIcon.addEventListener("keydown", function(e) {
                const code = e.which;
                if ( code === 13 ) {
                    navigation.classList.toggle("isVisible");
		        }
            }, true);
        }
    }
    jlbestblog_toggleMobileTopMenu();

    // Actions made when tabbing content
    function jlbestblog_tab_mobile() {
        const last_menu_element = document.querySelector(".main-menu-class ul").lastElementChild.querySelector("[href]:last-child");
        const navigation = document.getElementById("navigation");
        const last_top_menu_element = document.querySelector(".mobile-top-menu-class ul").lastElementChild.querySelector("[href]:last-child");
        const top_menu = document.querySelector(".mobile-top-menu-class");
        on_blur(last_menu_element, navigation);
        on_blur(last_top_menu_element, top_menu);
    }
    jlbestblog_tab_mobile();

    function on_blur(blur_element, remove_class_element = null) {
        blur_element.addEventListener("blur", function() {
            if (remove_class_element !== null) {
                remove_class_element.classList.toggle("isVisible");
            }
        });
    }
    
});

