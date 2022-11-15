<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

defineProps(["post"]);
</script>

<template>
    <Head title="Muhamad Blog - Blog" />

    <GuestLayout>
        <article class="mx-auto w-8/12 rounded-lg bg-white p-4 shadow-lg">
            <h2 class="mb-6 text-center text-3xl font-bold text-slate-900">
                {{ post.title }}
            </h2>

            <h5
                class="mb-3 flex items-center justify-between text-sm font-semibold text-slate-500"
            >
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

            <img
                src="https://via.placeholder.com/600x200"
                class="w-full rounded-sm object-cover shadow-md"
            />

            <p class="mt-4 text-base font-light text-slate-700">
                {{ post.content }}
            </p>

            <Link
                :href="route('blog')"
                class="mt-4 inline-block rounded-md bg-primary px-3 py-1 text-white"
            >
                « back
            </Link>
        </article>
    </GuestLayout>
</template>
