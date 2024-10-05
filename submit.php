<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data using $_POST, with fallback values
    $name = isset($_POST['name']) ? $_POST['name'] : 'Not provided';
    $age = isset($_POST['age']) ? $_POST['age'] : 'Not provided';
    $email = isset($_POST['email']) ? $_POST['email'] : 'Not provided';

    $role_options = [
        '1' => 'Student',
        '2' => 'Full Time Job',
        '3' => 'Full Time Learner',
        '4' => 'Prefer not to say',
        '5' => 'Other'
    ];

    $role = isset($_POST['role']) && $_POST['role'] !== '' ? $role_options[$_POST['role']] : 'Not selected';
    $recommend = isset($_POST['option']) ? $_POST['option'] : 'Not selected';
    
    $feature_options = [
        '1' => 'Challenges',
        '2' => 'Projects',
        '3' => 'Community',
        '4' => 'Open Source'
    ];
    
    $feature = isset($_POST['feature']) && $_POST['feature'] !== '' ? $feature_options[$_POST['feature']] : 'Not selected';
   
    // Handle checkbox selections for improvements
    $improvements = isset($_POST['improvements']) ? implode(", ", $_POST['improvements']) : 'No improvements selected';

    $comments = isset($_POST['comments']) ? $_POST['comments'] : 'No comments';
    
    // Database connection
    $servername = "localhost";
    $username = "root"; // default MySQL username
    $password = ""; // leave it blank if no password is set for root
    $dbname = "registration_data"; // the database you created earlier

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL query to insert data
    $sql = "INSERT INTO registrations (name, age, email, role, recommend, feature, improvements, comments) 
            VALUES ('$name', '$age', '$email', '$role', '$recommend', '$feature', '$improvements', '$comments')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Record submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();

    // Display the form data back to the user
    echo "<h1>Survey Form Results</h1>";
    echo "<p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>";
    echo "<p><strong>Age:</strong> " . htmlspecialchars($age) . "</p>";
    echo "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
    echo "<p><strong>Current Role:</strong> " . htmlspecialchars($role) . "</p>";
    echo "<p><strong>Would recommend freeCodeCamp to a friend:</strong> " . htmlspecialchars($recommend) . "</p>";
    echo "<p><strong>Favorite Feature:</strong> " . htmlspecialchars($feature) . "</p>";
    echo "<p><strong>Improvements:</strong> " . htmlspecialchars($improvements) . "</p>";
    echo "<p><strong>Comments/Suggestions:</strong> " . htmlspecialchars($comments) . "</p>";
} else {
    echo "<p>Form submission error. Please submit the form again.</p>";
}
?>
