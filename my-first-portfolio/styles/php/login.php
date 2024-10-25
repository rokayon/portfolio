<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'portfolio_test');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    } else {
        // Prepare SQL statement to retrieve the password for the given email
        $stmt = $conn->prepare("SELECT password FROM registration WHERE email = ?");
        $stmt->bind_param("s", $email);
        
        // Execute the query
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Bind result to fetch the stored password
            $stmt->bind_result($storedPassword);
            $stmt->fetch();

            // Verify the password
            if ($password == $storedPassword) {  // Use password_verify($password, $storedPassword) if using hashed passwords
                echo "Login successful!";
            } else {
                echo "Invalid email or password.";
            }
        } else {
            echo "Invalid email or password.";
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>
