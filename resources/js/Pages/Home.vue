<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    items: {
        type: Array,
        default: () => [],
    },
    canLogin: {
        type: Boolean,
        default: false,
    },
    canRegister: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <Head title="Home" />

    <div class="min-h-screen bg-gray-50">
        <header class="mx-auto flex w-full max-w-7xl items-center justify-between px-6 py-6">
            <h1 class="text-xl font-bold text-gray-900">Rental Marketplace</h1>

            <nav v-if="canLogin" class="flex gap-3">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('items.index')"
                    class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500"
                >
                    My items
                </Link>
                <template v-else>
                    <Link :href="route('login')" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700">
                        Log in
                    </Link>
                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500"
                    >
                        Register
                    </Link>
                </template>
            </nav>
        </header>

        <main class="mx-auto w-full max-w-7xl px-6 pb-10">
            <h2 class="mb-4 text-lg font-semibold text-gray-900">Published items near you</h2>

            <p v-if="items.length === 0" class="rounded-lg border border-dashed border-gray-300 bg-white p-6 text-gray-500">
                There are no published items yet.
            </p>

            <div v-else class="columns-1 gap-4 sm:columns-2 lg:columns-3">
                <article
                    v-for="item in items"
                    :key="item.id"
                    class="mb-4 break-inside-avoid rounded-lg border bg-white p-4 shadow-sm"
                >
                    <h3 class="text-base font-semibold text-gray-900">{{ item.title }}</h3>
                    <p class="mt-1 text-sm text-gray-600">{{ item.description }}</p>
                    <div class="mt-3 text-sm text-gray-500">
                        <p>Owner: {{ item.user?.name ?? 'Unknown' }}</p>
                        <p>Category: {{ item.category }}</p>
                        <p>Min days: {{ item.min_rental_days }}</p>
                        <p>Price: ${{ item.price_amount }} ({{ item.pricing_type }})</p>
                    </div>
                </article>
            </div>
        </main>
    </div>
</template>
