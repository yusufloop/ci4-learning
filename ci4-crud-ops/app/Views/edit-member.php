<?= $this->extend("app") ?>

<?= $this->section("body") ?>

<div class="container" style="margin-top:20px;">
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Update Member
                <a href="<?= base_url('list-members') ?>" style="margin-top: -7px;" class="btn btn-info pull-right">List Member</a>
            </div>
            <div class="panel-body">
                <?php if (isset($validation)) : ?>
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <?= $validation->listErrors() ?>
                        </div>
                    </div>
                <?php endif; ?>
                <hr>
                <form class="" action="<?= base_url('edit-member/' . $member['id']) ?>" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?= $member['name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= $member['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile No</label>
                        <input type="text" class="form-control" name="mobile" id="mobile" value="<?= $member['mobile'] ?>">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>