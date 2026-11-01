# Docker Operations

## Services
- `app`: PHP-FPM Laravel runtime.
- `nginx`: HTTP reverse proxy to PHP-FPM.
- `queue`: dedicated Laravel queue worker using same application image.
- `scheduler`: Laravel scheduler using same application image.
- `mariadb`: database, private network only.
- `redis`: cache/session/queue backend, private network only.

## Important
- Do not publish MariaDB or Redis ports to the host in production.
- `docker-compose.yml` is a starting point. Validate it with `docker compose config`.
- Add resource limits appropriate to the actual VPS.
- Configure backup jobs outside the application container.
- For Coolify, adapt the Compose file to its network/proxy model; avoid creating duplicate shared DB/Redis if the host already provides them.
- The Dockerfile expects a Laravel project in the repository root.
- This starter assumes Nginx document root is `/var/www/html/public`.

## Commands
```bash
docker compose config
docker compose build
docker compose up -d
docker compose ps
docker compose logs -f app nginx
docker compose exec app php artisan about
docker compose exec app php artisan migrate --pretend
```

Never run migrations against production without backup, reviewed migration plan, and explicit approval.

## Development vs production
The included Compose file is a **local development starter** and bind-mounts the repository into PHP containers. For production, build an immutable image containing the application source and installed Composer dependencies; remove bind mounts and do not run Composer as part of container startup. The Dockerfile is a PHP runtime base and intentionally does not copy source because this framework bundle is not itself a Laravel application.

The backend Docker network is not published to the host, but permits outbound connections for approved integrations (mail, maps, payment providers). Host inbound access to MariaDB/Redis remains unavailable because no ports are published. If the deployment requires strict egress controls, enforce them at the host/network layer and explicitly allow required destinations.
