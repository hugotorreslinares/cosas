<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    item: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    title: props.item.title,
    description: props.item.description,
    category: props.item.category,
    condition: props.item.condition,
    min_rental_days: props.item.min_rental_days,
    pricing_type: props.item.pricing_type,
    price_amount: props.item.price_amount,
});

const submit = () => {
    form.put(route('items.update', props.item.id));
};
</script>

<template>
    <AppLayout title="Edit Item">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Item</h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <form class="space-y-4" @submit.prevent="submit">
                        <div>
                            <InputLabel for="title" value="Title" />
                            <TextInput id="title" v-model="form.title" type="text" class="mt-1 block w-full" />
                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>

                        <div>
                            <InputLabel for="description" value="Description" />
                            <textarea
                                id="description"
                                v-model="form.description"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                rows="5"
                            />
                            <InputError class="mt-2" :message="form.errors.description" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <InputLabel for="category" value="Category" />
                                <TextInput id="category" v-model="form.category" type="text" class="mt-1 block w-full" />
                                <InputError class="mt-2" :message="form.errors.category" />
                            </div>

                            <div>
                                <InputLabel for="condition" value="Condition" />
                                <TextInput id="condition" v-model="form.condition" type="text" class="mt-1 block w-full" />
                                <InputError class="mt-2" :message="form.errors.condition" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <InputLabel for="min_rental_days" value="Min rental days" />
                                <TextInput id="min_rental_days" v-model="form.min_rental_days" type="number" min="1" class="mt-1 block w-full" />
                                <InputError class="mt-2" :message="form.errors.min_rental_days" />
                            </div>

                            <div>
                                <InputLabel for="pricing_type" value="Pricing type" />
                                <select
                                    id="pricing_type"
                                    v-model="form.pricing_type"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                    <option value="starting_price">Starting price</option>
                                    <option value="per_day">Per day</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.pricing_type" />
                            </div>

                            <div>
                                <InputLabel for="price_amount" value="Price amount" />
                                <TextInput id="price_amount" v-model="form.price_amount" type="number" step="0.01" min="0" class="mt-1 block w-full" />
                                <InputError class="mt-2" :message="form.errors.price_amount" />
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <Link :href="route('items.index')" class="text-sm text-gray-600 hover:text-gray-900">Cancel</Link>
                            <PrimaryButton :disabled="form.processing">Update item</PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
