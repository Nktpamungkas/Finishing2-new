<?php
    ini_set("error_reporting", 1);
    session_start();
    $timeout = 10; // Set timeout menit
    $logout_redirect_url = "../login.php"; // Set logout URL

    $_SESSION['start_time'] = time();
    //request page
    $page   = isset($_GET['p']) ? $_GET['p'] : '';
    $act    = isset($_GET['act']) ? $_GET['act'] : '';
    $id     = isset($_GET['id']) ? $_GET['id'] : '';
    $page   = strtolower($page);
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<body>
    <div id="art-main">
        <div class="art-sheet clearfix">
            <div class="art-layout-wrapper">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-content">
                            <article class="art-post art-article">
                                <?php
                                    if (!empty($page) and !empty($act)) {
                                        $files = 'pages/' . $page . '.' . $act . '.php';
                                    } else if (!empty($page)) {
                                        $files = 'pages/' . $page . '.php';
                                    } else {
                                        $files = 'pages/home.php';
                                    }

                                    if (file_exists($files)) {
                                        include_once($files);
                                    } else {
                                        echo '<img src="../images/404.png" width="668" height="437">';
                                    }
                                ?>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>