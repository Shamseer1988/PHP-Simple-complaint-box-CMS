<?php session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['admin_Email']) == 0) {
    header('location:index.php');
} else { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <link rel="stylesheet" href="css/sidebar-style.css">
        <link rel="stylesheet" href="css/style.css">
        <link href="css/style-responsive.css" rel="stylesheet">
    </head>


    <body id="body-pd">
        <header class="header" id="header">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
            <?php $query = mysqli_query($db, "select * from admin where id='" . $_SESSION['adminId'] . "'");
            while ($row = mysqli_fetch_array($query)) { ?>
                <div class="header_img"> </div>
                <div class="header-text">Welcome <?php echo htmlentities($row['adminName']); ?></div>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="#" class="nav_logo">
                        <i class='bx bx-layer nav_logo-icon'></i>
                        <span class="nav_logo-name"><?php echo htmlentities($row['adminName']); ?></span>
                    <?php } ?>
                    </a>
                    <div class="nav_list">
                        <a href="dashbord.php" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span>
                        </a>
                        <a href="complaint-history.php" class="nav_link"> <i class='bx  bx-history nav_icon'></i> <span class="nav_name">Complaint History</span>
                        </a>
                        <a href="products.php" class="nav_link"> <i class="bx bxl-product-hunt nav_icon"></i> <span class="nav_name">Products</span>
                        </a>
                        <a href="user-detailes.php" class="nav_link"> <i class='bx bxs-user-circle nav_icon'></i> <span class="nav_name">User Detailes</span>
                        </a>
                        <a href="user-detailes.php" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Account Settings</span>
                        </a>
                    </div>
                </div>
                <a href="logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
            </nav>
        </div>




        <script>
            document.addEventListener("DOMContentLoaded", function(event) {

                const showNavbar = (toggleId, navId, bodyId, headerId) => {
                    const toggle = document.getElementById(toggleId),
                        nav = document.getElementById(navId),
                        bodypd = document.getElementById(bodyId),
                        headerpd = document.getElementById(headerId)

                    // Validate that all variables exist
                    if (toggle && nav && bodypd && headerpd) {
                        toggle.addEventListener('click', () => {
                            // show navbar
                            nav.classList.toggle('showtext')
                            // change icon
                            toggle.classList.toggle('bx-x')
                            // add padding to body
                            bodypd.classList.toggle('body-pd')
                            // add padding to header
                            headerpd.classList.toggle('body-pd')
                        })
                    }
                }

                showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

                /*===== LINK ACTIVE =====*/
                const linkColor = document.querySelectorAll('.nav_link')

                function colorLink() {
                    if (linkColor) {
                        linkColor.forEach(l => l.classList.remove('active'))
                        this.classList.add('active')
                    }
                }
                linkColor.forEach(l => l.addEventListener('click', colorLink))

                // Your code to run since DOM is loaded and ready
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>

    </html>

<?php } ?>