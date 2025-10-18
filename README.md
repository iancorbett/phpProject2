# PHP  Practice Project #2  
**CSV → JSON Converter (PHP)**

This project demonstrates file-upload handling, CSV parsing, JSON encoding, and file I/O in pure PHP — no frameworks, no dependencies.

---

<img width="527" height="560" alt="Screenshot 2025-10-17 at 11 04 20 PM" src="https://github.com/user-attachments/assets/437563a9-7193-48f6-b274-1171671d82fe" />

##  Overview
The page lets a user:

1. Upload a `.csv` file.  
2. Convert its contents into a structured JSON array.  
3. Save the JSON to a local text file (`output.txt`).  
4. Display the formatted JSON on screen in a scrollable textarea.

Everything runs in-browser with plain PHP.

---

##  Features
-  Secure file upload (`move_uploaded_file`)
-  Automatic folder creation (`mkdir`)
-  CSV parsing with `fgetcsv()`
-  Clean data handling (skips blank/mismatched rows)
-  JSON conversion using `json_encode(..., JSON_PRETTY_PRINT)`
-  File writing with `file_put_contents()`
-  Human-readable display inside `<textarea readonly>`

---

##  How to Run
1. Ensure **PHP 8+** is installed.  
2. From the project directory, start PHP’s built-in server:
   php -S localhost:3000
In your browser, visit
➡️ http://localhost:3000/project2.php

Choose a CSV file (e.g. sample.csv) and click Upload & Convert.

See the formatted JSON output below the form.
