
      
        <h3 class="blog-list-title"> News </h3>
        <!--Start Slider-->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <?php foreach ($news as $key => $post): ?>
                    <div class="item">
                        <div class="news-title">
                            <h3><?= h($post->title) ?></h3>
                        </div>
                        <?php echo $this->Html->link(
                        $this->Html->image('/files/images/featuredPostImages/'.$post->media['name'], ['alt' => $post->media['name'], 'width' => '100%']),
                        array(
                            'controller' => 'Posts', 
                            'action' => 'postdetails',
                            $post['id'],
                        ), array('escape' => false)
                    );
                         ?>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
