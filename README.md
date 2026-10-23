# Golden Tradition

Local Docker copy of the [Kennel Golden Tradition](http://joy.mk.ua) WordPress site.

| | |
| --- | --- |
| Site | http://localhost:8080/ |
| Admin | http://localhost:8080/wp-admin/ |
| WordPress | 7.1.3 (PHP 8.3) |
| Database | MariaDB 10.11 |
| Active theme | Ashe |

## Layout

Docker serves `site/`. That directory is WordPress 7.1.3 with the copied `wp-content` (themes, plugins, and uploads).

The original `joy.mk.ua` files are kept in the repository root for comparison. They are not mounted into the container.

Active plugins in `site/wp-content/plugins`:

- Akismet
- Backup Guard
- Contact Form 7
- Regenerate Thumbnails
- Responsive Lightbox
- Yoast SEO
- WP-PageNavi

Responsive Lightbox was updated from 1.6.7 to 2.7.11.1. The old version opened a black screen over the mobile menu. Check pages and forms before updating the other plugins.

## Requirements

[Docker](https://docs.docker.com/get-docker/) with Compose.

## Run

```sh
cp .env.example .env
```

Set `DB_ROOT_PASSWORD` and `DB_PASSWORD` in `.env`, then start the stack:

```sh
docker compose up -d
docker compose ps
```

Stop the containers and keep the database:

```sh
docker compose down
```

`docker compose down -v` deletes the MariaDB volume `goldentradition_db_data` and the imported site data with it.

WordPress is bound to `127.0.0.1:8080`. `WP_HOME` and `WP_SITEURL` are set to `http://localhost:8080` in `compose.yaml`, so the site stays on that address even when the database still stores the old `joy.mk.ua` URLs. In the imported local database those URLs were rewritten to `http://localhost:8080`, except the `guid` column.

WP-CLI is available through the `tools` profile:

```sh
docker compose --profile tools run --rm cli wp plugin list
```

## Database

SQL dumps are not in this repository. A local copy may live at `database/234.sql`. On a machine where that file exists and the Docker volume is still empty, import it after the database is healthy:

```sh
docker compose cp database/234.sql db:/tmp/234.sql
docker compose exec db sh -c 'mariadb -uwordpress -p"$MARIADB_PASSWORD" wordpress < /tmp/234.sql'
```

Without a dump, opening http://localhost:8080/ starts the WordPress installer against an empty `wordpress` database.

## Not published

This repository is public. These files stay on disk and are listed in `.gitignore`:

- `.env` — database passwords
- `wp-config.php` in the repository root — credentials from the original host. The file Docker uses is `site/wp-config.php`, which reads the database settings from the environment.
- `database/*.sql` — accounts and password hashes
- Backup Guard archives under `uploads/backup-guard/` and `uploads/backup-guard.rar` — full site backups, and some files are over GitHub's 100 MB limit
