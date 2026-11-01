# Testing Strategy

## Required layers
- Unit tests: domain calculations, status transitions, value objects.
- Feature tests: HTTP/Livewire workflows, validation, authentication, authorization.
- Database tests: relationships, constraints, transaction behavior.
- Security tests: IDOR, unauthorized edits, mass assignment, upload validation, rate limits.
- Browser tests: critical public search and listing publication flows when browser test infrastructure is approved.

## Minimum cases for Listings
- Authorized owner creates listing.
- User cannot edit another user's listing.
- Agency member permissions are checked.
- Invalid price/currency/area is rejected.
- Expired or rejected listing is not publicly visible.
- Draft listing is not indexed publicly.
- Listing state transitions reject invalid transitions.
- Search filters and pagination work.
- Upload rejects unsupported file types and oversized files.

## Completion gate
A task is not complete until relevant tests are executed and results reported. A test not run must be marked NOT RUN.
