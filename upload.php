<?php
// If a POST request with a file was sent
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {

    // Folder where image will be saved (same directory)
    $targetDir = __DIR__ . '/';
    $fileName = basename($_FILES['image']['name']);
    $targetFile = $targetDir . $fileName;

    // Check file type (allow only jpg, jpeg, png)
    $allowed = ['jpg','jpeg','png'];
    $ext = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        echo "Only JPG, JPEG, PNG allowed.";
        exit;
    }

    // Save uploaded file
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        echo "Upload successful: $fileName";
    } else {
        echo "Upload failed.";
    }

    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Image</title>
</head>
<body>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="image" required>
    <button type="submit">Upload</button>
</form>

</body>
</html>
