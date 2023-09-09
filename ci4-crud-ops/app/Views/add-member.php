<?= $this->extend("app")?>
<?= $this->section("body")?>

<div class="container mt-20">
    <div class="row">
        <div class="panel panel-row">
            <div class="panel-heading">
                Add member
                <a href="<?= base_url('list-members')?>" class="btn btn-info pull-right" style="margin-top: -7px;">List Member</a>
            </div>
            <div class="panel-body">
                <?php if(isset($validation)) :?>
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <?= $validation->listErrors() ?>
                        </div>
                    </div>
                <?php endif; ?>
                <hr>
                <form action="<?= base_url('add-member') ?>" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile no</label>
                        <input type="text" name="mobile" id="mobile" class="form-control">
                    </div>
                    <button class="btn btn-success" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>