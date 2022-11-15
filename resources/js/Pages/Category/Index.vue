<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

defineProps(["categories"]);
</script>

<template>
    <Head title="Muhamad Blog - Category" />

    <GuestLayout>
        <h1 class="mb-4 rounded-lg bg-white p-4 text-3xl font-bold shadow-lg">
            Category:
            <span class="text-primary"> All </span>
        </h1>

        <div class="grid grid-cols-3 gap-4">
            <Link
                v-for="category in categories"
                :key="category.id"
                :href="route('category-detail', category.slug)"
            >
                <article class="rounded-lg bg-white p-3 shadow-lg">
                    <h2 class="text-xl font-bold text-primary">
                        {{ category.name }}
                    </h2>
                </article>
            </Link>
        </div>
    </GuestLayout>
</template>
