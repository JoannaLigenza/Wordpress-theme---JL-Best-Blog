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
        const navigation = document.querySelector(".top-menu-class");
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


    function jlbestblog_set_mobile_elements_order() {
        const is_mobile = window.matchMedia("screen and (max-width: 768px)").matches;
        if(is_mobile) {
            const skip_link = document.querySelector(".skip-link");
            const mobile_menu = document.getElementById("mobile-menu-icon");
            const last_menu_element = document.querySelector(".main-menu-class ul").lastElementChild.querySelector("[href]:last-child");
            const header_text = document.querySelector(".header-text");
            const navigation = document.getElementById("navigation");
            const search_submit = document.querySelector(".search-submit");
            const mobile_top_menu = document.getElementById("mobile-top-menu-container");
            const top_menu = document.querySelector(".top-menu-class");
            const last_top_menu_element = document.querySelector(".top-menu-class ul").lastElementChild.querySelector("[href]:last-child");
            const main_content = document.getElementById("main-content--section");
            const focusable_content_element = main_content.querySelector('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
            let last_focusable_content_element = main_content.lastElementChild.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
            last_focusable_content_element = last_focusable_content_element[last_focusable_content_element.length -1];
            const column = document.querySelector(".column").querySelector('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
            let last_focusable_column_element = document.querySelector(".column").lastElementChild.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
            last_focusable_column_element = last_focusable_column_element[last_focusable_column_element.length - 1];
            const footer = document.querySelector(".footer").querySelector('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
            on_blur(skip_link, mobile_menu);
            on_blur(last_menu_element, header_text, navigation);
            on_blur(search_submit, mobile_top_menu);
            on_blur(last_top_menu_element, focusable_content_element, top_menu);
            on_blur(last_focusable_content_element, column);
            on_blur(last_focusable_column_element, footer);
        }
    }
    jlbestblog_set_mobile_elements_order();

    function on_blur(blur_element, focus_element, remove_class_element = null) {
        blur_element.addEventListener("blur", function() {
            focus_element.focus();
            if (remove_class_element !== null) {
                remove_class_element.classList.toggle("isVisible");
            }
        });
    }
    
});

