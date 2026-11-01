# Security Baseline

Security is continuous risk reduction, not a one-time checklist. This document defines minimum controls; it does not certify the application as secure.

## Application
- Keep Laravel security patches current.
- Use secure password hashing and framework authentication.
- Enforce authorization through Policies/Gates on every protected action.
- Prevent IDOR by scoping queries to authorized owners/agency memberships.
- Validate all input server-side with Form Requests.
- Use CSRF protection for state-changing browser requests.
- Escape output; sanitize any intentionally rendered rich text with a maintained allowlist sanitizer.
- Use parameterized queries; never concatenate untrusted input into SQL.
- Protect against mass assignment with explicit fillable/guarded strategy and validated DTO/input.
- Rate-limit login, password reset, inquiry, contact, search abuse, and public write endpoints.
- Add account lockout/backoff and safe password reset flows.
- Use secure, HttpOnly, SameSite cookies and HTTPS-only cookies in production.
- Configure trusted proxies/hosts correctly; do not trust arbitrary forwarded headers.
- Keep APP_DEBUG=false in production.
- Set a restrictive Content Security Policy after auditing required scripts/styles.
- Add security headers: HSTS (HTTPS only), X-Content-Type-Options, Referrer-Policy, frame-ancestors/CSP.
- Avoid leaking user existence in authentication/reset flows where practical.
- Record security-relevant admin actions in an audit log without storing secrets.

## File uploads
- Allowlist formats (e.g. JPEG, PNG, WebP; SVG disabled unless sanitized and required).
- Validate actual content/MIME and image dimensions; do not trust client filename or MIME.
- Enforce size/count limits and per-user quotas.
- Generate random storage names.
- Store private files outside the public web root; serve through authorization-controlled routes.
- Re-encode images and strip EXIF metadata where appropriate.
- Scan uploads with malware scanning when operationally available.
- Never execute uploaded files; configure storage and Nginx accordingly.

## Infrastructure
- MariaDB and Redis must not publish public ports.
- Use private Docker network(s); only Nginx/reverse proxy is externally reachable.
- Use separate least-privilege DB users for app and migrations if operationally practical.
- Redis must require authentication or be protected by private network plus ACL/password; do not expose it publicly.
- Use Docker secrets or secret manager for production credentials; never commit `.env`.
- Run containers as non-root where feasible; drop capabilities and use read-only filesystem where compatible.
- Keep base images patched and pin image tags/digests.
- Apply host firewall; allow only required inbound ports.
- TLS must terminate at a trusted reverse proxy and redirect HTTP to HTTPS.
- Back up DB and media separately; encrypt backups and test restores.
- Keep Docker socket unavailable to application containers.
- Limit CPU, memory, process count, and log growth in production.

## Operational response
- Centralize error monitoring and security logs.
- Alert on repeated authentication failures, unusual admin actions, upload abuse, and queue failures.
- Define patch and incident response procedures.
- Rotate secrets after suspected exposure.
- Do not claim "fully secure"; report tested controls and remaining risks.
