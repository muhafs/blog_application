<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import moment from "moment";

defineProps(["category"]);
</script>

<template>
    <Head title="Muhamad Blog - Category" />

    <GuestLayout>
        <h1
            class="mb-4 border-b-2 border-slate-300 pb-3 text-center text-3xl font-bold"
        >
            {{ category.name }}
        </h1>

        <template v-if="category.posts.length">
            <div class="grid grid-cols-3 gap-4">
                <article
                    v-for="post in category.posts"
                    :key="post.id"
                    class="overflow-hidden rounded-lg bg-white shadow-lg"
                >
                    <div class="relative">
                        <img
                            src="https://via.placeholder.com/500x400"
                            class="h-64 w-full object-cover"
                        />

                        <Link
                            :href="route('category-detail', post.category.slug)"
                            class="absolute top-0 left-0 rounded-sm bg-slate-800/70 p-2 text-white"
                            >{{ post.category.name }}</Link
                        >
                    </div>

                    <div class="p-5">
                        <h2 class="mb-2 text-lg font-bold">
                            {{ post.title }}
                        </h2>

                        <h3 class="mb-3 text-sm font-medium text-slate-500">
                            <span>
                                By :
                                <Link href="#" class="text-primary">{{
                                    post.user.name
                                }}</Link>

                                {{ moment(post.created_at).fromNow() }}
                            </span>
                        </h3>

                        <p class="mb-4 text-base">
                            {{ `${post.content.slice(0, 50)}...` }}
                        </p>
                        <button>
                            <Link
                                :href="route('blog-detail', post.slug)"
                                class="inline-block rounded-md bg-primary px-2 py-1 text-sm text-white"
                            >
                                Read more »
                            </Link>
                        </button>
                    </div>
                </article>
            </div>
        </template>

        <template v-else>
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
            >
                <p class="text-3xl font-bold">No Posts Found</p>
            </div>
        </template>
    </GuestLayout>
</template>
