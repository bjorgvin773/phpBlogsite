<?php
if (!isset($_POST['id'])) {
    // Redirect to frontpage
    header('Location: /');
}

// Get jobs file
$blogs_str_in = @file_get_contents('blogs.json'); // Returns false if file does not exist
if (!$blogs_str_in) {
    // Redirect to frontpage
    header('Location: /');
} else {
    $blogs = json_decode($blogs_str_in, true);
}

// Find job with id passed in by form
foreach ($blogs as $i => $blog) {
    if ($blog['id'] === $_POST['id']) {
        // Delete that job
        unset($blogs[$i]);
        break;
    }
}

// Convert jobs to JSON format
$blogs_str_out = json_encode($blogs, true);

// Save the job JSON string to jobs.json
file_put_contents('blogs.json', $blogs_str_out);

// Redirect to frontpage
header('Location: /?deleted');
