<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>add students</title>
</head>
<body>
    <?php 
    include("nav.php");
    ?>
    <section class="dashboard">
    <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
        
            <img src="2.png" alt="">
            </div>
                
            <div class="dash-content">
                    <?php 
                    include("form.php");
                    ?>
            </div>
    </section>
    <script src="script.js"></script>
</body>
</html>