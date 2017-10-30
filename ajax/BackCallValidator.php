<?
if (isset($_POST['name'],
    $_POST['telephone'],
    $_POST['city'])) {

    $name = trim(htmlspecialchars($_POST['name']));
    $telephone = trim(htmlspecialchars($_POST['telephone']));
    $city = trim(htmlspecialchars($_POST['city']));


    $json = array();
    $json['error'] = array();
    $json['success'] = array();
    $json['status'] = array();
    if (!$name) {
        $json['error'][] = "name";
    }else{
        $json['success'][] = "name";
    }
    if (!$city) {
        $json['error'][] = 'city';
    }else{
        $json['success'][] = 'city';
    }
    if (!$telephone) {
        $json['error'][] = 'telephone';
    }else{
        $json['success'][] = 'telephone';
    }

    $json['status'] = empty($json['error']);


    echo json_encode($json);
}

?>