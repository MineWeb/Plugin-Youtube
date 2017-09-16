<style type="text/css">
    .yt-embed-primary{
        max-height: 460px;
        max-width: 840px;
    }
    div .embed-responsive-16by9{
        max-width: 840px;
        padding-bottom: 44% !important;
    }
    .col-o{
        margin-bottom: 20px;
    }
</style>
<div class="container" style="margin-top:30px;margin-bottom:30px">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="center-block">
                    <div class="embed-responsive center-block embed-responsive-16by9">
                        <iframe class="embed-responsive-item yt-embed-primary" src="<?= $video['Youtube']['url']; ?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <?php foreach ($videos as $v): ?>
                    <div class="col-md-4 col-o">
                        <div class="row">
                            <iframe class="embed-responsive-item center-block" src="<?= $v['Youtube']['url']; ?>" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>