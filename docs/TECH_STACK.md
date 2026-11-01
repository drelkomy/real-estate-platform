# Technology Stack & Version Baseline

Checked against upstream release/documentation information on 2026-11-01. This is a project baseline, not a claim that every package has a specific patch version.

| Component | Baseline | Policy |
|---|---|---|
| PHP | 8.5.12 | Exact requested patch; security updates must be reviewed promptly |
| Laravel | 13.x | Current major compatible with PHP 8.5 |
| Livewire | 4.x | Pin resolved version in composer.lock |
| Tailwind CSS | 4.x | Pin resolved version in package-lock |
| Vite | Laravel-supported version | Do not guess; use Laravel starter/build integration |
| Node.js | 26.13.0 LTS line | Pin exact patch in CI/build image |
| MariaDB | 11.8.9 LTS line | Pin patch tag; community maintenance through 2028-06-04 |
| Redis | 8.2.11 Extended Support line | Pin patch tag; extended support through 2030-09-01 |
| Docker Compose | 5.6.1 | Host tooling; verify installed version |
| Nginx | stable supported release | Pin exact image tag/digest after validation |
| Pest | 4.x | Resolve compatible release and lock |
| Laravel Pint | 1.x | Resolve compatible release and lock |
| Larastan/PHPStan | Compatible current major | Verify Laravel 13 compatibility before adding |
| Composer | Composer 2.x | Pin builder image/digest for production builds |

## Compatibility policy
- Laravel 13 officially supports PHP 8.3–8.5.
- Livewire 4 documentation supports Laravel 10+ and PHP 8.1+, but project-level compatibility must still be tested.
- Tailwind 4 uses its Vite integration; follow official Tailwind installation docs.
- Exact package versions must come from Composer/npm resolution and lockfiles, not invented values in this document.
- `composer.lock` and `package-lock.json` are mandatory committed files for reproducible builds.

## Official references
- PHP 8.5.12: https://www.php.net/releases/8_5_12.php
- Laravel releases: https://laravel.com/docs/13.x/releases
- Livewire 4: https://livewire.laravel.com/docs/4.x
- Tailwind + Vite: https://tailwindcss.com/docs/installation/using-vite
- MariaDB lifecycle: https://mariadb.org/about/
- Redis supported versions: https://redis.io/docs/latest/operate/oss_and_stack/install/version-mgmt/
- Node.js releases: https://nodejs.org/en/about/previous-releases
- Docker Compose releases: https://github.com/docker/compose/releases

## Upgrade procedure
1. Create a dedicated upgrade task/branch.
2. Identify CVEs, release notes, and breaking changes.
3. Verify all direct and transitive dependencies.
4. Update lockfiles intentionally.
5. Run tests, static analysis, build, and smoke tests.
6. Test database backup/restore and migration rollback where relevant.
7. Document deployment and rollback.
8. Obtain approval before production deployment.
