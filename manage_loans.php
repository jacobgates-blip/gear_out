<?php
session_start();
require('includes/auth_check.php');
require('includes/conn_1dt.php');

$page_title = "Manage loans | Gear Out";

// Join to monitors so we can show who logged each loan.
$stmt = $pdo->query(
    "SELECT loans.*, monitors.firstname AS logged_by_name
     FROM loans
     LEFT JOIN monitors ON loans.logged_by = monitors.id
     ORDER BY (returned_date IS NULL) DESC, due_back ASC"
);
$loans = $stmt->fetchAll();

// Aggregate summary for the dashboard cards.
$stmt = $pdo->query(
    "SELECT
        COUNT(*)                  AS total_out,
        SUM(due_back < CURDATE()) AS total_overdue,
        MIN(due_back)             AS earliest_due
     FROM loans
     WHERE returned_date IS NULL"
);
$summary = $stmt->fetch();

$today = date('Y-m-d');

include('includes/header.php');
include('includes/nav.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <h1 class="pt-5 pb-4">Manage loans</h1>

            <?php if (isset($_GET['logged'])): ?><div class="alert alert-success">Loan logged.</div><?php endif; ?>
            <?php if (isset($_GET['returned'])): ?><div class="alert alert-success">Marked as returned.</div><?php endif; ?>
            <?php if (isset($_GET['deleted'])): ?><div class="alert alert-success">Entry deleted.</div><?php endif; ?>

            <div class="row text-center pb-4">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="mb-0"><?= (int) $summary['total_out'] ?></h3>
                            <p class="text-muted mb-0">Currently out</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="mb-0<?= $summary['total_overdue'] > 0 ? ' text-danger' : '' ?>">
                                <?= (int) $summary['total_overdue'] ?>
                            </h3>
                            <p class="text-muted mb-0">Overdue</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="mb-0"><?= $summary['earliest_due'] ? htmlspecialchars($summary['earliest_due']) : '—' ?></h3>
                            <p class="text-muted mb-0">Earliest due date outstanding</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pb-4">
                <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search...">
                <select class="form-select mt-2" id="columnSelect" onchange="myFunction()">
                    <option value="0">Item</option>
                    <option value="1">Borrower</option>
                    <option value="2">Due back</option>
                    <option value="3">Status</option>
                </select>
            </div>

            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Borrower</th>
                        <th scope="col">Due back</th>
                        <th scope="col">Status</th>
                        <th scope="col">Logged by</th>
                        <th scope="col">&nbsp;</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($loans as $loan): ?>
                        <?php
                        $overdue = !$loan['returned_date'] && $loan['due_back'] < $today;
                        if ($loan['returned_date']) {
                            $status = 'Returned ' . htmlspecialchars($loan['returned_date']);
                        } elseif ($overdue) {
                            $status = '<span class="badge text-bg-danger">Overdue</span>';
                        } else {
                            $status = '<span class="badge text-bg-success">Out</span>';
                        }
                        ?>
                        <tr class="<?= $overdue ? 'table-danger' : '' ?>">
                            <td><?= htmlspecialchars($loan['item_name']) ?></td>
                            <td><?= htmlspecialchars($loan['borrower_name']) ?></td>
                            <td><?= htmlspecialchars($loan['due_back']) ?></td>
                            <td><?= $status ?></td>
                            <td><?= htmlspecialchars($loan['logged_by_name'] ?? '—') ?></td>
                            <td>
                                <?php if (!$loan['returned_date']): ?>
                                <a href="return_loan.php?id=<?= (int) $loan['id'] ?>">
                                    <button type="button" class="btn btn-primary btn-sm">Mark returned</button>
                                </a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="delete_loan.php?id=<?= (int) $loan['id'] ?>"
                                   onclick="return confirm('Delete this entry? This can\'t be undone.');">
                                    <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-1"></div>
    </div>
</div>

<script>
    function myFunction() {
        var input, filter, table, tr, td, i, selectedColumn, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        selectedColumn = document.getElementById("columnSelect").value;
        for (i = 1; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[selectedColumn];
            if (td) {
                txtValue = td.textContent || td.innerText;
                tr[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
            }
        }
    }
</script>

<?php include('includes/footer.php'); ?>