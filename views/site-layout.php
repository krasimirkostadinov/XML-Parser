<div class="row clearfix" role="tabpanel">
    <ul class="nav nav-tabs animals-tab" role="tablist">
        <li role="presentation" class="active"><a href="#tab-three" id="tab-to-three" aria-controls="tab-one" role="tab" data-toggle="tab" aria-expanded="true">Show Database</a></li>
        <li role="presentation"><a href="#tab-two" id="tab-to-two" aria-controls="tab-one" role="tab" data-toggle="tab">Show XML file paths</a></li>
        <li role="presentation"><a href="#tab-four" id="tab-to-four" aria-controls="tab-four" role="tab" data-toggle="tab">Show XML file's contents</a></li>
        <li role="presentation"><a href="#tab-one" id="tab-to-one" aria-controls="tab-one" role="tab" data-toggle="tab">Show directory tree</a></li>
    </ul>
    <div class="tab-content">
        <div id="tab-three" role="tabpanel" class="tab-pane fade in active" aria-labelledby="tab-to-two">
            <?php
            //----------- Get all current data from DB on page load ----------
            require_once ROOT_PATH . '/views/database-data.php';
            ?>
        </div>
        <div id="tab-two" role="tabpanel" class="tab-pane fade" aria-labelledby="tab-to-two">
            <?php
            //----------- Get paths of all xmls -------------------
            require_once ROOT_PATH . '/views/xml-paths.php';
            ?>
        </div>
        <div id="tab-one" role="tabpanel" class="tab-pane fade" aria-labelledby="tab-to-one">
            <?php
            //---------- Get files structure in given folder
            require_once ROOT_PATH . '/views/directory-tree.php';
            ?>
        </div>
        <div id="tab-four" role="tabpanel" class="tab-pane fade" aria-labelledby="tab-to-four">
            <?php
            //---------- Get files structure in given folder
            require_once ROOT_PATH . '/views/xml-content.php';
            ?>
        </div>
    </div>
</div>