<?php
session_start();
$page_title = "How it works | Gear Out";
include('includes/header.php');
include('includes/nav.php');
?>
<!-- Start of content 1 -->
<div class="container pt-5">
    <div class="row">
        <h1 class="text-center">How Gear Out works</h1>
        <hr />
        <h3 class="pt-5">The problem</h3>
        <p>
            The PE department currently tracks lunchtime sports gear on a paper sign-out sheet taped to the
            equipment shed window. It's hard to read, sheets go missing at the end of term, and nobody can
            tell at a glance what's still out or who's had it longest.
        </p>
        <h3 class="pt-4">Who it's for</h3>
        <p>
            Student sports monitors issue and return gear at the shed window each lunchtime. PE staff need to
            check what's outstanding without walking to the shed.
        </p>
        <h3 class="pt-4">What it does</h3>
        <ul>
            <li>Lets a signed-in monitor log a loan — item, borrower, and due-back date</li>
            <li>Shows anyone, monitor or staff, a live public list of what's currently out</li>
            <li>Flags anything overdue</li>
            <li>Lets a monitor mark gear as returned, or correct a mistaken entry</li>
        </ul>
    </div>
</div>

<?php
include('includes/footer.php');
?>
