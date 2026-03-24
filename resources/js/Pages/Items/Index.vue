<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    items: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <AppLayout title="My Items">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Items</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
                <div class="flex justify-end">
                    <Link
                        :href="route('items.create')"
                        class="inline-flex rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500"
                    >
                        New Item
                    </Link>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div v-if="items.length === 0" class="text-gray-500">
                        No items yet. Create your first one.
                    </div>

                    <ul v-else class="space-y-3">
                        <li
                            v-for="item in items"
                            :key="item.id"
                            class="flex items-center justify-between rounded border p-3"
                        >
                            <div>
                                <p class="font-semibold">{{ item.title }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ item.pricing_type }} - ${{ item.price_amount }}
                                </p>
                                <p class="text-xs" :class="item.is_published ? 'text-green-600' : 'text-amber-600'">
                                    {{ item.is_published ? 'Published' : 'Draft' }}
                                </p>
                            </div>

                            <div class="flex items-center gap-3">
                                <Link :href="route('items.edit', item.id)" class="text-indigo-600 hover:text-indigo-500">
                                    Edit
                                </Link>
                                <Link
                                    v-if="!item.is_published"
                                    :href="route('items.publish', item.id)"
                                    method="patch"
                                    as="button"
                                    class="text-green-600 hover:text-green-500"
                                >
                                    Publish
                                </Link>
                                <Link
                                    v-else
                                    :href="route('items.unpublish', item.id)"
                                    method="patch"
                                    as="button"
                                    class="text-amber-600 hover:text-amber-500"
                                >
                                    Unpublish
                                </Link>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
