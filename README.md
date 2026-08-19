# Gear Out, built on your class template

This uses the same structure as the Bison Bar & Restaurant files you uploaded —
Bootstrap 5.3.8, the `header.php` / `nav.php` / `footer.php` include pattern,
`includes/conn_1dt.php` for the connection — with the equipment-loan
functionality from the Gear Out booklet built on top of it.

## How the pages map across

| Bison Bar template | Gear Out equivalent | Notes |
|---|---|---|
| `index.php` | `index.php` | Hero + card links instead of a menu |
| `about_us.php` | `how_it_works.php` | Purpose/users content — real, not placeholder text |
| `menu.php` | `view_loans.php` | Public, read-only, no login needed |
| `login.php` / `logout.php` | Same names, same job | Monitors log in to log or manage loans |
| `control_panel.php` | Same name, same job | Protected dashboard |
| `admin_sign.php` | `borrow.php` + `save_loan.php` | Split into form + handler (see below) |
| `admin_list.php` | `manage_loans.php` | Same search/filter table, protected |
| `admin_update.php` | `return_loan.php` | Narrowed to just "mark returned" |
| `admin_delete.php` | `delete_loan.php` | Same job, fixed (see below) |
| — | `includes/auth_check.php` | New — see below |

## The moving parts that make the connection work

`conn_1dt.php` can only connect to something that's actually running. Three
new files provide that:

| File | Job |
|---|---|
| `Dockerfile` | Builds the PHP/Apache image, and installs `pdo_mysql` — which isn't in the base PHP image by default, and is the most common reason a connection fails with no obvious cause |
| `docker-compose.yml` | Starts two containers: `web` (PHP/Apache, this code) and `db` (MySQL 8), and connects them |
| `.devcontainer/devcontainer.json` | Tells GitHub Codespaces to use that compose file, and forwards port 8080 as **public** so you don't hit the "port not available" issue |

The three values in `conn_1dt.php` — `$host = 'db'`, `$dbname = 'gearout'`,
`$user = 'root'` / `$pass = 'example'` — line up exactly with the service
name and environment variables in `docker-compose.yml`. If you already have
an established devcontainer setup you use across your DT classes, you can
drop these three files in favour of it — the only thing that actually
matters is that whatever you use exposes a MySQL service reachable at
those same values (or you update `conn_1dt.php` to match).

**The database sets itself up.** `schema.sql` is mounted into MySQL's
`docker-entrypoint-initdb.d` folder, which the official MySQL image runs
automatically the first time its data volume is created — so the
`loans`/`monitors` tables and demo data exist as soon as the container
starts, with nothing to run by hand. That only happens once, though: if you
change `schema.sql` later, you'll need to remove the `gearout_db_data`
volume (`docker compose down -v`) for it to re-run.

## Setup

**In Codespaces:** open the repo — the devcontainer builds both containers
automatically. Wait for the "Gear Out is ready" message in the terminal,
then open the forwarded port 8080.

**Locally:** `docker compose up -d` from the project root, then visit
`http://localhost:8080`.

Demo login either way: **monitor@school.nz / password123**

## Try it in this order

`index.php` → `how_it_works.php` → `view_loans.php` (all public) → try
`borrow.php` while logged out (redirects to `login.php`) → log in → `borrow.php`
→ `manage_loans.php` → mark something returned → delete a test entry.
