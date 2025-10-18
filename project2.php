<?php 

$uploadDir = __DIR__ . '/uploads'; //make uploaded files vieable in a folder called uploads
$jsonTxtPath = __DIR__ . '/output.txt'; //write json string to a txt file
$jsonPretty = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csv_file'])) { //if post request is made and we have a valid csv file

    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true); //if uploaddir hasnt been created, create it and use 0777 to grant alll users permission to read, write, execute

    $tmpName = $_FILES['csv_file']['tmp_name']; //tmpname refers to temporary file path automatically assigned by php
    $fileName = basename($_FILES['csv_file']['name']); //original filename user uploaded
    $targetPath = $uploadDir . '/' . $fileName; //use "." to concatenate upload directory path and file name, final destination of the uploaded file

    if (move_uploaded_file($tmpName, $targetPath)) { //move file from temporary location to uploads folder

        
        if (($fh = fopen($targetPath, 'r')) !== false) { //open file at new location in read only mode
          $header = fgetcsv($fh, 0, ',', '"', '\\'); // read the first line from the CSV and store it as an array of column names
          $header = array_map('trim', $header); //remove any excess whitespace
          $dataRows = []; //initialize an empty array that will hold all of the csv rows
        }

        while (($row = fgetcsv($fh, 0, ',', '"', '\\')) !== false) { //reads next line as long as theres more to be read
            if ($row === [null] || count(array_filter($row, 'strlen')) === 0) continue; //skip if row has no data
            if (count($row) !== count($header)) continue; // ensures we have every field filled out one ttime
    
            $dataRows[] = array_combine($header, $row); //merge two arrays into on associative array
          }
          fclose($fh); //close file

          $jsonPretty = json_encode($dataRows, JSON_PRETTY_PRINT); //use built in JSON_PRETTY_PRINT to make eat more easily human readable

          file_put_contents($jsonTxtPath, $jsonPretty); //write the newly styled json string at the proper file path

          $message = "CSV uploaded and converted successfully! (Saved to output.txt)";
    
        }   else {
            $message = "Failed to open or upload the uploaded CSV file.";
          } 
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

<?php if ($message): ?> <!--check to see if theres a message-->
  <p class="msg"><?= htmlspecialchars($message) ?></p> <!--if there is, then display it-->
<?php endif; ?>

<?php if ($jsonPretty): ?> <!--check to see if $jsonPretty exists and isnt empty-->
  <h2>📄 JSON Output (Pretty-Printed)</h2>
  <textarea readonly><?= htmlspecialchars($jsonPretty) ?></textarea> <!--display in a text area as read only-->
<?php endif; ?>
    
</body>
</html>
