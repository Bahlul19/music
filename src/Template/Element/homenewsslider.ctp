
        
        <!--Start Slider-->
        <div id="carousel-nav" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php if($news){ ?>

                <?php foreach ($news as $key => $post): ?>
                    <div class="item">
                        <div class="news-title">
                            <?= h($post->title) ?>
                        </div>
                        <?php echo $this->Html->link(
                        $this->Html->image('/files/images/featuredPostImages/'.$post->media['name'], ['alt' => $post->media['name'], 'height' => '100px']),
                        array(
                            'controller' => 'Posts', 
                            'action' => 'postdetails',
                            $post['slug'],
                        ), array('escape' => false)
                    );
                         ?>
                    </div>
                <?php endforeach; ?>

                   <?php } else{echo "<p class='noPosts' style='text-decoration: none'>No News Updates</p>";} ?>
            </div>

        </div>
