<?php
require_once './config.php';
require_once ROOT_PATH . '/views/header.php';
require_once ROOT_PATH . '/models/Database.php';
require_once ROOT_PATH . '/models/Parser.php';
require_once ROOT_PATH . '/models/Animal.php';
?>
<div class="container-fluid main-container">
    <div class="row clearfix">
        <div class="container">
            <h1>Please use navigation tabs to review components</h1>
            <?php
            //----------- Container of search results ----------
            require_once ROOT_PATH . '/views/search-result.php';

            //----------- Include site layout ----------
            require_once ROOT_PATH . '/views/site-layout.php';
            ?>
        </div>
    </div>
</div>
<?php
require_once ROOT_PATH . '/views/footer.php';
?>



