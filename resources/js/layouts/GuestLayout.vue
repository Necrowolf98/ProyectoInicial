<template>
	<v-app style="background-color: #f5f5f5">
		<slot />
	</v-app>
</template>

<script>
export default {
	watch: {
		$page: {
			handler() {
				const message = this.$page.props.flash.message;
				if (message != null) {
					switch (message.type) {
						case "success":
							this.$notify({
								title: message.title,
								message: message.text,
								type: message.type,
								duration: 1500,
							});
							break;

						case "error":
							this.$notify({
								message: message.text,
								type: error,
								duration: 1500,
							});
						break;
					}
				}
			},
		},
	},
};
</script>
