<template>
    <Head :title="title + ' - SpiritVale Info'" />
    <BaseLayout>
        <div class="page-content">
            <section class="section-panel legal-page">
                <div
                    class="markdown-content legal-content"
                    v-html="html"
                ></div>
            </section>
        </div>
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '@/layouts/BaseLayout.vue';
import { Head } from '@inertiajs/vue3';
import { marked } from 'marked';

const props = defineProps<{
    title: string;
    content: string;
}>();

const html = marked.parse(props.content);
</script>

<style scoped>
.legal-page {
    max-width: 1000px;
    text-align: left;
}

.legal-content {
    line-height: 1.7;
}

.legal-content :deep(h1) {
    margin-bottom: 0.5rem;
}

.legal-content :deep(h2) {
    border-top: 1px solid rgba(148, 163, 184, 0.25);
    padding-top: 1.5rem;
}

.legal-content :deep(a) {
    color: #93c5fd;
    text-decoration: underline;
}
</style>
