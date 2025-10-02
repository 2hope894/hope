<?php
session_start();

// only logged in users allowed
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: auth.php");
    exit();
}

// Database connection - adjust path if your project uses different file
// db.php should set $conn = new mysqli(...); or similar.
require_once 'db.php';

// Determine user identifier
if (!empty($_SESSION['user_id'])) {
    $user_id = intval($_SESSION['user_id']);
} elseif (!empty($_SESSION['email'])) {
    // fallback: try to resolve user_id from email
    $email_fallback = $_SESSION['email'];
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param('s', $email_fallback);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    if ($row) $user_id = intval($row['id']);
    $stmt->close();
}

if (empty($user_id)) {
    echo "<p style='padding:20px;font-family:Arial;'>Unable to determine your user record. Please log out and log in again.</p>";
    exit();
}

// helper: safe output
function e($v){ return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); }

// Allowed upload settings
$avatar_dir = __DIR__ . '/uploads/avatars/';
$cv_dir     = __DIR__ . '/uploads/cvs/';
@mkdir($avatar_dir, 0755, true);
@mkdir($cv_dir, 0755, true);
$max_avatar_size = 2 * 1024 * 1024; // 2MB
$max_cv_size     = 5 * 1024 * 1024; // 5MB
$allowed_avatar_types = ['image/jpeg','image/png','image/webp'];
$allowed_cv_types     = ['application/pdf','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

$errors = [];
$success = '';

// Fetch existing user data
$stmt = $conn->prepare("SELECT name,phone,email,dob,nationality,address,education_level,experience_level,avatar,cv FROM users WHERE id = ? LIMIT 1");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
if (!$user) {
    echo "<p style='padding:20px;font-family:Arial;'>User record not found.</p>";
    exit();
}

// Handle POST - update profile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize inputs
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $dob = trim($_POST['dob'] ?? '');
    $nationality = trim($_POST['nationality'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $education = $_POST['education_level'] ?? '';
    $experience = $_POST['experience_level'] ?? '';

    // Basic validations
    if ($name === '') $errors[] = 'Name is required.';
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid email is required.';

    // Handle avatar upload (optional)
    $avatar_path = $user['avatar']; // default to existing
    if (!empty($_FILES['avatar']) && $_FILES['avatar']['error'] !== UPLOAD_ERR_NO_FILE) {
        $a = $_FILES['avatar'];
        if ($a['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'Error uploading avatar.';
        } elseif ($a['size'] > $max_avatar_size) {
            $errors[] = 'Avatar file is too large (max 2MB).';
        } elseif (!in_array(mime_content_type($a['tmp_name']), $allowed_avatar_types)) {
            $errors[] = 'Avatar must be a JPG, PNG or WEBP image.';
        } else {
            // generate safe filename
            $ext = pathinfo($a['name'], PATHINFO_EXTENSION);
            $safe = 'avatar_' . $user_id . '_' . time() . '.' . $ext;
            $target = $avatar_dir . $safe;
            if (!move_uploaded_file($a['tmp_name'], $target)) {
                $errors[] = 'Failed to move uploaded avatar.';
            } else {
                // store relative path
                $avatar_path = 'uploads/avatars/' . $safe;
                // optionally remove previous avatar file (if present and exists)
                if (!empty($user['avatar']) && file_exists(__DIR__ . '/' . $user['avatar'])) {
                    @unlink(__DIR__ . '/' . $user['avatar']);
                }
            }
        }
    }

    // Handle CV upload (optional)
    $cv_path = $user['cv'];
    if (!empty($_FILES['cv']) && $_FILES['cv']['error'] !== UPLOAD_ERR_NO_FILE) {
        $c = $_FILES['cv'];
        if ($c['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'Error uploading CV.';
        } elseif ($c['size'] > $max_cv_size) {
            $errors[] = 'CV file is too large (max 5MB).';
        } elseif (!in_array(mime_content_type($c['tmp_name']), $allowed_cv_types)) {
            $errors[] = 'CV must be a PDF or Word document.';
        } else {
            $ext = pathinfo($c['name'], PATHINFO_EXTENSION);
            $safe = 'cv_' . $user_id . '_' . time() . '.' . $ext;
            $target = $cv_dir . $safe;
            if (!move_uploaded_file($c['tmp_name'], $target)) {
                $errors[] = 'Failed to move uploaded CV.';
            } else {
                $cv_path = 'uploads/cvs/' . $safe;
                if (!empty($user['cv']) && file_exists(__DIR__ . '/' . $user['cv'])) {
                    @unlink(__DIR__ . '/' . $user['cv']);
                }
            }
        }
    }

    // If no errors, update DB
    if (empty($errors)) {
        $stmt = $conn->prepare("UPDATE users SET name=?, phone=?, email=?, dob=?, nationality=?, address=?, education_level=?, experience_level=?, avatar=?, cv=? WHERE id=?");
        $stmt->bind_param('sssssssssi', $name, $phone, $email, $dob, $nationality, $address, $education, $experience, $avatar_path, $cv_path, $user_id);
        if ($stmt->execute()) {
            $success = 'Profile updated successfully.';
            // refresh $user values
            $user['name']=$name; $user['phone']=$phone; $user['email']=$email; $user['dob']=$dob; $user['nationality']=$nationality; $user['address']=$address; $user['education_level']=$education; $user['experience_level']=$experience; $user['avatar']=$avatar_path; $user['cv']=$cv_path;
            // update session name/email if needed
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
        } else {
            $errors[] = 'Database update failed.';
        }
        $stmt->close();
    }
}

// Options for select fields
$education_opts = [
  'High School','Technical School','College','Bachelor','Masters','Doctorate'
];
$experience_opts = [
  'No experience','Less than 2 years','2 to 5 years','5 to 10 years','More than 10 years'
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>My Account - Profile</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body{font-family:Inter,system-ui,Arial,Helvetica,sans-serif;background:#0f1115;color:#e9ecef;margin:0;padding:0}
    .wrap{max-width:900px;margin:80px auto;padding:20px}
    .card{background:linear-gradient(180deg,rgba(255,255,255,0.02),rgba(0,0,0,0.06));padding:20px;border-radius:12px;border:1px solid rgba(255,255,255,0.03)}
    h1{margin:0 0 8px}
    .muted{color:#9ea3a8;font-size:14px;margin-bottom:12px}
    form .grid{display:grid;grid-template-columns:1fr 220px;gap:16px}
    .left{display:grid;gap:12px}
    label{font-size:13px;color:#cfd4d8}
    input[type=text],input[type=email],input[type=date],select,textarea{width:100%;padding:10px;border-radius:8px;border:1px solid rgba(255,255,255,0.04);background:transparent;color:inherit}
    textarea{min-height:80px}
    .right{display:flex;flex-direction:column;align-items:center;gap:12px}
    .avatar-preview{width:160px;height:160px;border-radius:12px;background:rgba(255,255,255,0.03);display:grid;place-items:center;font-weight:700}
    .small{font-size:13px;color:#9ea3a8}
    .btn{padding:10px 14px;border-radius:10px;border:0;cursor:pointer;font-weight:700}
    .btn.primary{background:linear-gradient(90deg,#3a7bfd,#2ed0a8);color:#071017}
    .btn.ghost{background:transparent;border:1px solid rgba(255,255,255,0.04);color:inherit}
    .row{display:flex;gap:8px}
    .messages{margin-bottom:12px}
    .error{background:#3a1b1b;color:#ffd2d2;padding:10px;border-radius:8px}
    .success{background:#153a22;color:#bff0c9;padding:10px;border-radius:8px}
    @media(max-width:820px){.form .grid{grid-template-columns:1fr}}
  </style>
</head>
<body>

<?php include 'header.php'; ?>

<main class="wrap">
  <div class="card">
    <h1>Personal Details</h1>
    <div class="muted">Update your details below. All fields are editable and uploads are saved to your account.</div>

    <?php if (!empty($errors)): ?>
      <div class="messages">
        <?php foreach($errors as $err): ?>
          <div class="error"><?php echo e($err); ?></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    <?php if ($success): ?>
      <div class="messages"><div class="success"><?php echo e($success); ?></div></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" class="form">
      <div class="grid">
        <div class="left">

          <div>
            <label for="name">Full name</label>
            <input id="name" name="name" type="text" value="<?php echo e($user['name']); ?>" required>
          </div>

          <div style="display:flex;gap:8px">
            <div style="flex:1">
              <label for="phone">Phone</label>
              <input id="phone" name="phone" type="text" value="<?php echo e($user['phone']); ?>">
            </div>
            <div style="width:220px">
              <label for="dob">Date of birth</label>
              <input id="dob" name="dob" type="date" value="<?php echo e($user['dob']); ?>">
            </div>
          </div>

          <div>
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="<?php echo e($user['email']); ?>" required>
          </div>

          <div>
            <label for="nationality">Nationality</label>
            <input id="nationality" name="nationality" type="text" value="<?php echo e($user['nationality']); ?>">
          </div>

          <div>
            <label for="address">Address</label>
            <textarea id="address" name="address"><?php echo e($user['address']); ?></textarea>
          </div>

          <div style="display:flex;gap:8px">
            <div style="flex:1">
              <label for="education_level">Education level</label>
              <select id="education_level" name="education_level">
                <?php foreach($education_opts as $opt): ?>
                  <option value="<?php echo e($opt); ?>" <?php if($user['education_level']==$opt) echo 'selected'; ?>><?php echo e($opt); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div style="width:220px">
              <label for="experience_level">Experience</label>
              <select id="experience_level" name="experience_level">
                <?php foreach($experience_opts as $opt): ?>
                  <option value="<?php echo e($opt); ?>" <?php if($user['experience_level']==$opt) echo 'selected'; ?>><?php echo e($opt); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div style="display:flex;gap:8px;align-items:center;margin-top:6px">
            <button type="submit" class="btn primary">Save changes</button>
            <a href="dashboard.php" class="btn ghost" style="text-decoration:none;display:inline-flex;align-items:center;">Cancel</a>
          </div>

        </div>

        <aside class="right">
          <div style="width:100%">
            <label class="small">Profile picture</label>
            <div class="avatar-preview">
              <?php if (!empty($user['avatar']) && file_exists(__DIR__ . '/' . $user['avatar'])): ?>
                <img src="<?php echo e($user['avatar']); ?>" alt="avatar" style="width:100%;height:100%;object-fit:cover;border-radius:12px;display:block">
              <?php else: ?>
                <div style="text-align:center;color:#cfd4d8;padding:8px">No photo</div>
              <?php endif; ?>
            </div>
            <div style="margin-top:8px">
              <input type="file" name="avatar" accept="image/*">
              <div class="small">Max 2MB. JPG/PNG/WEBP.</div>
            </div>
          </div>

          <div style="width:100%;margin-top:18px">
            <label class="small">Curriculum Vitae (CV)</label>
            <?php if (!empty($user['cv']) && file_exists(__DIR__ . '/' . $user['cv'])): ?>
              <div style="margin:8px 0"><a class="btn ghost" href="<?php echo e($user['cv']); ?>" target="_blank">Download current CV</a></div>
            <?php endif; ?>
            <input type="file" name="cv" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
            <div class="small">Max 5MB. PDF or Word.</div>
          </div>

        </aside>

      </div>
    </form>

  </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
