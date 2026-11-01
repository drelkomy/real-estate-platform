# Architecture

## Style
Modular Monolith. تطبيق Laravel واحد، قاعدة بيانات أساسية واحدة، وRedis مشترك. تفصل العمليات الثقيلة بحاويات queue/scheduler، وليس بخدمات مستقلة مبكراً.

## Suggested domain modules
- Identity: users, profiles, roles, permissions.
- Agencies: agencies, memberships, agents.
- Properties: physical property records and attributes.
- Listings: sale/rent offers, publication workflow, price, status, expiry.
- Locations: country, region, city, district, address/geospatial metadata.
- Media: images, documents, processing and access.
- Leads: inquiries and contact requests.
- Viewings: appointment requests and statuses.
- Favorites: saved listings.
- Moderation: reports, review queue, audit actions.
- Subscriptions: plans and entitlements only after business approval.
- Content: pages, SEO metadata, landing pages.
- Notifications: email/database notifications.

## Property vs Listing
Property represents the underlying asset and its relatively stable physical facts.
Listing represents an offer to sell or rent that asset and contains commercial details, publication status, dates, visibility, and advertiser.
Do not merge these concepts without an approved architecture decision.

## Suggested structure (adapt to actual Laravel conventions)
- app/Domain/<Module>/
- app/Http/Controllers/
- app/Http/Requests/
- app/Policies/
- app/Jobs/
- app/Enums/
- app/Support/

Do not create empty layers or repositories without a demonstrated need. Follow existing code conventions.

## Data principles
- Money: DECIMAL, never float.
- Store currency code with monetary values.
- Store timestamps consistently (UTC recommended); render in configured user/business timezone.
- Model listing status transitions explicitly.
- Use foreign keys and unique constraints where appropriate.
- Store media in object storage or private disk, not DB blobs.
- Use geospatial types/indexes only after confirming MariaDB version, query needs, and portability.

## Search
Start with indexed MariaDB queries and measured query plans. Do not add Elasticsearch/OpenSearch until product scale and search requirements justify the operational cost.

## Background jobs
Use Redis queues for image processing, notifications, and other slow work. Make jobs idempotent where retries may occur.
