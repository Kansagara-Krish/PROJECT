<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { 
  
    $servername = "localhost";  
    $username = "root"; 
    $password = ""; 
    $database= "beat audio"; 
    $prefix = strtolower(substr($database, 0, 1)); 
    //echo "<script>alert('database is $company')</script>"; 
    
    // Create connection 
    $conn = new mysqli($servername, $username, $password, $database); 
    
    // Check connection 
    if ($conn->connect_error) { 
        die("<script>alert('Database connection failed!'); window.history.back();</script>"); 
    } 
    
    // Function to sanitize inputs and prevent errors 
    function sanitize($conn, $key) { 
        return isset($_POST[$key]) ? mysqli_real_escape_string($conn, trim($_POST[$key])) : ''; 
    } 

    $table_check = $conn->query("SHOW TABLES LIKE 'client_data'"); 
    if ($table_check->num_rows == 0) { 
        die("<script>alert('Error: Table client_data does not exist! Please check your database setup.'); window.history.back();</script>"); 
    } 
    
 
    $client_name = sanitize($conn, 'client_name'); 
    $contact_number = sanitize($conn, 'contact_number'); 
    $alternate_contact = sanitize($conn, 'alternat_contact'); 
    $client_email = sanitize($conn, 'client_email'); 
    $street = sanitize($conn, 'street'); 
    $house_number = sanitize($conn, 'house_number'); 
    $landmark = sanitize($conn, 'landmark'); 
    $village = sanitize($conn, 'village'); 
    $district = sanitize($conn, 'district'); 
    $city = sanitize($conn, 'city'); 
    $state = sanitize($conn, 'state'); 
    $pin_code = sanitize($conn, 'pin_code'); 
    $interior_designer_name = sanitize($conn, 'interior_designer_name'); 
    $interior_contact = sanitize($conn, 'interior_contact'); 
    $interior_alternate_contact = sanitize($conn, 'interior_alternate_contact'); 
    $interior_email = sanitize($conn, 'interior_designer_email'); 
    

    $required_fields = [ 
        "client_name", "contact_number", "client_email", "street", "house_number", "landmark", "village", "district", "city", "state", "pin_code" 
    ]; 
    
    $missing_fields = []; 
    foreach ($required_fields as $field) { 
        if (empty($$field)) { 
            $missing_fields[] = ucfirst(str_replace("_", " ", $field)); 
        } 
    } 
    
    $sql = "SELECT client_id FROM client_data ORDER BY client_id DESC LIMIT 1"; 
    $result = $conn->query($sql); 

    if ($result->num_rows <= 0) { 
        $client_id = $prefix . '101'; 

    } else if($result->num_rows > 0) { 
      
        $row = $result->fetch_assoc(); 
        $last_id = intval(substr($row['client_id'], strlen($prefix))); 
        $client_id = $prefix . ($last_id + 1); 
    } 
    
    echo "<script>console.log('Generated client_id: $client_id');</script>"; 
    
    // **Insert data into the database using a prepared statement** 
    $stmt = $conn->prepare("INSERT INTO client_data (client_id,client_name, contact_number, alternate_contact, client_email,street, house_number, landmark, village, district, city, state, pin_code, interior_designer_name, interior_contact, interior_alternate_contact, interior_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssssssss", $client_id, $client_name, $contact_number, $alternate_contact, $client_email, $street, $house_number, $landmark, $village, $district, $city, $state, $pin_code, $interior_designer_name, $interior_contact, $interior_alternate_contact, $interior_email);
    
    if ($stmt->execute()) { 
        echo "<script>alert('! Rememebr this client client_id is $client_id')</script>"; 
        echo "<script>window.location.href='./Thanks_Admin.html';</script>"; 
    } else { 
        echo "<script>alert('Database Error: " . addslashes($conn->error) . "');</script>"; 
    } 
    
    // Close connection 
    $stmt->close(); 
    $conn->close(); 
} ?>
