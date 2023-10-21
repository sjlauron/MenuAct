<?php
    include 'func.php';
    // $menu_name = '';
    // $menu_desc = '';
    if (isset($_POST['submit'])) {
        $menu_name = trim($_POST['menuName']);
        $menu_desc = trim($_POST['menuDesc']);
        //$price = trim($_POST['price']);
        add_data($menu_name, $menu_desc);
    }

    // $edit_menuname = '';
    // $edit_menudesc = '';
    //$edit_price = '';

    if (isset($_POST['edit'])) {
        $id = trim($_POST['id']);
        $menu_name = trim($_POST['menuName']);
        $menu_desc = trim($_POST['menuDesc']);

        // Perform the update operation in the database
        update_data($menu_name, $menu_desc, $id);

        // Optionally, you can add a success message or redirect the user
        // For example:
        // header('Location: your_success_page.php');
    }

    if (isset($_POST['delete'])) {
        $id = trim($_POST['delete']);
        delete_data($id);
    }
?>