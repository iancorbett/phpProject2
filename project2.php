<?php 

$uploadDir = __DIR__ . '/uploads'; //make uploaded files vieable in a folder called uploads
$jsonTxtPath = __DIR__ . '/output.txt'; //write json string to a txt file

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csv_file'])) { //if post request is made and we have a valid csv file

    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true); //if uploaddir hasnt been created, create it and use 0777 to grant alll users permission to read, write, execute

    $tmpName = $_FILES['csv_file']['tmp_name']; //tmpname refers to temporary file path automatically assigned by php
    $fileName = basename($_FILES['csv_file']['name']); //original filename user uploaded
    $targetPath = $uploadDir . '/' . $fileName; //use "." to concatenate upload directory path and file name, final destination of the uploaded file
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project #2 – CSV to JSON</title>
</head>
<body>
<h1>Project #2 – CSV → JSON Converter</h1>

<form method="post" enctype="multipart/form-data">
  <p><label>Select a CSV file to upload:</label></p>
  <input type="file" name="csv_file" accept=".csv" required>
  <button type="submit">Upload & Convert</button>
</form>
    
</body>
</html>
