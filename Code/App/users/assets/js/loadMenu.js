$(document).ready(function () {
    $("body").height($(window).height());
});

document.addEventListener('DOMContentLoaded', function () {
    // header
//    let header = '<div class="header_toggle"><i class="bx bx-menu text-dark" id="header-toggle"></i></div>' +
//        '<form class="w-50"><input type="search" class="form-control" placeholder="Tìm kiếm..." aria-label="Search" /> </form>' +
//        '<div class="dropdown text-end">' +
//        '<a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="user" data-bs-toggle="dropdown" aria-expanded="false">' +
//        '<img src="./assets/image/avt_pro.jpg" alt="quản trị" width="40" height="40" class="rounded-circle" /></a>' +
//        '<ul class="dropdown-menu text-small" aria-labelledby="user" style="min-width: 256px;">' +
//        '<li><a class="dropdown-item" href="#">Quản lý</a></li>' +
//        '<li><a class="dropdown-item" href="#">Trang cá nhân</a></li>' +
//        '<li><a class="dropdown-item" href="#">Cài đặt cá nhân</a></li>' +
//        '<li><hr class="dropdown-divider" /></li>' +
//        '<form action="<?php echo $_SERVER[\'PHP_SELF\']; ?>" method="POST"><li><a id="signout-1" name="signout-1" class="dropdown-item" href="#">Đăng xuất</a></li><form></ul>' +
//        '</div>';
//    document.querySelector("#header").innerHTML = header;

    // sidebar
    let sidebar = ` <nav class="nav" id="style-11">
                        <div class="">
                            <a href="#" class="nav_logo"> <i class="text-white bi bi-stack"></i> <span class="nav_logo-name">Manager</span> </a>
                            <div class="nav_list">
                                <div id="showdashboard">
                                    <a href="#" class="nav_link active"> <i class="bx bx-grid-alt nav_icon"></i> <span class="nav_name">Dashboard</span> </a>
                                </div>
                                <a href="#" class="nav_link"> <i class="bx bi bi-bell nav_icon"></i> <span class="nav_name">Notify</span> </a>
                                <div id="showmenu0">
                                    <a href="#" class="nav_link collapsed rounded" data-bs-toggle="collapse" data-bs-target="#menu0">
                                        <i class="bx bi bi-stickies nav_icon"></i> <span class="nav_name float-start">Test <i class="bi bi-chevron-compact-down"></i></span>
                                    </a>
                                </div>
                                <div class="menu mb-0 pt-0 pb-0 collapse" id="menu0">
                                    <ul class="btn-toggle-nav list-unstyled fw-normal small">
                                        <li><a class="dropdown-item cl-1" href="#">item 1</a></li>
                                        <li><a class="dropdown-item cl-1" href="#">item 2</a></li>
                                    </ul>
                                </div>
                                <div id="showmenu1">
                                    <a href="#" class="nav_link collapsed rounded" data-bs-toggle="collapse" data-bs-target="#menu1">
                                        <i class="bx bi bi-file-font nav_icon"></i> <span class="nav_name float-start">Test <i class="bi bi-chevron-compact-down"></i></span>
                                    </a>
                                </div>
                                <div class="menu mb-0 pt-0 pb-0 collapse" id="menu1">
                                    <ul class="btn-toggle-nav list-unstyled fw-normal small">
                                        <li><a class="dropdown-item cl-1" href="#">item 1</a></li>
                                        <li><a class="dropdown-item cl-1" href="#">item 2</a></li>
                                    </ul>
                                </div>
                                <div id="showmenu2">
                                    <a href="#" class="nav_link collapsed rounded" data-bs-toggle="collapse" data-bs-target="#menu2">
                                        <i class="bx bi bi-question-circle nav_icon"></i> <span class="nav_name float-start">Test <i class="bi bi-chevron-compact-down"></i></span>
                                    </a>
                                </div>
                                <div class="menu mb-0 pt-0 pb-0 collapse" id="menu2">
                                    <ul class="btn-toggle-nav list-unstyled fw-normal small">
                                        <li><a id="inputquestion" class="dropdown-item cl-1" href="#">item 1</a></li>
                                        <li><a id="ds-question" class="dropdown-item cl-1" href="#">item 2</a></li>
                                    </ul>
                                </div>
                                <div id="showmenu3">
                                    <a href="#" class="nav_link collapsed rounded" data-bs-toggle="collapse" data-bs-target="#menu3">
                                        <i class="bx bi bi-card-text nav_icon"></i> <span class="nav_name float-start">Test <i class="bi bi-chevron-compact-down"></i></span>
                                    </a>
                                </div>
                                <div class="menu mb-0 pt-0 pb-0 collapse" id="menu3">
                                    <ul class="btn-toggle-nav list-unstyled fw-normal small">
                                        <li><a id="ds-answerid" class="dropdown-item cl-1" href="#">item 2</a></li>
                                    </ul>
                                </div>
                                <div id="showmenu4">
                                    <a href="#" class="nav_link collapsed rounded" data-bs-toggle="collapse" data-bs-target="#menu4">
                                        <i class="bx bi bi-reply nav_icon"></i> <span class="nav_name float-start">Test <i class="bi bi-chevron-compact-down"></i></span>
                                    </a>
                                </div>
                                <div class="menu mb-0 pt-0 pb-0 collapse" id="menu4">
                                    <ul class="btn-toggle-nav list-unstyled fw-normal small">
                                        <li><a id="inputanswer" class="dropdown-item cl-1" href="#">item 1</a></li>
                                        <li><a id="ds-answer" class="dropdown-item cl-1" href="#">item 2</a></li>
                                    </ul>
                                </div>
                                <div id="showmenu5">
                                    <a href="#" class="nav_link collapsed rounded" data-bs-toggle="collapse" data-bs-target="#menu5">
                                        <i class="bx bi bi-list-check nav_icon"></i> <span class="nav_name float-start">Test <i class="bi bi-chevron-compact-down"></i></span>
                                    </a>
                                </div>
                                <div class="menu mb-0 pt-0 pb-0 collapse" id="menu5">
                                    <ul class="btn-toggle-nav list-unstyled fw-normal small">
                                        <li><a class="dropdown-item cl-1" href="#">item 1</a></li>
                                        <li><a id="ds-answerlist" class="dropdown-item cl-1" href="#">item 2</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
`;
    document.querySelector("#nav-bar").innerHTML = sidebar;

    // footer
    let footer = `  <div class="d-flex justify-content-between align-items-center" style="padding: 0 1rem;">
                        <p>© All copyright</p>
                        <div class="d-flex align-items-center" style="margin-top: -10px;">
                            <a class="m-1" href="https://www.facebook.com"><i class="bx bi bi-facebook nav_icon"></i></a><a class="m-1" href="https://www.github.com"><i class="text-dark bx bi bi-github nav_icon"></i></a>
                        </div>
                    </div>`;
    document.querySelector("#footer").innerHTML = footer;




    // show navbar
    const showNavbar = (toggleId, navId, bodyId, headerId, footerId) => {
        const toggle = document.getElementById(toggleId),
            nav = document.getElementById(navId),
            bodypd = document.getElementById(bodyId),
            headerpd = document.getElementById(headerId);
        footerpd = document.getElementById(footerId);

        // Xác thực rằng tất cả các biến đều tồn tại
        if (toggle && nav && bodypd && headerpd) {
            toggle.addEventListener("click", () => {
                // show navbar
                nav.classList.toggle("showsidebar");
                // change icon
                // toggle.classList.toggle("bx-x");
                // add padding to body
                //bodypd.classList.toggle("body-pd");
                // add padding to header
                headerpd.classList.toggle("body-pd");
                // add padding to footer
                footerpd.classList.toggle("body-pd");
            });
        }

        // khi ấn vào menu thì show luôn sidebar
        $('#showmenu0, #showmenu1, #showmenu2, #showmenu3, #showmenu4, #showmenu5').click(function (e) {
            // alert('a');
            // show navbar
            nav.classList.add("showsidebar");
            // change icon
            //toggle.classList.add("bx-x");
            // add padding to body
            // bodypd.classList.add("body-pd");
            // add padding to header
            headerpd.classList.add("body-pd");
            // add padding to footer
            footerpd.classList.add("body-pd");
        });

        // Ngăn chặn mọi sự lan truyền của cùng một sự kiện
        $('#nav-bar, #body-pd, #header, #footer, #header-toggle').click(function (e) {
            e.stopPropagation();
        });

        if (window.screen.width <= 820) {
            // remove class nếu màn hình 820 trở xuống
            $('#nav-bar').removeClass('showsidebar');
            $('#header').removeClass('body-pd');
            $('#footer').removeClass('body-pd');
            $('#body-pd').removeClass('body-pd');
            $('#header-toggle').removeClass('bx-x');

            // click ở màn hình bé
            $('body,html').click(function (e) {
                $('#nav-bar').removeClass('showsidebar');
                $('#header').removeClass('body-pd');
                $('#footer').removeClass('body-pd');
                $('#body-pd').removeClass('body-pd');
                $('#header-toggle').removeClass('bx-x');
            });
        }
    };

    showNavbar("header-toggle", "nav-bar", "body-pd", "header", "footer");

    /*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll(".nav_link");

    function colorLink() {
        if (linkColor) {
            linkColor.forEach((l) => l.classList.remove("active"));
            this.classList.add("active");
        }
    }
    linkColor.forEach((l) => l.addEventListener("click", colorLink));

});


