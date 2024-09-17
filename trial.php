<?php
include './header.php';
include('./controllers/trial.php');
// name , email, id
?>

<div class="main-panel">
	<div class="content">
	    <div class="container-fluid">
            <?php if (isset($_SESSION['message'])): ?>
                <div>
                    <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    ?>
                </div>
            <?php endif; ?>
            <form action="./controllers/trial.php" method="post">
                <label for="name">
                    Name:
                    <input type="text" name="name" id="email">
                </label>
                <label for="email">
                    Email:
                    <input type="email" name="email" id="email">
                </label>
                <button type="submit">Submit</button>
            </form>
            <table>
                <thead>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Edit</th>
                    <th>show</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    <td>id</td>
                    <td>name</td>
                    <td>email</td>
                    <button type="button">Edit</button>
                    <button type="button">Show</button>
                    <button type="button">Delete</button>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include './footer.php';?>