# Rental Marketplace - Architecture Notes (v1)

This document defines the initial technical architecture for the MVP scope in `docs/product-brief.md`.

## Stack

- Laravel 13 (backend, policies, validation, queues)
- Jetstream + Inertia + Vue (auth and frontend pages)
- Vite (asset bundling)
- Relational DB (MySQL/PostgreSQL recommended for growth)
- Object storage in production (S3-compatible)

## High-Level Modules

- Auth and account management (Jetstream)
- Item listing management (owner CRUD + publish state)
- Item media management (images)
- Discovery feed (published items + distance filtering)
- Contact owner messaging (simple request/message model)

## Proposed Folder Ownership

- `app/Models`: `Item`, `ItemImage`, `ContactRequest`
- `app/Http/Controllers`: public feed/detail + owner dashboard + contacts
- `app/Policies`: `ItemPolicy` for ownership and state transitions
- `app/Http/Requests`: form request validation for item and contact actions
- `resources/js/Pages`: Inertia pages for feed, item detail, dashboard
- `resources/js/Components`: reusable UI (item card, image uploader, filters)

## Domain Model (MVP)

### User

- Owns many items.
- Has home location (`latitude`, `longitude`) used for distance filtering.

### Item

- Belongs to owner (`user_id`).
- Has title, description, category, condition.
- Has rental constraints: `min_rental_days`.
- Has pricing strategy: `pricing_type`, `price_amount`.
- Has publication state: `is_published`.
- Has many item images.

### ItemImage

- Belongs to item.
- Stores path and ordering.
- Publish rule depends on image count (`>= 3`).

### ContactRequest

- Links requester, owner, and item.
- Stores message and basic status.
- Represents off-platform negotiation start.

## Routing Shape (suggested)

Public:

- `GET /` -> feed page
- `GET /items/{item}` -> item detail (published only)

Authenticated:

- `GET /dashboard/items` -> owner item list
- `GET /dashboard/items/create` -> create form
- `POST /dashboard/items` -> store
- `GET /dashboard/items/{item}/edit` -> edit form
- `PUT /dashboard/items/{item}` -> update
- `PATCH /dashboard/items/{item}/publish` -> publish
- `PATCH /dashboard/items/{item}/unpublish` -> unpublish
- `POST /items/{item}/contact` -> send contact request
- `GET /dashboard/contacts` -> owner inbox

## Authorization Rules

- Only authenticated users can create items.
- Only owner can update/publish/unpublish/delete their items.
- Guests can view only published items.
- Contact owner requires authentication and must block self-contact.

Use policies and gates, not controller-only checks.

## Validation Rules (MVP)

Item create/update:

- `title`: required, max length
- `description`: required, min length
- `category`: required
- `min_rental_days`: integer >= 1
- `pricing_type`: enum (`starting_price`, `per_day`)
- `price_amount`: numeric > 0

Publish:

- item must have at least 3 images
- required fields must be complete

Contact request:

- `message`: required, length bounds
- requester cannot be owner

## Geo Strategy

Initial strategy:

- Use owner home location as item location.
- Default radius = 3 km, adjustable by user.
- Implement Haversine query in SQL scope or query object.

Future strategy:

- Add spatial indexing / PostGIS if dataset grows.
- Add geocoding service and address normalization.

## File and Media Strategy

- Local disk in development.
- Cloud object storage in production.
- Keep only paths in DB.
- Validate mime type and size on upload.
- Consider queued image optimization in later phase.

## Testing Strategy

Priority test coverage:

- Authorization (ownership constraints)
- Publish rule (minimum 3 images)
- Feed returns only published nearby items
- Contact action requires auth and blocks self-contact

Recommended test types:

- Feature tests for HTTP flows
- Policy tests for authorization rules
- Unit tests for distance calculation helper/query object

## Deployment Architecture (Laravel Cloud)

- GitHub push triggers deploy.
- Build/install dependencies + compile assets.
- Run migrations with `--force`.
- Set and manage environment variables in cloud dashboard.
- Add queue worker process when async jobs are introduced.

## Upgrade Path

After MVP:

- Replace contact-only flow with booking lifecycle.
- Add calendar and availability constraints.
- Add payments and dispute flows.
- Add trust features (reviews, verification, abuse controls).
