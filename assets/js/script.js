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
                if ( (code === 13) ) {
                    navigation.classList.toggle("isVisible");
		        }
            }, true);
        }
    }
    jlbestblog_toggleMobileTopMenu();

    // Set tabindex order on mobile
    function jlbestblog_set_mobile_elements_order() {
        const skip_link = document.querySelector(".skip-link");
        const last_menu_element = document.querySelector(".main-menu-class ul").lastElementChild.querySelector("[href]:last-child");
        const search_submit = document.querySelector(".search-submit");
        const last_top_menu_element = document.querySelector(".top-menu-class ul").lastElementChild.querySelector("[href]:last-child");
        const main_content = document.getElementById("main-content--section");
        const focusable_content_element = main_content.querySelector('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
        const last_focusable_content_element = main_content.lastElementChild.querySelector('button:last-child, [href]:last-child, input:last-child, select:last-child, textarea:last-child, [tabindex]:not([tabindex="-1"]):last-child');
        const column = document.querySelector(".column");
        const last_focusable_column_element = column.lastElementChild.querySelector('button:last-child, [href]:last-child, input:last-child, select:last-child, textarea:last-child, [tabindex]:not([tabindex="-1"]):last-child');
        const footer = document.querySelector(".footer");
console.log(last_top_menu_element)
        skip_link.addEventListener("blur", function() {
            document.getElementById("mobile-menu-icon").focus();
        });

        last_menu_element.addEventListener("blur", function() {
            document.getElementById("navigation").classList.toggle("isVisible");
            document.querySelector(".header-text").focus();
        });

        search_submit.addEventListener("blur", function() {
            document.getElementById("mobile-top-menu-container").focus();
        });

        last_top_menu_element.addEventListener("blur", function() {
            document.querySelector(".top-menu-class").classList.toggle("isVisible");
            focusable_content_element.focus();
        });

        last_focusable_content_element.addEventListener("blur", function() {
            column.querySelector('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])').focus();
        });

        last_focusable_column_element.addEventListener("blur", function() {
            footer.querySelector('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])').focus();
            console.log(footer)
        });
    }
    jlbestblog_set_mobile_elements_order();
    
});

