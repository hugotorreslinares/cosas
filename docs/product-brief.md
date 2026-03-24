# Rental Marketplace - Product Brief (v1)

## Vision

Build a local peer-to-peer rental marketplace where people can rent everyday items (clothes, tools, games, sports gear, etc.) within a configurable nearby radius.

This project is also a learning vehicle for Laravel + Vue and will evolve incrementally as a side project.

## Confirmed Decisions (from founder)

- Frontend stack: Jetstream with Inertia + Vue
- Location model (v1): use owner home location
- Booking flow (v1): no built-in booking engine yet, just contact owner
- Payments (v1): offline agreement only
- Multi-language / multi-currency: later phase

## Core User Flow (v1)

1. Guest opens home page and sees a Pinterest-like grid of published items near them (default radius: 3 km, user-adjustable).
2. User can browse item detail without authentication.
3. To contact the item owner, user must register or log in.
4. Authenticated user can create items:
   - title, description, category, condition
   - minimum rental days
   - pricing mode (starting price or per-day price)
   - minimum 3 item photos
5. Item owner can edit, publish, and unpublish their own items.

## MVP Functional Requirements

- Authentication via Jetstream (Inertia + Vue)
- Item CRUD for owner
- Publish/unpublish status
- Validation: at least 3 photos required before publish
- Distance filtering by radius (default 3 km)
- Guest browse + auth-gated contact owner action

## Suggested Initial Data Model

### users

- id
- name
- email
- password
- latitude
- longitude

### items

- id
- user_id (owner)
- title
- description
- category
- condition
- min_rental_days
- pricing_type (`starting_price` or `per_day`)
- price_amount
- is_published

### item_images

- id
- item_id
- path
- sort_order

### contact_requests (simple v1 option)

- id
- item_id
- requester_id
- owner_id
- message
- status (`new`, `read`, `archived`)

## Technical Direction

- Backend: Laravel 13
- Frontend: Inertia + Vue
- Build tooling: Vite
- Storage: local in development, cloud object storage in production
- Geo search: Haversine-based radius filter initially

## Non-Goals (v1)

- In-app payment processing
- Advanced rental lifecycle (accept/reject, calendar blocks)
- Ratings and reviews
- Teams / organizations

## Deployment Notes (Laravel Cloud)

Deploying is mostly push-to-GitHub + Laravel Cloud pipeline, with proper environment setup:

- Set production environment variables (`APP_URL`, `DB_*`, mail, storage keys, etc.)
- Run migrations on deploy (`php artisan migrate --force`)
- Ensure frontend assets are built during deploy (`npm ci && npm run build`) if not prebuilt
- Configure queue worker later if async jobs are added

## Next Build Milestones

1. Install Jetstream (Inertia + Vue)
2. Create item domain (models, migrations, policies, controllers)
3. Build item create/edit/publish views with Vue
4. Implement photo uploads and minimum-3-photo publish rule
5. Build home feed with radius filter
6. Add contact-owner flow gated by auth

## Change Log

- v1 baseline defined with founder answers on 2026-03-20.
