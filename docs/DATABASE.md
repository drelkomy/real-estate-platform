# Database Design Guidelines

## Initial conceptual entities
- users
- agencies
- agency_memberships
- properties
- property_types
- property_attributes (structured design to be decided)
- listings
- listing_media
- countries / regions / cities / districts
- favorites
- inquiries
- viewing_requests
- listing_reports
- moderation_actions
- notifications

These are conceptual candidates, not an approved final schema. Inspect requirements before creating migrations.

## Property
Represents the physical unit/asset: property type, location, physical attributes, ownership/management reference, and stable characteristics.

## Listing
Represents a sell/rent offer: property_id, listing_type, price, currency, negotiability, status, published_at, expires_at, advertiser, and commercial metadata.

## Property-specific attributes
Apartments, land, villas and buildings have different attributes. Avoid one giant table with hundreds of nullable columns. Evaluate typed subtype tables or carefully modeled attribute groups based on query/report requirements. Do not use unrestricted EAV without a search and validation plan.

## Integrity
- Use DECIMAL for money.
- Define currency code.
- Define units for area (e.g. square meter) and normalize storage.
- Define whether area is gross/net.
- Define allowed status transitions.
- Add soft deletes only when restore/audit requirements justify them.
- Define uniqueness and indexes from real business rules.
