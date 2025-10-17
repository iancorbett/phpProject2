<?php 

$uploadDir = __DIR__ . '/uploads'; //make uploaded files vieable in a folder called uploads
$jsonTxtPath = __DIR__ . '/output.txt'; //write json string to a txt file

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
