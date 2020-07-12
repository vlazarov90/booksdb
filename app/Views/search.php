<style>
    .container {
        text-align: center;
    }

    table {
        margin: auto;
    }

    table td {
        padding: 0.5em;
    }
</style>
<div class="container">
    <h1>Book Database</h1>
    <form method="GET">
        <div>
            <label for="search">Search By Author</label>
            <input type="text" name="search" value="<?= $this->keyword ?>" />
        </div>
    </form>
    <?php if ($this->books): ?>
        <table border="1">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Author</th>
                <th>Date</th>
            </tr>
            <?php foreach ($this->books as $book): ?>
                <tr>
                    <td><?= $book['id'] ?></td>
                    <td><?= $book['name'] ?></td>
                    <td><?= $book['author'] ?></td>
                    <td><?= $book['date'] ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    <?php endif ?>
</div>

