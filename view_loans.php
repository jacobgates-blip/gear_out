<?php
session_start();
$page_title = "Current loans | Gear Out";
require('includes/conn_1dt.php');

// Anyone can see this page — no auth_check here. Only logging or
// returning a loan requires being signed in.
$stmt = $pdo->query("SELECT * FROM loans WHERE returned_date IS NULL ORDER BY due_back ASC");
$loans = $stmt->fetchAll();
$today = date('Y-m-d');

include('includes/header.php');
include('includes/nav.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <h1 class="pt-5 pb-4 text-center">Current loans</h1>

            <?php if (!$loans): ?>
                <p class="text-center">Nothing is currently out.</p>
            <?php else: ?>
                <div class="pb-4">
                    <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search...">
                </div>
                <table class="table table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">Item</th>
                            <th scope="col">Borrower</th>
                            <th scope="col">Due back</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($loans as $loan): ?>
                            <?php $overdue = $loan['due_back'] < $today; ?>
                            <tr class="<?= $overdue ? 'table-danger' : '' ?>">
                                <td><?= htmlspecialchars($loan['item_name']) ?></td>
                                <td><?= htmlspecialchars($loan['borrower_name']) ?></td>
                                <td><?= htmlspecialchars($loan['due_back']) ?></td>
                                <td>
                                    <?php if ($overdue): ?>
                                        <span class="badge text-bg-danger">Overdue</span>
                                    <?php else: ?>
                                        <span class="badge text-bg-success">On time</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        <div class="col-sm-1"></div>
    </div>
</div>

<script>
    function myFunction() {
        var input, filter, table, tr, i, rowText;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        if (!table) return;
        tr = table.getElementsByTagName("tr");
        for (i = 1; i < tr.length; i++) {
            rowText = tr[i].textContent || tr[i].innerText;
            tr[i].style.display = rowText.toUpperCase().indexOf(filter) > -1 ? "" : "none";
        }
    }
</script>

<?php include('includes/footer.php'); ?>
