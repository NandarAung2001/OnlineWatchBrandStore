<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
    exit();
}

$message = [];

// Fetch the current admin profile
$fetch_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
$fetch_profile->execute([$admin_id]);
$fetch_profile = $fetch_profile->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
    // Sanitize and validate inputs
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);

    // Update name
    $update_profile_name = $conn->prepare("UPDATE `admins` SET name = ? WHERE id = ?");
    $update_profile_name->execute([$name, $admin_id]);

    // Password update logic
    $empty_pass = ''; // Default empty hashed password
    $prev_pass = $_POST['prev_pass'] ?? '';
    $old_pass = filter_var(sha1($_POST['old_pass'] ?? ''), FILTER_SANITIZE_STRING);
    $new_pass = filter_var(sha1($_POST['new_pass'] ?? ''), FILTER_SANITIZE_STRING);
    $confirm_pass = filter_var(sha1($_POST['confirm_pass'] ?? ''), FILTER_SANITIZE_STRING);

    // Validate password inputs
    if (empty($old_pass) || empty($new_pass) || empty($confirm_pass)) {
        $message[] = 'All password fields are required!';
    } elseif ($old_pass == $empty_pass) {
        $message[] = 'Please enter old password!';
    } elseif ($old_pass !== $prev_pass) {
        $message[] = 'Old password not matched!';
    } elseif ($new_pass !== $confirm_pass) {
        $message[] = 'Confirm password does not match!';
    } else {
        // Update password
        $update_admin_pass = $conn->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
        $update_admin_pass->execute([$confirm_pass, $admin_id]);
        $message[] = 'Password updated successfully!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Profile</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>Update Profile</h3>
      <?php if (!empty($message)) : ?>
         <?php foreach ($message as $msg) : ?>
            <p class="message"><?= htmlspecialchars($msg); ?></p>
         <?php endforeach; ?>
      <?php endif; ?>
      <input type="hidden" name="prev_pass" value="<?= htmlspecialchars($fetch_profile['password']); ?>">
      <input type="text" name="name" value="<?= htmlspecialchars($fetch_profile['name']); ?>" required placeholder="Enter your username" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="old_pass" placeholder="Enter old password" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" placeholder="Enter new password" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="confirm_pass" placeholder="Confirm new password" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Update Now" class="btn" name="submit">
   </form>

</section>

<script src="../js/admin_script.js"></script>
   
</body>
</html>
