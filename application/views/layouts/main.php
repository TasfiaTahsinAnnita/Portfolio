<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Tasfia Tahsin Annita's Portfolio</title>
    <script>
        window.BASE_URL = '<?= base_url() ?>';
    </script>
</head>
<body>
    <?php $this->load->view($page, isset($zones) ? ['zones' => $zones] : []); ?>
</body>
</html>