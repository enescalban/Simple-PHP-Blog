<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <!-- Post preview-->


            <?php

            // Her bir kayıt için post-preview HTML bloğu oluşturma
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_seo_url = $row['post_seo_url'];
            ?>
                <div class="post-preview">
                    <a href="http://localhost/<?php echo $post_seo_url; ?>">
                        <h2 class="post-title"><?php echo $post_title; ?></h2>
                    </a>
                    <p class="post-meta">
                        Posted by
                        <a href="#!"><?php echo $post_author; ?></a>
                        on <?php echo date('F d, Y', strtotime($post_date)); ?>
                    </p>
                </div>
            <?php
            }
            ?>

            <!-- Divider-->
            <hr class="my-4" />
            <!-- Pager-->
            <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>
        </div>
    </div>
</div>