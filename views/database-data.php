<?php
$all_animals = \models\Animal::getAnimals(array(), true);

if (!empty($all_animals)) {
    ?>
    <div class="panel panel-default">
        <div class="panel-heading"><h3>All current animals from database</h3></div>
        <div class="panel-body">
            <p>Table show all of current inserted animals data in database</p>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Eat</th>
                    <th>date_created</th>
                </tr>
            </thead>
            <?php
            foreach ($all_animals as $key => $data) {
                ?>
                <tr>
                    <td><?php echo $all_animals[$key]['id']; ?></td>
                    <td><?php echo $all_animals[$key]['category']; ?></td>
                    <td><?php echo $all_animals[$key]['subcategory']; ?></td>
                    <td><?php echo $all_animals[$key]['name']; ?></td>
                    <td><?php echo $all_animals[$key]['description']; ?></td>
                    <td><?php echo $all_animals[$key]['eat']; ?></td>
                    <td><?php echo $all_animals[$key]['date_created']; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>

    </div>
    <?php
}
else {
    echo '<div class="alert alert-danger">Currently there are not any rows in database</div>';
}
?>