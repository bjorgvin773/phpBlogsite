<?php 
include('functions.php');

$blog_id = $blog_title = $blog_post_text = $blog_status = '';
$blog_category = array();

$title_error = $text_error =  $category_error = '';

$error_count = 0;

$success = false;


if (isset($_POST['submit'])) {
    
    $blog_title = $_POST['blog_title'];
    $blog_post_text = $_POST['blog_post_text'];
    $blog_status = $_POST['blog_status'];
    if (isset($_POST['blog_category'])) {
        $blog_category = $_POST['blog_category'];
    } else {
        $blog_category = array();
    }

    // Do some validation
    $title_max_length = 50;
    if (empty($_POST['blog_title'])) {
        $title_error = 'The blog title cannot be empty';
        // $error_count = $error_count + 1;
        $error_count++;
    } else if (strlen($_POST['blog_title']) < 7) {
        $title_error = 'The title is too short';
        $error_count++;
    } else if (strlen($_POST['blog_title']) > $title_max_length) {
        $characters_over_limit = strlen($_POST['blog_title']) - $title_max_length;
        $title_error = "The title is $characters_over_limit characters too long.";
        $error_count++;
    }

    if (empty($_POST['blog_post_text'])) {
        $description_error = 'The blog post cannot be empty';
        $error_count++;
    }

    
    if (!isset($_POST['blog_category'])) {
        $perks_error = 'Pick at least one category';
        $error_count++;
    }

    // If there are no errors reset field values
    if ($error_count === 0) {
        $blog_id = $blog_title = $blog_post_text = $blog_status = '';
        $blog_category = array();

        // Get blogs file
        $blogs_str_in = @file_get_contents('blogs.json'); // Returns false if file does not exist
        if (!$blogs_str_in) {
            $blogs = [];
        } else {
            $blogs = json_decode($blogs_str_in, true);
        }

        // Add new job to blogs array
        array_push($blogs, $_POST);

        // Convert job to JSON format
        $blogs_str_out = json_encode($blogs, true);

        // Save the job JSON string to blogs.json
        file_put_contents('blogs.json', $blogs_str_out);

        // Indicate that the job got added successfully
        $success = true;
    }
}
$page_title = 'Add a blog';
$page_id = 'add_blog';
include('header.php');
?>

<div class=" col col-md-8 mx-auto">
    <h1 class="mb-5 text-center">Add a blog</h1>

    <?php if ($success) : ?>
        <div class="alert alert-success mt-2">Woohoo, the blog got added.</div>
    <?php endif; ?>

    <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo uniqid(); ?>">

        <div class="form-group mb-4">
            <label>Title</label>
            <input type="text" name="blog_title" class="form-control" value="<?php echo $blog_title; ?>">
            <?php if (!empty($title_error)) : ?>
                <div class="alert alert-danger mt-2"><?php echo $title_error; ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group mb-4">
            <label>Blog text</label>
            <textarea name="blog_post_text" class="form-control"><?php echo $blog_post_text; ?></textarea>
            <?php if (!empty($description_error)) : ?>
                <div class="alert alert-danger mt-2"><?php echo $description_error; ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group mb-4">
            <label>Working status</label>
            <select name="blog_status" class="form-control" value="<?php echo $blog_status; ?>">
                <option value="Published">Published</option>
                <option value="Draft">Draft</option>
            </select>
        </div>

        <div class="form-group mb-4">
            <label>Category</label>
            <div class="form-check">
                <input type="checkbox" name="blog_category[]" value="Blog post" class="form-check-input" <?php get_checked('Blog post'); ?>> Blog post <br>
                <input type="checkbox" name="blog_category[]" value="Short story" class="form-check-input" <?php get_checked('Short story'); ?>> Short story <br>
                <input type="checkbox" name="blog_category[]" value="Recipe" class="form-check-input" <?php get_checked('Recipe'); ?>> Recipe <br>
            </div>
            <?php if (!empty($category_error)) : ?>
                <div class="alert alert-danger mt-2"><?php echo $category_error; ?></div>
            <?php endif; ?>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Add blog</button>
       

    </form>
</div>
</div>