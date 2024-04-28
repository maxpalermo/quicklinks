<?= $this->extend('theme/index') ?>

<?= $this->section('styles') ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

<!-- polyfill.io only loads a Promise polyfill if your browser needs one -->
<script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=Promise"></script>

<!-- Latest version of Preview SDK for your locale -->
<script src="https://cdn01.boxcdn.net/platform/preview/2.104.0/it-IT/preview.js"></script>
<link rel="stylesheet" href="https://cdn01.boxcdn.net/platform/preview/2.104.0/it-IT/preview.css" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Link pagine</h1>

<div class="table-responsive-xxl">
    <table id="table-links"
        class="table table-dark table-striped table-hover table-bordered table-align-middle table-responsive-md">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Immagine</th>
                <th scope="col"><?= form_checkbox('order_by_group', 'order_by_group', false) ?> Gruppo</th>
                <th scope="col">
                    <?= form_checkbox('order_by_link', 'order_by_link', false) ?> Link
                    <?= form_button(['name' => 'order_by_link', 'value' => 'asc', 'content' => '<i class="fa fa-arrow-up"></i>', 'class' => 'btn btn-sm btn-outline-light p-1',]) ?>
                    <?= form_button(['name' => 'order_by_link', 'value' => 'desc', 'content' => '<i class="fa fa-arrow-down"></i>', 'class' => 'btn btn-sm btn-outline-light p-1']) ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($links as $key => $link): ?>
                <tr class="">
                    <td scope="row"><?= ++$key ?></td>
                    <td scope="row">
                        <div>
                            <section class="section">
                                <div class="container-<?= ++$key ?>">
                                    <div class="box" style="width:300px">
                                        <img class="preview-image" src="">
                                        <div class="is-clipped">
                                            <div class="preview-title" class="has-text-weight-bold"></div>
                                            <div class="preview-desc" class="mt-2"></div>
                                            <div class="preview-url" class="mt-2 is-size-7"></div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </td>
                    <td>--</td>
                    <td><a class="text-white" target="_blank" href="<?= $link['link'] ?>"><?= $link['link'] ?></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
    $(function () {
        $.each("#table-links tbody tr", function () {
            let tr = this;
            let box = $(tr).find('td').eq(1);
            let link = $(tr).find('td').eq(3).find('a').attr('href');
            let data = {
                q: link
            };
            let key = "123456"

            fetch("https://api.linkpreview.net", {
                method: "POST",
                headers: {
                    'X-Linkpreview-Api-Key': key,
                },
                mode: "cors",
                body: JSON.stringify(data)
            })
                .then((res) => res.json())
                .then((response) => {
                    $(box).find('.preview-image').attr('src', response.image);
                    $(box).find('.preview-title').text(response.title);
                    $(box).find('.preview-desc').text(response.description);
                    $(box).find('.preview-url').text(response.url);
                });
        });
    });
</script>
<?= $this->endSection() ?>