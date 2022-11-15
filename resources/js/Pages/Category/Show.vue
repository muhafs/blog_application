<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

defineProps(["category"]);
</script>

<template>
    <Head title="Muhamad Blog - Category" />

    <GuestLayout>
        <h1 class="mb-4 rounded-lg bg-white p-4 text-3xl font-bold shadow-lg">
            Category:
            <span class="text-primary">
                {{ category.name }}
            </span>
        </h1>

        <template v-if="category.posts.length">
            <div class="grid grid-cols-3 gap-4">
                <article
                    v-for="post in category.posts"
                    :key="post.id"
                    class="rounded-lg bg-white p-3 shadow-lg"
                >
                    <h2 class="text-xl font-bold text-primary">
                        <Link :href="route('blog-detail', post.slug)">
                            {{ post.title }}
                        </Link>
                    </h2>

                    <h5 class="text-sm font-semibold text-slate-500">
                        By : {{ post.user.name }}
                        <Link
                            :href="route('category-detail', post.category.slug)"
                        >
                            <span class="block">
                                category :
                                <span class="text-primary">
                                    {{ post.category.name }}
                                </span>
                            </span>
                        </Link>
                    </h5>

                    <p class="mt-4 text-base font-medium text-slate-700">
                        {{ `${post.content.slice(0, 100)}...` }}
                        <span>
                            <Link
                                :href="route('blog-detail', post.slug)"
                                class="inline-block text-primary"
                            >
                                more »
                            </Link>
                        </span>
                    </p>
                </article>
            </div>
        </template>
        <template v-else>
            <article class="mx-auto w-2/3 rounded-lg bg-white p-5 shadow-lg">
                <h2 class="text-center text-xl font-bold text-primary">
                    There's no Posts yet
                </h2>

                <Link :href="route('category')"> « back </Link>
            </article>
        </template>
    </GuestLayout>
</template>
