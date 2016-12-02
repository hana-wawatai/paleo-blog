<div class="col-md-3 col-sm-12"><h1>Side nav</h1></div>

               <div class="box">
                        <div class="inner">
                            <div class="title"><a href="http://localhost:8888/Paleo-blog/web/index.php?page=list&module=blog">Blog Listing</a></div>
                            <div class="title"><a href="http://localhost:8888/Paleo-blog/web/index.php?module=blog&page=add-edit">Add Blog</a></div>
                            <div class="title"><a href="http://localhost:8888/Paleo-blog/web/index.php?page=list&module=user">Users</a></div>
                             <div class="title"><a href="http://localhost:8888/Paleo-blog/web/index.php?module=user&page=add-edit">Add Users</a></div>
                             <div class="title"><a href="http://localhost:8888/Paleo-blog/web/index.php?module=about&page=detail">About Us</a></div>
                         
                        
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="indent">
                        <?php if ($flashes): ?>
                            <ul id="flashes">
                            <?php foreach ($flashes as $flash): ?>
                                <li><?php echo $flash; ?></li>
                            <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php require $template; ?>
                    </div>
                </div>
          
       
