<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900">Welcome back</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Manage your published items and create new listings for your rental marketplace.
                    </p>

                    <div class="mt-6 flex flex-wrap gap-3">
                        <Link
                            :href="route('items.index')"
                            class="inline-flex rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500"
                        >
                            My items
                        </Link>
                        <Link
                            :href="route('items.create')"
                            class="inline-flex rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50"
                        >
                            Create item
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
