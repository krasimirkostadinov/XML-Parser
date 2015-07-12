<div class="xml-content">
    <?php
    $parser_obj = new \models\Parser($dir_path);
    $all_xml_paths = $parser_obj->getXMLPaths($dir_path);
    ?>
    <h2>Full paths to all XML files <?php echo ($parser_obj->isDerectory()) ? 'in folder <strong>'.$parser_obj->getFolderName().'</strong>' : ''; ?></h2>
    <p>Number of files: <?php echo count($all_xml_paths); ?></p>
    <ol class="full-xml-paths">
        <?php foreach ($all_xml_paths as $key => $single_xml_path) { ?>
            <li><?php echo $single_xml_path; ?></li>
            <?php
        }
        ?>
    </ol>
    <a href="#" class="btn btn-info" id="add-xml-data">Import XML data into database</a>
</div>
