<?php 
    include 'database.php';

    if(isset($_GET['id'])){
        $event_id = $_GET['id'];

        // Retrieve event details to get the image filename
        $event_query = mysqli_query($conn, "SELECT event_image FROM tb_event WHERE event_id = '$event_id'");
        $event_data = mysqli_fetch_assoc($event_query);

        // Delete the event from the database
        $delete_query = mysqli_query($conn, "DELETE FROM tb_event WHERE event_id = '$event_id'");

        if($delete_query) {
            // Delete the associated image file
            $image_filename = $event_data['event_image'];
            unlink('./produk/'.$image_filename);

            // Redirect to the data_event.php page after successful deletion
            echo '<script>window.location="data_event.php"</script>';
            exit();
        } else {
            // Handle the case where deletion fails
            die("Error deleting event");
        }
    } else {
        // Handle the case where no event ID is provided
        die("Invalid request");
    }
?>
