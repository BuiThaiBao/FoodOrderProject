<?php
include("partials/menu.php");
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br /> <br />
        <!-- Button to ADD Admin -->
        <a href="#" class="btn-primary">Add Category</a>

        <br /> <br /> <br />
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <tr>
                <td>1.</td>
                <td>Bui Thai Bao</td>
                <td>Baobambi</td>
                <td>
                    <a href="#" class="btn-secondary">Add </a>
                    <a href="#" class="btn-danger">Delete </a>
                </td>
            </tr>

            <tr>
                <td>2.</td>
                <td>Bui Thai Bao</td>
                <td>Baobambi</td>
                <td>
                    <a href="#" class="btn-secondary">Add </a>
                    <a href="#" class="btn-danger">Delete </a>
                </td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Bui Thai Bao</td>
                <td>Baobambi</td>
                <td>
                    <a href="#" class="btn-secondary">Add </a>
                    <a href="#" class="btn-danger">Delete </a>
                </td>
            </tr>

        </table>
    </div>

</div>

<?php
include("partials/footer.php");
?>