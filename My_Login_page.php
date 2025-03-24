<?php
$servername = "localhost"; // Change this if needed
$db_username = "root"; // Change if needed
$db_password = ""; // Change if needed

// Create a connection to MySQL (without selecting a database)
$conn = new mysqli($servername, $db_username, $db_password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $company = $_POST['company_name']; // This is the database name

    // **1. Check if the company (database) exists**
    $stmt = $conn->prepare("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?");
    $stmt->bind_param("s", $company);
    $stmt->execute();
    $result = $stmt->get_result();

   if ($result->num_rows == 0) {
        // ❌ **Company (database) does NOT exist → Deny login**
        echo "<script>alert('❌ Invalid company name. Database not found!');window.history.back();</script>";
    }  else if ($result->num_rows > 0) {
        // ✅ **2. If the database exists, connect to it**
        $conn->select_db($company);

        // **3. Check the `admin` table for username/password**
        $adminQuery = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
        $adminQuery->bind_param("ss", $username, $password);
        $adminQuery->execute();
        $adminResult = $adminQuery->get_result();

        // **4. Check the `supervisor` table if not found in admin**
        $supervisorQuery = $conn->prepare("SELECT * FROM supervisor WHERE username = ? AND password = ?");
        $supervisorQuery->bind_param("ss", $username, $password);
        $supervisorQuery->execute();
        $supervisorResult = $supervisorQuery->get_result();

        // **5. Redirect based on user role**
        if ($adminResult->num_rows > 0) {
        echo "<script>
            localStorage.setItem('company', '$company');
           window.location.href = 'home_2.html';</script>";
            exit();
        } elseif ($supervisorResult->num_rows > 0) {
            echo "<script>
            localStorage.setItem('company', '$company');
           window.location.href = 'home.html';</script>";   
            exit();
        } else {
            $error_message = "❌ Invalid username or password!";
        }
    }
}

$conn->close();
?>

<!-- Show error message if login fails -->
<?php if (!empty($error_message)) {
    echo "<script>alert('$error_message');window.history.back();</script>";
} ?>
