<?php 

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Responsive Sidebar Menu | CodingLab </title>
    <link rel="stylesheet" href="../css/navStyle.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bxl-c-plus-plus icon'></i>
            <div class="logo_name">RG school</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <!-- <li>
                <form method="post" name="search">
                    <i class='bx bx-search'></i>
                    <input type="text" name="valueToSearch" id="searchInput" placeholder="Search...">
                    <span class="tooltip">Search</span>
                </form>
            </li> -->
            <li>
                <a href="index.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="dashGrp.php">
                    <i class='bx bx-group' style='color:#ffffff'></i>
                    <span class="links_name">Groupes</span>
                </a>
                <span class="tooltip">Groupes</span>
            </li>
            <li>
                <a href="addStudents.php">
                    <i class='bx bx-user-plus'></i>
                    <span class="links_name">Add student</span>
                </a>
                <span class="tooltip">Add student</span>
            </li>

            <li>
                <a href="../../front-end/html/analytics.php">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">Analytics</span>
                </a>
                <span class="tooltip">Analytics</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Setting</span>
                </a>
                <span class="tooltip">Setting</span>
            </li>
            <li class="profile">
                <div class="profile-details">
                    <img src="../../images/2.png" alt="profileImg">
                    <div class="name_job">
                        <div class="name"><?php echo $_SESSION['firsName']  ?></div>
                        <div class="job">Admin</div>
                    </div>
                </div>
                <a href="login.php"><i class='bx bx-log-out' id="log_out"></i></a>
            </li>
        </ul>
    </div>

    <script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    let searchBtn = document.querySelector(".bx-search");
    let searchInput = document.getElementById("searchInput");


    closeBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        menuBtnChange(); //calling the function(optional)
    });

    searchBtn.addEventListener("click", () => { // Sidebar open when you click on the search iocn
        sidebar.classList.toggle("open");
        menuBtnChange(); //calling the function(optional)
    });


    searchInput.addEventListener("keyup", (event) => {
        if (event.key === "Enter") {
            document.forms["searchForm"].submit();
        }
    });

    // following are the code to change sidebar button(optional)
    function menuBtnChange() {
        if (sidebar.classList.contains("open")) {
            closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the iocns class
        } else {
            closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the iocns class
        }
    }
    </script>
</body>

</html>