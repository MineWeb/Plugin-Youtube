<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Explications</h3>
                </div>
                <div class="card-body">
                    <blockquote>
                        <p>Le lien de la vidéo ci-dessous est le lien de la vidéo mise en avant sur cette <a href="/youtube">page</a>.</p>
                    </blockquote>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="<?= $this->Html->url(array('action' => 'edit_video')) ?>" method="post" style="margin-bottom:60px;display:flex;" data-ajax="true">
                                <div class="col-md-11">
                                    <input name="main_youtube_url" class="form-control" type="text" value="<?= $video['Youtube']['url']; ?>" />
                                </div>
                                <div class="col-md-1">
                                    <input class="btn btn-primary" type="submit" value="<?= $Lang->get('GLOBAL__EDIT') ?>" />
                                </div>
                            </form>
                        </div>
                    </div>
                    <p></p>
                    <blockquote>
                        <p>Si vous voulez des vidéos de taille plus petite, veuillez les ajouter depuis le champs si dessous.</p>
                    </blockquote>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header with-border">
                    <h3 class="card-title"><?= $Lang->get('YOUTUBE__CATEGORIES__ADD') ?></h3>
                </div>
                <div class="card-body">
                    <form action="<?= $this->Html->url(array('action' => 'add_video')) ?>" method="post" style="margin-bottom:60px;display:flex;" data-ajax="true">
                        <div class="col-md-11">
                            <input name="youtube_url" class="form-control" type="text" placeholder="https://www.youtube.com/embed/MmB9b5njVbA" />
                        </div>
                        <div class="col-md-1">
                            <input class="btn btn-success" type="submit" value="<?= $Lang->get('GLOBAL__ADD') ?>" />
                        </div>
                    </form>
                    <table class="table table-bordered dataTable">
                        <thead>
                        <tr>
                            <th><?= $Lang->get('YOUTUBE__URL') ?></th>
                            <th class="right"><?= $Lang->get('GLOBAL__ACTIONS') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($videos as $v) { ?>
                            <tr>
                                <td><?= $v['Youtube']['url'] ?></td>
                                <td class="right">
                                    <button onClick="confirmDel('<?= $this->Html->url(array('action' => 'delete_video/'.$v['Youtube']['id'])) ?>')" class="btn btn-danger"><?= $Lang->get('GLOBAL__DELETE') ?></button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</section>
