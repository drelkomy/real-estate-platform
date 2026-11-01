# Architecture Decision Records

## ADR-001: Modular Monolith
Status: Accepted as initial direction.
Decision: Start with one Laravel application split into business modules.
Reason: Lower operational complexity, shared transactions, easier MVP delivery.
Revisit when independent scaling/deployment or team boundaries justify services.

## ADR-002: Property and Listing are separate concepts
Status: Accepted as domain direction; detailed schema pending.
Decision: A physical property is separate from its sale/rent advertisement.
Reason: One asset may have multiple offers over time and commercial lifecycle differs from physical facts.

## ADR-003: Docker service separation
Status: Accepted.
Decision: Separate app, Nginx, queue, scheduler, MariaDB and Redis containers.
Reason: Independent resource control and lifecycle without premature microservices.

## ADR-004: No public database/cache ports
Status: Accepted.
Decision: MariaDB and Redis remain private to Docker networks in production.
Reason: Reduce exposed attack surface.
