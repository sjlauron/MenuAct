<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
</body>
</html>

<?php
    function conn_db()
    {
        try {
            //if not working, change '3306' to your mysql port
            return new PDO('mysql:host=localhost:3306;dbname=pos_lauron', 'root', '');
        } catch (PDOException $ex) {
            echo "Connection Error: ", $ex->getMessage();
        }
    }

    // Create
    function add_data($menu_name, $menu_desc)
    {
        $db = conn_db();
        $sql = "Insert into ref_menu(menu_name, menu_desc)values(?, ?)";
        $st = $db->prepare($sql);
        if ($st->execute(array($menu_name, $menu_desc))) {
            // Success - Display SweetAlert
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Menu item added!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'addMenu.php'; // Redirect to the main page
                    }
                });
            </script>";
        } else {
            // Error - Display SweetAlert
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to add item!',
                });
            </script>";
        }
        $db = null;
    }

    // Retrieve 
    function view_data()
    {
        $db = conn_db();
        $sql = "SELECT * FROM ref_menu ORDER BY id ASC";
        $st = $db->prepare($sql);
        $st->execute();
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);
        $db = null;
        return $rows;
    }

    // Retrieve JSON format
    function view_data_json()
    {
        $db = conn_db();
        $sql = "SELECT * FROM ref_menu ORDER BY id ASC";
        $st = $db->prepare($sql);
        $st->execute();
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);
        $jsonRes = json_encode($rows);
        echo $jsonRes;
        $db = null;
        return $rows;
    }

    // Update 
    function update_data($menu_name, $menu_desc, $id)
    {
        $db = conn_db();
        $sql = "UPDATE ref_menu SET menu_name=?, menu_desc=? WHERE id=?";
        $st = $db->prepare($sql);
        if ($st->execute([$menu_name, $menu_desc, $id])) {
            // Success - Display SweetAlert
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Menu item updated!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'addMenu.php'; // Redirect to the main page
                    }
                });
            </script>";
        } else {
            // Error - Display SweetAlert
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to update item!',
                });
            </script>";
        }
        $db = null;
    }

    // Delete
    function delete_data($id)
    {
        $db = conn_db();
        $sql = "DELETE FROM ref_menu WHERE id=?";
        $st = $db->prepare($sql);
        if ($st->execute([$id])) {
            // Success - Display SweetAlert
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Menu item deleted!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'addMenu.php'; // Redirect to the main page
                    }
                });
            </script>";
        } else {
            // Error - Display SweetAlert
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to delete item!',
                });
            </script>";
        }
        $db = null;
    }

    // Search
    function search_data($id)
    {
        $db = conn_db();
        $sql = "SELECT * FROM ref_menu WHERE id=?";
        $st = $db->prepare($sql);
        $st->execute(array($id));
        $row = $st->fetch(PDO::FETCH_ASSOC);
        $db = null;
        return $row ?: [];
    }
?>