<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

defineProps(["post"]);
</script>

<template>
    <Head title="Muhamad Blog - Blog" />

    <GuestLayout>
        <article class="mb-4 rounded-lg bg-white p-3 shadow-lg">
            <h2 class="text-xl font-bold text-primary">
                {{ post.title }}
            </h2>

            <h5 class="mb-3 text-sm font-semibold text-slate-500">
                <span>
                    By :
                    <Link href="#" class="text-primary">{{
                        post.user.name
                    }}</Link>
                </span>
                <span class="mt-1 block">
                    category :
                    <Link
                        :href="route('category-detail', post.category.slug)"
                        class="text-primary"
                    >
                        {{ post.category.name }}
                    </Link>
                </span>
            </h5>

            <p class="mt-4 text-base font-medium text-slate-700">
                {{ post.content }}
            </p>

            <Link
                :href="route('blog')"
                class="mt-4 inline-block text-slate-500"
            >
                « back
            </Link>
        </article>
    </GuestLayout>
</template>
