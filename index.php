<?php
    $file_str = @file_get_contents('blogs.json');
    if (!$file_str) {
        $blogs = [];
    } else {
        $blogs = json_decode($file_str, true);
    }

    $page_title = 'Blogs';
    include('header.php');
?>

<div class=" col col-md-8 mx-auto">
    <h1 class="mb-5 text-center">The Blogs</h1>


    <?php if (empty($blogs)) : ?>
        <div class="alert alert-warning" role="alert">
            Time to add some blogs.
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['deleted'])) : ?>
        <div class="alert alert-success" role="alert">
            Job deleted successfully.
        </div>
    <?php endif; ?>

    <?php if (!empty($blogs)) : ?>
        <div class="blogs">
            <?php foreach ($blogs as $blog) : ?>
                <div class="item">
                    <h3><?php echo $blog['blog_title']; ?></h3>
                    <p><?php echo $blog['blog_post_text']; ?></p>
                    <div class="extra-info">
                        <span><strong>Category:</strong> <?php echo join(', ', $blog['blog_category']); ?></span>
                        <span><strong>Status:</strong> <?php echo $blog['blog_status']; ?></span>
                    </div>
                    <form action="delete_blog.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $blog['id']; ?>">
                        <button type="submit" class="btn btn-danger"> Delete blog</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>



