<?php
require_once '../config.php';
require_once ROOT_PATH . '/models/Database.php';
require_once ROOT_PATH . '/models/Animal.php';

if (!empty($_POST['searched_text'])) {
    //filter and validate searched data
    $searched_text = \models\Database::validateData($_POST['searched_text'], 'string|specialchars|strip_tags');
    $params = array(
        'search_name' => $searched_text
    );
    $searched_animals = \models\Animal::getAnimals($params, true);
    $search_result = '';
    if (!empty($searched_animals)) {
        foreach ($searched_animals as $key => $data) {
            $search_result .= '<tr>';
            $search_result .= '<td>' . $searched_animals[$key]['id'] . '</td>';
            $search_result .= '<td>' . $searched_animals[$key]['category'] . '</td>';
            $search_result .= '<td>' . $searched_animals[$key]['subcategory'] . '</td>';
            $search_result .= '<td>' . $searched_animals[$key]['name'] . '</td>';
            $search_result .= '<td>' . $searched_animals[$key]['description'] . '</td>';
            $search_result .= '<td>' . $searched_animals[$key]['eat'] . '</td>';
            $search_result .= '<td>' . $searched_animals[$key]['date_created'] . '</td>';
            $search_result .= '</tr>';
        }
    }
    else{
        $search_result = '<div class="alert alert-danger">Search results not found.</div>';
    }
    echo json_encode($search_result);
}
else {
    throw new Exception('Empty string given for seach');
}
?>
