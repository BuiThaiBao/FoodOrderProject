<?php
include("partials/menu.php");
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br>
        <br>

        <!-- <?php
                // Kiểm tra id có tồn tại hay không 

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    // Lấy tất cả thông tin theo id
                    $sql = "Select * from tbl_order where id=$id";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    if ($count == 1) {
                        $row = mysqli_fetch_assoc($res);
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $status = $row['status'];
                        $note = $row['note'];
                        $name = $row['name'];
                        $contact = $row['contact'];
                        $email = $row['email'];
                        $address = $row['address'];
                    } else {
                        header('location:' . SITEURL . 'admin/manage/orders.php');
                    }
                } else {
                    header('location:' . SITEURL . 'admin/manage/orders.php');
                }


                ?> -->
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Món ăn: </td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>
                <tr>
                    <td>Đơn giá: </td>
                    <td><b><?php echo $price; ?> VND</b></td>
                </tr>
                <tr>
                    <td>SL: </td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Trạng thái: </td>
                    <td>
                        <select name="status" id="">
                            <option <?php if ($status == "Ordered") {
                                        echo "selected";
                                    } ?> value="Ordered">Ordered</option>
                            <option <?php if ($status == "On Delivery") {
                                        echo "selected";
                                    } ?>value="On Delivery">On Delivery</option>
                            <option <?php if ($status == "Delivered") {
                                        echo "selected";
                                    } ?>value="Delivered">Delivered</option>
                            <option <?php if ($status == "Cancelled") {
                                        echo "selected";
                                    } ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Ghi chú: </td>
                    <td><b> <?php echo $note; ?></b></td>
                </tr>

                <tr>
                    <td>Người nhận: </td>
                    <td>
                        <input type="text" name="name" value="<?php echo $name; ?>">
                    </td>

                <tr>
                <tr>
                    <td>Liên hệ: </td>
                    <td>
                        <input type="text" name="contact" value="<?php echo $contact; ?>">
                    </td>
                <tr>
                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="text" name="email" value="<?php echo $email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Địa chỉ: </td>
                    <td>
                        <textarea name="address" cols="30" rows="5"><?php echo $address; ?></textarea>
                    </td>
                </tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <input type="hidden" name="note" value="<?php echo $note; ?>">
                    <input type="submit" name="submit" value="Update Order" class="btn-primary">
                </td>
                </tr>
            </table>
            <?php
            // Kiểm tra nút submit có được bấm hay không 
            if (isset($_POST['submit'])) {
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $status = $_POST['status'];
                $total = $price * $qty;
                $status = $_POST['status'];
                $note = $_POST['note'];
                $name = $_POST['name'];
                $contact  = $_POST['contact'];
                $email = $_POST['email'];
                $address = $_POST['address'];

                $sql2 = "update tbl_order set
                    qty = '$qty ',
                    total = '$total ',
                    status = '$status',
                    name = '$name',
                    contact = '$contact',
                    email = '$email',
                    address = '$address'
                    where id = $id
                ";
                $res2 = mysqli_query($conn, $sql2);

                //Kiểm tra xem có update thành công không 
                if ($res2 == true) {
                    $_SESSION['update'] = "<div class='success'>Cập nhật thành công đơn hàng </div>";
                    header('location:' . SITEURL . 'admin/manage_order.php');
                } else {
                    $_SESSION['update'] = "<div class='error'>Cập nhật đơn hàng thất bại</div>";
                    header('location:' . SITEURL . 'admin/manage_order.php');
                }
            }
            ?>
        </form>
    </div>
</div>

<?php include("partials/footer.php"); ?>