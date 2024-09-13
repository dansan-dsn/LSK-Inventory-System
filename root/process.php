<?php
include "config.php";
// include 'mailer.php';
$api_key = "TQx3th8uR2R8I8o8858HUos2f37c81Smw1I0DQ470a7b3rk4E3U33GN5cm7L3AHz";

$errors = array();
foreach ($errors as $error) {
    echo $errors;
}

if (isset($_POST['login_btn'])) {
    trim(extract($_POST));
    if (count($errors) == 0) {
        $encrypt_password = sha1($password);
        $result = $dbh->query("SELECT * FROM users WHERE email = '$email' AND password = '$encrypt_password'");

        if ($result->rowCount() == 1) {
            $rows = $result->fetch(PDO::FETCH_OBJ);

            // Set session variables
            $_SESSION['user_id'] = $rows->user_id;
            $_SESSION['name'] = $rows->name;
            $_SESSION['phone'] = $rows->phone;
            $_SESSION['role'] = $rows->role;
            $_SESSION['terms'] = $rows->terms;

            $_SESSION['loader'] = '<center><div class="spinner-border text-success"></div></center>';
            $_SESSION['status'] = '<div class="card card-body alert alert-success text-center">Account matched, Login Successful</div>';
            echo '<script>alert("Login successful")</script>';

            header("refresh:0; url=" . SITE_URL . "/admin-dash");
            exit();
        } else {
            $_SESSION['status'] = '<div id="note2" class="card card-body alert alert-danger text-center">Invalid account, Try again.</div>';
            echo '
                <script>
                    alert("Wrong credentials");
                    window.location.href = window.location.href;
                </script>
            ';
        }
    }
} elseif (isset($_POST['register_btn'])) {
    trim(extract($_POST));

    $check = $dbh->query("SELECT email FROM users WHERE email = '$email' ")->fetchColumn();
    // checking if email doesn't exist
    if (!$check) {
        $encrypt_password = sha1($password);
        $name = $first_name . " " . $last_name;
        $result = dbCreate("INSERT INTO users VALUES(NULL,'$name', '$email', '$encrypt_password', '$terms', 'Administrator') ");
        if ($result == 1) {
            $_SESSION['status'] = '<div class="alert alert-success text-center">You have Successfully registered</div>';
            $_SESSION['loader'] = '<center><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></center>';
            echo '<script>alert("Registration successful")</script>';
            header("refresh:3; url=" . SITE_URL . '/login');
        } else {
            echo '
                <script>
                    alert("Registetration failed");
                    window.location.href = window.location.href;
                </script>
            ';
        }
    } else {
        $_SESSION['status'] = '<div class="alert alert-danger text-center">Email already exists</div>';
        echo '
            <script>
                alert("Email already exists");
                window.location.href = window.location.href;
            </script>
        ';
    }
} else if (isset($_POST['register_event'])) {
    trim(extract($_POST));

    $filename = trim($_FILES['event_img']['name']);
    $chk = rand(1111111111111, 9999999999999);
    $ext = strrchr($filename, ".");
    $cat_photo = $chk . $ext;
    $target_img = "../uploads/" . $cat_photo;
    $url = SITE_URL . '/uploads/' . $cat_photo;

    $event = dbCreate("INSERT INTO events VALUES(NULL, '$title', '$details', '$url', '$location', '$start_time', '$event_date', '$category')");

    if ($event == 1) {
        move_uploaded_file($_FILES['event_img']['tmp_name'], $target_img);
        echo '
            <script>
                alert("Event created successfully!");
                window.location.href = events;
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Failed to create event!");
                window.location.href = window.location.href;
            </script>
        ';
    }
} else if (isset($_POST['edit_event'])) {
    trim(extract($_POST));

    $new_image_url = '';

    if (!empty($_FILES['event_img']['name'])) {
        $filename = trim($_FILES['event_img']['name']);
        $chk = rand(1111111111111, 9999999999999);
        $ext = strrchr($filename, ".");
        $cat_photo = $chk . $ext;
        $target_img = "../uploads/" . $cat_photo;
        $new_image_url = SITE_URL . '/uploads/' . $cat_photo;

        if (!move_uploaded_file($_FILES['event_img']['tmp_name'], $target_img)) {
            echo '
                <script>
                    alert("Failed to upload new image!");
                    window.location.href = window.location.href;
                </script>
            ';
            return;
        }
    } else {
        $old_image_url = $_POST['old_image'];
        $new_image_url = $old_image_url;
    }

    $event = $dbh->query("UPDATE events SET title='$title', details='$details', event_img='$new_image_url', location='$location', start_time='$start_time', event_date='$event_date', category='$category' WHERE event_id='$event_id'");

    if ($event) {
        echo '
            <script>
                alert("Event edited successfully!");
                window.location.href = "events";
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Failed to edit event!");
                window.location.href = window.location.href;
            </script>
        ';
    }
} else if (isset($_POST['add_news'])) {
    trim(extract($_POST));

    $filename = trim($_FILES['blog_image']['name']);
    $chk = rand(1111111111111, 9999999999999);
    $ext = strrchr($filename, ".");
    $cat_photo = $chk . $ext;
    $target_img = "../uploads/" . $cat_photo;
    $url = SITE_URL . '/uploads/' . $cat_photo;

    $news = dbCreate("INSERT INTO news VALUES(NULL, '$title', '$author', '$news_date', '$details', '$tags', '$url')");

    if ($news == 1) {
        move_uploaded_file($_FILES['blog_image']['tmp_name'], $target_img);
        echo '
            <script>
                alert("News created successfully!");
            </script>
        ';
        header("refresh:0; url=" . HOME_URL . '/news');
    } else {
        echo '
            <script>
                alert("Failed to create news!");
                window.location.href = window.location.href;
            </script>
        ';
    }
} else if (isset($_POST['edit_news'])) {
    trim(extract($_POST));

    $new_image_url = '';

    if (!empty($_FILES['blog_image']['name'])) {
        $filename = trim($_FILES['blog_image']['name']);
        $chk = rand(1111111111111, 9999999999999);
        $ext = strrchr($filename, ".");
        $cat_photo = $chk . $ext;
        $target_img = "../uploads/" . $cat_photo;
        $new_image_url = SITE_URL . '/uploads/' . $cat_photo;

        if (!move_uploaded_file($_FILES['blog_image']['tmp_name'], $target_img)) {
            echo '
                <script>
                    alert("Failed to upload new image!");
                    window.location.href = window.location.href;
                </script>
            ';
            return;
        }
    } else {
        $old_image_url = $_POST['old_image'];
        $new_image_url = $old_image_url;
    }

    $news = $dbh->query("UPDATE news SET title='$title', author='$author', news_date='$news_date', details='$details', tags='$tags', blog_image='$new_image_url' WHERE news_id='$news_id'");

    if ($news) {
        echo '
            <script>
                alert("News edited successfully!");
                window.location.href = "' . HOME_URL . '/news";
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Failed to edit news!");
                window.location.href = window.location.href;
            </script>
        ';
    }
} else if (isset($_POST['add_images_to_gallery'])) {
    trim(extract($_POST));

    $filename = trim($_FILES['img_url']['name']);
    $chk = rand(1111111111111, 9999999999999);
    $ext = strrchr($filename, ".");
    $cat_photo = $chk . $ext;
    $target_img = "../uploads/" . $cat_photo;
    $url = SITE_URL . '/uploads/' . $cat_photo;

    $newsx = dbCreate("INSERT INTO gallery VALUES(NULL, '$title', '$url')");

    if ($newsx == 1) {
        move_uploaded_file($_FILES['img_url']['tmp_name'], $target_img);
        echo '
            <script>
                alert("Image added successfully!");
                window.location.href = window.location.href;
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Failed to add image!");
                window.location.href = window.location.href;
            </script>
        ';
    }
} else if (isset($_POST['edit_images_gallery'])) {
    trim(extract($_POST));

    if (!empty($_FILES['img_url']['name'])) {
        $filename = trim($_FILES['img_url']['name']);
        $chk = rand(1111111111111, 9999999999999);
        $ext = strrchr($filename, ".");
        $cat_photo = $chk . $ext;
        $target_img = "../uploads/" . $cat_photo;
        $url = SITE_URL . '/uploads/' . $cat_photo;

        if (move_uploaded_file($_FILES['img_url']['tmp_name'], $target_img)) {
            $new_image = $url;
        } else {
            echo '
                <script>
                    alert("Failed to upload new image!");
                    window.location.href = window.location.href;
                </script>
            ';
            return;
        }
    } else {
        $new_image = $old_image;
    }

    $image_edit = $dbh->query("UPDATE gallery SET title='$title', img_url='$new_image' WHERE image_id=$image_id");

    if ($image_edit) {
        echo "
            <script>
                alert('Image edited successfully!');
                window.location.href = " . HOME_URL . "/gallery;
            </script>
        ";
    } else {
        echo '
            <script>
                alert("Failed to edit image!");
                window.location.href = window.location.href;
            </script>
        ';
    }
} else if (isset($_POST['add_members'])) {
    trim(extract($_POST));

    $filename = trim($_FILES['member_img']['name']);
    $chk = rand(1111111111111, 9999999999999);
    $ext = strrchr($filename, ".");
    $cat_photo = $chk . $ext;
    $target_img = "../uploads/" . $cat_photo;
    $url = SITE_URL . '/uploads/' . $cat_photo;

    $members = dbCreate("INSERT INTO team_members VALUES(NULL, '$name', '$role', '$social_url', '$url')");

    if ($members == 1) {
        move_uploaded_file($_FILES['member_img']['tmp_name'], $target_img);
        echo '
            <script>
                alert("Member added successfully!");
                window.location.href = members;
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Failed to add member!");
                window.location.href = window.location.href;
            </script>
        ';
    }
} else if (isset($_POST['edit_member'])) {
    trim(extract($_POST));

    $new_image_url = '';

    if (!empty($_FILES['member_img']['name'])) {
        $filename = trim($_FILES['member_img']['name']);
        $chk = rand(1111111111111, 9999999999999);
        $ext = strrchr($filename, ".");
        $cat_photo = $chk . $ext;
        $target_img = "../uploads/" . $cat_photo;
        $new_image_url = SITE_URL . '/uploads/' . $cat_photo;

        if (!move_uploaded_file($_FILES['member_img']['tmp_name'], $target_img)) {
            echo '
                <script>
                    alert("Failed to upload new image!");
                    window.location.href = window.location.href;
                </script>
            ';
            return;
        }
    } else {
        $old_image_url = $_POST['oldimage'];
        $new_image_url = $old_image_url;
    }

    $news = $dbh->query("UPDATE team_members SET name='$name', role='$role', socials='$socials', member_img='$new_image_url' WHERE member_id='$news_id'");

    if ($news) {
        echo '
            <script>
                alert("Member edited successfully!");
                window.location.href = "' . HOME_URL . '/members";
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Failed to edit member!");
                window.location.href = window.location.href;
            </script>
        ';
    }
} else if (isset($_POST['make_volunteer_request'])) {
    trim(extract($_POST));

    $volunteers = dbCreate("INSERT INTO volunteer VALUES(NULL, '$name', '$email', '$number', '$address', '$message')");

    if ($volunteers == 1) {
        echo '
            <script>
                alert("Volunteer added successfully!");
                window.location.href = members;
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Failed to add volunteer!");
                window.location.href = window.location.href;
            </script>
        ';
    }
}
