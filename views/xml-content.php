<?php
$xml_files_content = $parser_obj->getXMLContent();

if (!empty($xml_files_content)) {
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">All current information from XML files</div>
        <div class="panel-body">
            <p>Table show all of current animals data from XML files in <strong><?php echo $parser_obj->getFolderName(); ?></strong> directory</p>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Eat</th>
                </tr>
            </thead>
            <?php
            foreach ($xml_files_content as $key => $data) {
                foreach ($data as $k => $value) {
                    ?>
                    <tr>
                        <td><?php echo $value->category; ?></td>
                        <td><?php echo $value->subcategory; ?></td>
                        <td><?php echo $value->name; ?></td>
                        <td><?php echo $value->description; ?></td>
                        <td><?php echo $value->eat; ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>

    </div>
    <?php
}
else {
    echo 'There is no information in XML files';
}
?>