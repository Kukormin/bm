<?
if (isset($_POST['name1'],
    $_POST['telephone1'],
    $_POST['text'],
    $_POST['city1'])) {

    $name = trim(htmlspecialchars($_POST['name1']));
    $telephone = trim(htmlspecialchars($_POST['telephone1']));
    $city = trim(htmlspecialchars($_POST['city1']));
    $text = trim(htmlspecialchars($_POST['text']));


    $json = array();
    $json['error'] = array();
    $json['success'] = array();
    $json['status'] = array();
    if (!$name) {
        $json['error'][] = "name1";
    }else{
        $json['success'][] = "name1";
    }
    if (!$city) {
        $json['error'][] = 'city1';
    }else{
        $json['success'][] = 'city1';
    }
    if (!$telephone) {
        $json['error'][] = 'telephone1';
    }else{
        $json['success'][] = 'telephone1';
    }
    if (!$text) {
        $json['error'][] = 'text';
    }else{
        $json['success'][] = 'text';
    }


    $json['status'] = empty($json['error']);


    echo json_encode($json);
}

?>