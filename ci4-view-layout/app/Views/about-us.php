<?= $this->extend("layout/master")?>
<?= $this->section("content")?>

<h1> Welcome to About us page</h1>
<p> This is a sample page for myself</p>

<?= $this->endSection()?>

<?= $this->section("script")?>
<script src="<?= base_url('public/js/script.js') ?>"></script>
<?= $this->endSection()?>