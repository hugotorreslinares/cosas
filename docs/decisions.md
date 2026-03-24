# Architecture Decision Log

Use this file to record important product/technical decisions so future work stays consistent.

Format:

- ID
- Date
- Status
- Context
- Decision
- Consequences

---

## ADR-001 - Use Jetstream with Inertia + Vue

- Date: 2026-03-20
- Status: Accepted

### Context

Project goal includes learning Laravel and Vue while building a production-oriented side project.

### Decision

Use Laravel Jetstream with Inertia + Vue as the base scaffolding.

### Consequences

- Faster start for auth/profile/session patterns.
- Vue-first UI workflow for learning goals.
- Slightly higher initial complexity than Blade-only scaffolding.

---

## ADR-002 - Use owner home location in v1

- Date: 2026-03-20
- Status: Accepted

### Context

Need radius-based discovery quickly without complex location UX.

### Decision

Use owner home coordinates as item location in v1.

### Consequences

- Simpler data model and forms.
- Less precise for owners with multiple pickup locations.
- Will likely need item-level location in later phases.

---

## ADR-003 - Contact-only transaction flow in v1

- Date: 2026-03-20
- Status: Accepted

### Context

MVP should validate marketplace demand quickly with minimal operational complexity.

### Decision

Do not implement full booking lifecycle in v1. Provide auth-gated contact owner flow instead.

### Consequences

- Faster time to first deploy.
- Lower engineering complexity.
- Rental agreements and coordination occur outside app.

---

## ADR-004 - Offline payment in v1

- Date: 2026-03-20
- Status: Accepted

### Context

Payment integration adds legal, UX, and operational scope not required for initial validation.

### Decision

No in-app payments for v1. Transactions are arranged offline.

### Consequences

- Reduced development and compliance burden.
- Lower conversion tracking and trust automation.
- Payments can be introduced once demand is validated.

---

## ADR-005 - Multi-language and currency deferred

- Date: 2026-03-20
- Status: Accepted

### Context

Project should prioritize core rental flow before localization complexity.

### Decision

Defer i18n and multi-currency until after MVP traction.

### Consequences

- Faster iteration on core value.
- Future refactor needed for localized content and pricing formatting.

---

## ADR-006 - Default discovery radius is 3 km

- Date: 2026-03-20
- Status: Accepted

### Context

Need a practical default for local browsing aligned with product vision.

### Decision

Set default feed radius to 3 km, user-adjustable.

### Consequences

- Strong local-first experience by default.
- Some low-density areas may need larger radius adjustments.

---

## How to add new decisions

When scope changes, append a new ADR instead of rewriting history.

Suggested next ADR candidates:

- Database engine choice (MySQL vs PostgreSQL)
- Image processing pipeline (sync vs queued)
- Contact request anti-spam/rate-limit policy
- Whether to add booking lifecycle before payment integration
