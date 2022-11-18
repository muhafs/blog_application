<script setup>
import FormCard from "@/Components/FormCard.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import Checkbox from "@/Components/Checkbox.vue";
import AuthButton from "@/Components/AuthButton.vue";
import { useForm } from "@inertiajs/inertia-vue3";

defineProps({
	canResetPassword: Boolean,
	status: String,
});

const form = useForm({
	email: "",
	password: "",
	remember: false,
});

const submit = () => {
	form.post(route("login"), {
		onFinish: () => form.reset("password"),
	});
};
</script>

<template>
	<Head title="Log in" />

	<div v-if="status" class="mb-4 text-sm font-medium text-green-600">
		{{ status }}
	</div>

	<FormCard @submit.prevent="submit">
		<div>
			<InputLabel for="email" value="Email" />
			<TextInput
				id="email"
				type="email"
				class="mt-1 block w-full"
				v-model="form.email"
				required
				autofocus
				autocomplete="username"
			/>
			<InputError class="mt-2" :message="form.errors.email" />
		</div>

		<div class="mt-4">
			<InputLabel for="password" value="Password" />
			<TextInput
				id="password"
				type="password"
				class="mt-1 block w-full"
				v-model="form.password"
				required
				autocomplete="current-password"
			/>
			<InputError class="mt-2" :message="form.errors.password" />
		</div>

		<div class="mt-4 flex justify-between">
			<label class="flex items-center">
				<Checkbox name="remember" v-model:checked="form.remember" />
				<span class="ml-2 text-sm text-primary">Remember me</span>
			</label>

			<Link
				v-if="canResetPassword"
				:href="route('password.request')"
				class="text-sm text-primary underline hover:text-primary/70"
			>
				Forgot your password?
			</Link>
		</div>

		<div class="mt-4 flex items-end justify-end">
			<Link
				:href="route('register')"
				class="text-sm text-primary underline hover:text-primary/70"
			>
				Don't have an account?
			</Link>

			<AuthButton
				class="ml-4"
				:class="{ 'opacity-25': form.processing }"
				:disabled="form.processing"
			>
				Log in
			</AuthButton>
		</div>
	</FormCard>
</template>
