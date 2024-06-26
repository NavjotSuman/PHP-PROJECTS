<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("location: index.php");
}
require '../connection/_dbconnect.php';

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navjot</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/all_users.css">
    <!-- <link rel="stylesheet" href="css/all_user-modal.css"> -->
    <link rel="stylesheet" href="css/all_restaurant.css">

    <!-- open sans font-family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>

<body>
    <?php include 'include/_navbar.php'; ?>



    <!-- dashboard main started here -->
    <div class="dashboard-main">
        <header>
            <?php
            include 'include/_mainAside.php';
            ?>


            <!--  ================================================================================ right side of the dashboard ================================================================================= -->

            <div class="main-right-display">
                <?php
                include 'include/_marquee_info.php';
                ?>
                <!-- <div class="marqueetag">
                    write the marquee here
                    <marquee behavior="" direction="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi eos sed aliquid culpa distinctio nostrum sequi a quas. Harum omnis at nobis amet deserunt sapiente totam provident laudantium officiis illum?</marquee>
                </div> -->
                <div class="admin__dashboard">
                    <div class="admin__dashboard-container">

                        <div class="dashboard__header">
                            <h4>All DISHES</h4>
                        </div>


                        <!-- modal for confirm the order for delete the order  -->
                        <div class="deleteModalStartHere">
                            <div class="delete_confirm-modal">
                                <div class="delete_confirm-modal_container">
                                    <div class="delete_modal-row1">
                                        <h2>ORDER DELETE</h2>
                                    </div>
                                    <div class="delete_modal-row2">
                                        <P>Are You Sure??</P>
                                    </div>
                                    <div class="delete_modal-row3">
                                        <a class="btn confirm-btn">CONFIRM</a>
                                        <a class="btn cancel-btn">CANCEL</a>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- first row in admin dashboard -->

                        <div class="all_users-table">
                            <!-- this full table is copied from the previous files so the class may confuse us-->
                            <table>
                                <thead>
                                    <tr>
                                        <td>Restaurant</td>
                                        <td>Dish</td>
                                        <td>Description</td>
                                        <td>Price</td>
                                        <td>Image</td>
                                        <td style="width: 10%;">Action</td>
                                    </tr>
                                </thead>


                                <tbody id="display_users_detail">
                                    <!-- filling it using javascript -->
                                    <?php
                                    $sql = "SELECT * FROM `dishes`";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_num_rows($result);

                                    if ($row > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $dishId = $row['d_id'];
                                            $resId = $row['rs_id'];
                                            $name = $row['title'];
                                            $desc = $row['slogan'];
                                            $price = $row['price'];
                                            $image = $row['img'];
                                            $res_name = '';

                                            $res_sql = "SELECT * FROM `restaurant` WHERE `rs_id` = $resId";
                                            $res_result = mysqli_query($conn, $res_sql);
                                            $res_row = mysqli_num_rows($res_result);
                                            if ($res_row == 1) {
                                                $res_row = mysqli_fetch_assoc($res_result);
                                                $res_name = $res_row['title'];

                                                echo '<tr>
                                                        <td>' . $res_name . '</td>
                                                        <td>' . $name . '</td>
                                                        <td>' . $desc . '</td>
                                                        <td>&#8377;<span>' . $price . '<span></td>
                                                        <td><img class="all_res_img" src="Res_img/dishes/' . $image . '" alt="" srcset=""></td>
                                                        <td class="action_data">
                                                            <a class="all_user-action all_user-action-trash" data-dish_number="' . $dishId . '"><img src="images/icons/trash-solid.png" alt="" srcset=""></a>
                                                            <a href="all_menu-edit.php?form_number=' . $dishId . '" class="all_user-action all_user-action-edit" data-dish_number="' . $dishId . '"><img src="images/icons/file-pen-solid.png" alt="" srcset=""></a>
                                                        </td> 
                                                        </tr>';
                                            }
                                        }
                                    }

                                    ?>


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </header>

    </div>



    <?php
    include 'include/_footer.php';
    ?>



    <script src="javascript/script.js"></script>
    <script src="javascript/all_menu.js"></script>

</body>

</html>