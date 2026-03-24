# Rental Marketplace - Roadmap

This roadmap is optimized for a solo builder learning Laravel + Vue while shipping incremental value.

## Principles

- Keep each milestone deployable.
- Prefer simple implementations first, then improve.
- Add tests for core behavior before expanding scope.
- Avoid building payments/complex booking until usage validates it.

## Week 0 - Foundations

### Goals

- Confirm local and cloud environment readiness.
- Install app scaffolding for authentication and Vue workflow.

### Tasks

- Install Jetstream with Inertia + Vue.
- Run migrations and verify login/register works.
- Define `.env` strategy for local and production.
- Confirm Laravel Cloud deployment from current branch.

### Exit Criteria

- User can register/log in locally and in cloud deploy.
- CI/CD deploy succeeds from GitHub push.

## Week 1 - Item Domain + Owner CRUD

### Goals

- Allow authenticated users to create and manage their rental items.

### Tasks

- Create `items` migration/model/controller/policy.
- Add owner dashboard list (`my items`).
- Build create/edit forms with server-side validation.
- Add publish/unpublish actions.

### Exit Criteria

- Owner can create, edit, publish, unpublish only their own items.

## Week 2 - Images + Publish Rule

### Goals

- Support image uploads and enforce photo quality baseline.

### Tasks

- Create `item_images` migration/model.
- Build multi-upload UI and image ordering.
- Enforce minimum 3 images before publishing.
- Add deletion and replacement of photos.

### Exit Criteria

- Published item always has at least 3 valid images.

## Week 3 - Guest Feed + Radius Filtering

### Goals

- Make home page useful for anonymous browsing.

### Tasks

- Build Pinterest-like grid UI on `/`.
- Implement radius filter (default 3 km, user-adjustable).
- Query only published items within distance.
- Add category and price sort filters (optional if time).

### Exit Criteria

- Guest sees nearby published items and can open item detail.

## Week 4 - Contact Owner Flow (Auth-Gated)

### Goals

- Enable renter-owner connection without payment engine.

### Tasks

- Create `contact_requests` migration/model/controller.
- Add "Contact owner" action on item detail.
- Require authentication to submit message.
- Build inbox list for item owner.

### Exit Criteria

- Authenticated users can contact owners; owners can view inbound requests.

## Week 5 - Hardening + First Public Beta

### Goals

- Improve reliability and prepare for real users.

### Tasks

- Add feature tests for item ownership and publish rules.
- Add rate limiting for contact requests.
- Add basic moderation controls (unpublish abusive items).
- Add seeders/factories for realistic demo data.

### Exit Criteria

- App is stable enough for small private beta usage.

## Backlog (After MVP)

- Booking request lifecycle (pending/accepted/rejected).
- Calendar availability and blocked dates.
- In-app notifications and email notifications.
- Ratings/reviews and trust indicators.
- Payments/deposits integration.
- Multi-language and multi-currency.

## Work Rhythm Suggestion

- Daily: 60-120 minutes focused coding.
- Weekly cadence:
  - Mon-Tue: feature implementation
  - Wed: tests and refactor
  - Thu: UI polish and bug fixes
  - Fri: deploy and retrospective notes

## Definition of Done (per feature)

- Feature works locally.
- Validation and authorization are enforced.
- At least one feature/integration test exists.
- Deployed successfully to Laravel Cloud.
- Notes updated in `docs/decisions.md` if architecture changed.
