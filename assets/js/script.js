document.addEventListener('DOMContentLoaded', (event) => {
    
    // Toggle mobile menu
    const jlbestblog_toggleMobileMenu = () => {
        const mobileMenuIcon = document.getElementById("mobile-menu-icon");
        const navigation = document.getElementById("navigation");
        if (mobileMenuIcon) {
            mobileMenuIcon.addEventListener("mousedown", function() {
                navigation.classList.toggle("isVisible");
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
    function jlbestblog_tab_mobile_menu() {
        const navigation = document.getElementById("navigation");
        const all_mobile_menu_tabs = jlbestblog_get_mobile_menu_tabs( navigation, document.getElementById('mobile-menu-icon') );
        jlbestblog_set_tab_mobile( all_mobile_menu_tabs );
    }
    jlbestblog_tab_mobile_menu();

    function jlbestblog_tab_mobile_top_menu() {
        const navigation = document.querySelector(".mobile-top-menu-class");
        if (navigation !== null) {
            const all_mobile_menu_tabs = jlbestblog_get_mobile_menu_tabs( navigation, document.getElementById("mobile-top-menu-container") );
            jlbestblog_set_tab_mobile( all_mobile_menu_tabs );
        }
    }
    jlbestblog_tab_mobile_top_menu();

    function jlbestblog_get_mobile_menu_tabs( navigation, menu_button ) {
        const mobile_navigation_tabs = navigation.querySelectorAll('button, [href], input, select, textarea');
        const mobile_navigation_tabs_array = Array.from(mobile_navigation_tabs);
        const all_mobile_menu_tabs = [menu_button, ...mobile_navigation_tabs_array];
        return all_mobile_menu_tabs;
    }

    function jlbestblog_set_tab_mobile( all_mobile_menu_tabs ) {
        const content = document.querySelector(".main-container");
        let is_tab_key_pressed = false;
        let is_shift_key_pressed = false;

        content.addEventListener("keydown", function(e) {
            const code = e.which;
            if (code === 9) {
                is_tab_key_pressed = true;
            }
            if (code === 16) {
                is_shift_key_pressed = true;
            }     
        }, true);

        content.addEventListener("keyup", function(e) {
            const code = e.which;
            if (code === 9) {
                is_tab_key_pressed = false;
            }
            if (code === 16) {
                is_shift_key_pressed = false;
            }     
        }, true);

        all_mobile_menu_tabs[0].addEventListener('blur', function() {
            if ( is_tab_key_pressed && is_shift_key_pressed ) {
                all_mobile_menu_tabs[all_mobile_menu_tabs.length-1].focus();
            }
            
        });
        all_mobile_menu_tabs[all_mobile_menu_tabs.length-1].addEventListener('blur', function() {
                if ( is_tab_key_pressed && !is_shift_key_pressed ) {
                all_mobile_menu_tabs[0].focus();
            }
        });
    }

    
});

