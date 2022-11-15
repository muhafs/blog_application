<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { onMounted } from "vue";
import moment from "moment";

const props = defineProps(["posts"]);
const firstPost = props.posts.shift();
</script>

<template>
    <Head title="Muhamad Blog - Blog" />

    <GuestLayout>
        <div
            class="mb-3 w-full overflow-hidden rounded-md border border-slate-200 bg-white shadow-lg"
            v-if="posts.length"
        >
            <img
                src="https://via.placeholder.com/1200x500"
                class="h-64 w-full object-cover"
            />

            <div class="p-5 text-center">
                <h2 class="mb-2 text-2xl font-bold">{{ firstPost.title }}</h2>

                <h3 class="mb-3 text-sm font-semibold text-slate-500">
                    <span>
                        By :
                        <Link href="#" class="text-primary">{{
                            firstPost.user.name
                        }}</Link>

                        {{ moment(firstPost.created_at).fromNow() }}
                    </span>
                    <span class="mt-1 block">
                        category :
                        <Link
                            :href="
                                route(
                                    'category-detail',
                                    firstPost.category.slug
                                )
                            "
                            class="text-primary"
                        >
                            {{ firstPost.category.name }}
                        </Link>
                    </span>
                </h3>

                <p class="mb-4 text-base">
                    {{ `${firstPost.content.slice(0, 100)}...` }}
                </p>
                <button>
                    <Link
                        :href="route('blog-detail', firstPost.slug)"
                        class="inline-block rounded-md bg-primary px-4 py-2 text-white"
                    >
                        Read more »
                    </Link>
                </button>
            </div>
        </div>
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
            v-else
        >
            <p class="text-3xl font-bold">No Posts Found</p>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <article
                v-for="post in posts"
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
    </GuestLayout>
</template>
