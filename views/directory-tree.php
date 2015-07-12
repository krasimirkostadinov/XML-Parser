<div class="directory-tree">
    <?php if (is_dir($dir_path)) { ?>
        <h2>Files structure of folder <?php echo basename($dir_path); ?></h2>
        <?php
        \models\Parser::showDirTree($dir_path);
    }
    ?>
</div>
