# Performance Baseline

- Use eager loading and inspect query counts for listing/detail pages.
- Paginate search results; use deterministic ordering and indexed filters.
- Add indexes only from measured query patterns and EXPLAIN output.
- Cache public, non-sensitive reference data with explicit invalidation.
- Never share private cached responses across users/tenants.
- Process image resizing, thumbnails, notifications and mail via queues.
- Generate responsive WebP/AVIF variants where supported and retain safe fallbacks.
- Lazy-load below-the-fold media; define width/height to reduce layout shifts.
- Use CDN/object storage for media when scale justifies it.
- Enable OPcache in production.
- Use Redis for cache/session/queue only with clear separation/prefixes and memory policy.
- Monitor p95 latency, slow queries, queue lag, memory, CPU, disk and error rates.
- Avoid premature microservices and search clusters.
