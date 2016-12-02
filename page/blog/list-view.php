

<div class="row" style="margin-top:70px;">

<div class="col-md-9  col-sm-12">
<h1>Blogs</h1>

<?php if (empty($blogs)): ?>
    <p>No Blogs found.</p>
<?php else: ?>
    <ul class="list">
        <?php foreach ($blogs as $blog): ?>
            <li>    

                <h3><a href="<?php echo Utils::createLink('detail', array('id' => $blog->getId()))
            ?>"><?php echo Utils::escape($blog->getTitle()); ?></a></h3> 
                <h3><a href="<?php echo Utils::createLink('detail', array('id' => $blog->getId()))
               ?>"><?php echo Utils::escape($blog->getDateCreated()); ?></a></h3>                
                
                <p><span class="label">Entry Date:</span> <?php
               echo Utils::escape(Utils::formatDateTime($blog->getDateCreated()));
            ?></p>
                
                <h3><a href="<?php echo Utils::createLink('detail', array('id' => $blog->getId()))
            ?>"><?php echo Utils::escape($blog->getDescription()); ?></a></h3> 
                
                <h3><a href="<?php echo Utils::createLink('detail', array('id' => $blog->getId()))
            ?>"><?php echo Utils::escape($blog->getContent()); ?></a></h3>

                <p><a href="index.php?module=blog&page=add-edit&id=<?php echo $blog->getId() ?>">Edit</a>
                </a><a href="index.php?module=blog&page=delete&id=<?php echo $blog->getId() ?>">Delete</a></p>
        </li>

    <?php endforeach; ?>
    </ul>
<?php endif; ?>
</div>